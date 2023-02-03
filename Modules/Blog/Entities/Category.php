<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kalnoy\Nestedset\NodeTrait;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\HasMany;

// TODO: add slug
class Category extends Model
{
    use HasFactory, HasSEO;

    use Sluggable,
        NodeTrait {
        NodeTrait::replicate insteadof Sluggable;
    }

    protected $fillable = [
        'name',
        'slug',
        'description',
        'parent_id',
        'is_visible',
    ];
    protected $table = "blog_categories";

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    protected $casts = [
        'is_visible' => 'boolean',
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'blog_category_id');
    }

    public function isVIsible()
    {
        return $this->posts()->count() > 0;
    }

    public function link()
    {
        return ($this->isVIsible() and $this->is_visible) ? route('blog.article.list', $this) : "javascript:void(0)";
    }

    public function childIsVisible()
    {
        // foreach ($this->children as $child) {
        //     if ($child->isVIsible()) {
        //         return true;
        //     }
        // }

        return true;
    }

    public function tags($array = null)
    {
        // $posts = $this->posts;
        // $tags = [];

        // foreach ($posts as  $post) {
        //     foreach ($post->tags->toArray() as $tag) {
        //         $tag['name'] = $tag['name']['fa'];
        //         array_push($tags, $array ? $tag['name'] : $tag);
        //     }
        // }

        return [];
    }

    public function getChildrenIds(&$arr)
    {
        $children = $this->descendants;
        foreach ($children as $child) {
            if (count($child->children) > 0) {
                $arr[] = $child->id;
                $child->getChildrenIds($arr);
            } else
                array_push($arr, $child->id);
        }
    }

    protected static function newFactory()
    {
        return \Modules\Blog\Database\factories\CategoryFactory::new();
    }
}
