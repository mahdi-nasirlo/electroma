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

        SEOMeta::setTitle($category->seo->title ?? $category->name)
            ->addMeta("article:published_time", $category->created_at)
            ->addMeta("revised", $category->updated_at)
            ->addMeta("designer", env("DESIGNER"));
        // ->addKeyword($category->tags(true));

        return view('shop::product-list.index', compact('category'));
    }

    public function search()
    {
        // return view("shop::product-list.search");
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
