<?php

namespace Modules\Shop\Http\Controllers;

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
