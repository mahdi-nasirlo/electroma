<?php

namespace Modules\Shop\Http\Controllers;

use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Jackiedo\Cart\Facades\Cart;
use Modules\Shop\Entities\Category;
use Modules\Shop\Entities\Product;

class ShopController extends Controller
{
    public function list(Category $category)
    {
        SEOMeta::setTitle($category->seo->title ?? $category->title)
            ->addMeta("article:published_time", $category->created_at)
            ->addMeta("revised", $category->updated_at)
            ->addMeta("author",  $category->seo->author ??  $category->user->name . " ," . $category->user->email)
            ->addMeta("designer", env("DESIGNER"))
            ->addMeta("owner", $category->user->name)
            // ->addKeyword($categoryTags)
            ->addMeta("category", $category->category->name);

        // OpenGraph::setTitle($category->seo->title ?? $category->title)
        //     ->setDescription($category->seo->description)
        //     ->setType('article')
        //     ->setArticle([
        //         'published_time' => $category->created_at,
        //         'modified_time' => $category->updated_at,
        //         'author' => $category->seo->author ??  $category->user->name,
        //         'tag' => $categoryTags
        //     ]);

        return view('shop::product-list.index', compact('category'));
    }

    public function show(Product $product)
    {
        // $cart = Cart::name('shopping');
        // $countOfCart = (int) $cart->getDetails()->items_count;
        // $totalPrice = (int) $cart->getDetails()->total;
        // dd($cart, $countOfCart);

        return view('shop::product-page.index', compact('product'));
    }
}
