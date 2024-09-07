<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Modules\Blog\Entities\Post;
use Modules\Information\Entities\Banner;
use Modules\Shop\Entities\Product;

class HomePageController extends Controller
{
    public function index(): Factory|View|Application
    {
        $cacheLifeTime = 3600 * 24 * 10;

        $banners = Cache::remember("home_page_banners", $cacheLifeTime,
            fn() => Banner::with("bannerable")->get()
        );

        $posts = Cache::remember("home_page_posts", $cacheLifeTime, fn() => Post::query()->latest()->take(7)->get());

        $carouselBanner = $banners->where('collection', 'carousel');
        $smallBanner = $banners->where('collection', 'small-banner');
        $mediumBanner = $banners->where('collection', 'medium-banner');
        $categoriesBanner = $banners->where('collection', 'categories-banner');
        $infoBanner = $banners->where('collection', 'info-banner');

        $productQuery = Product::query()
            ->with("discountItem")
            ->withCount("comments")
            ->orderBy('created_at', 'desc');

        $lastProducts = Cache::remember("home_page_lastProducts", $cacheLifeTime,
            fn() => $productQuery
                ->withSum("comments", "rating")
                ->take(8)
                ->get()
        );

        $popularProducts = Cache::remember(
            "home_page_popularProducts", $cacheLifeTime,
            fn() => Product::query()
                ->withCount('orders')
                ->withSum("comments", "rating")
                ->withCount("comments")
                ->orderBy('orders_count', 'DESC')
                ->get()
        );

        return view("index", compact("lastProducts", "popularProducts", "posts", "carouselBanner", "smallBanner", "mediumBanner", "categoriesBanner", "infoBanner"));
    }
}
