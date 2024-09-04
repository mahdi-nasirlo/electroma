<?php

namespace App\View\Components\Layout;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;
use Illuminate\View\View;
use Modules\Blog\Entities\Category;

class Footer extends Component
{
    public Collection $categories;

    public Collection $pages;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->categories = Cache::remember(
            "blogCategories_take_5_visible_parent",
            3600 * 24 * 4 ,
            fn() =>  Category::all()
                    ->where('is_visible', true)
                    ->where('parent_id', 0)
                    ->take(5)
        );

        $this->pages = Cache::get("pages");
    }

    public function render(): View
    {
        return view('components.layout.footer');
    }
}
