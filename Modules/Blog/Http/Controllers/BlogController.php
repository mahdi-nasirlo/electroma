<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Illuminate\Routing\Controller;
use Modules\Blog\Entities\Category;
use Modules\Blog\Entities\Post;

class BlogController extends Controller
{
    public function show(Post $post)
    {
        if (request()->input('s')) {
            return redirect()->to(route('blog.article.list', ['search' => request()->input('s'), 'category' => $post->category]));
        }
        if (!$post->published_at->isPast()) abort(404);

        $postTags = $post->tags()->pluck("name")->toArray();

        SEOMeta::setTitle($post->seo->title ?? $post->title)
            ->addMeta("article:published_time", $post->created_at)
            ->addMeta("revised", $post->updated_at)
            ->addMeta("author",  $post->seo->author ??  $post->user->name . " ," . $post->user->email)
            ->addMeta("designer", env("DESIGNER"))
            ->addMeta("owner", $post->user->name)
            ->addKeyword($postTags)
            ->addMeta("category", $post->category->name);

        OpenGraph::setTitle($post->seo->title ?? $post->title)
            ->setDescription($post->seo->description)
            ->setType('article')
            ->setArticle([
                'published_time' => $post->created_at,
                'modified_time' => $post->updated_at,
                'author' => $post->seo->author ??  $post->user->name,
                'tag' => $postTags
            ]);

        OpenGraph::addImage(asset('storage/' . $post->image));

        $post->update(['view' => $post->view + 1]);

        return view('blog::blog-detail.index', ['article' => $post]);
    }

    public function list(Category $category)
    {

        if (!$category->isVIsible() or !$category->is_visible) abort(404);

        SEOMeta::setTitle($category->seo->title ?? $category->name)
            ->addMeta("article:published_time", $category->created_at)
            ->addMeta("revised", $category->updated_at)
            ->addMeta("designer", env("DESIGNER"))
            ->addKeyword($category->tags(true));

        $category_sub_cat_ids = [$category->id];
        $category->getChildrenIds($category_sub_cat_ids);

        $post = Post::query()->whereIn('blog_category_id', ['1', 2])->Where('published_at', "<", now());

        if (request()->input('search')) {
            $post->where('title', 'like', '%' . request()->input('search') . '%');
        }

        return view('blog::blog-list.index', ['category' => $category, 'posts' => $post->paginate(10)]);
    }


    // public function storComment(Request $request)
    // {
    //     $data = $request->validate([
    //         'content' => ['required'],
    //         'commentable_id' => ['required'],
    //         'commentable_type' => ['required', 'string'],
    //         'parent_id' => ['required', 'string']
    //     ]);

    //     auth()->user()->comments()->create($data);

    //     Alert::success('دیدگاه شما با موفقیت ثبت شد');

    //     return back();
    // }
}
