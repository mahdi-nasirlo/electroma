<?php

namespace App\View\Components\Layout;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;
use Illuminate\View\View;
use Modules\Blog\Entities\Category as BlogCategory;
use Modules\Course\Entities\Course;
use Modules\Information\Entities\Page;
use Modules\Shop\Entities\Category as ShopCategory;

class Header extends Component
{
    public array $shopCategories;

    public Collection  $courses;

    public Collection $pages;

    public array $category;

    public function __construct()
    {
        $remember = 3600 * 12 * 4;

        $this->shopCategories =  Cache::remember(
            "shopCategories_tree",
             $remember,
            fn() => ShopCategory::query()->where('is_visible', true)
                ->get()
                ->toTree()
                ->toArray()
        );

        $this->courses = Cache::remember(
            "courses_published_inStock",
            $remember,
            fn() => Course::query()->where('published_at', '<', now())
                ->where('inventory', '>', 0)
                ->get()
        );

        $this->pages = Cache::remember(
            "pages",
            $remember,
            fn() => Page::query()->get(['name', 'slug', 'id'])
        );

        $this->category = Cache::remember(
            "blogCategories",
            $remember,
            fn() => BlogCategory::where('is_visible', true)
                ->get()
                ->toTree()
                ->toArray()
        );

    }

    public function render(): View
    {
        return view('components.layout.header');
    }
}
