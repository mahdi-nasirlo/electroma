<?php

namespace Modules\Shop\Http\Livewire;

use Livewire\Component;
use Illuminate\Pipeline\Pipeline;
// use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Modules\Shop\Entities\Category;
use Modules\Shop\Entities\Product;
use Modules\Shop\Http\Filters\AttributesFilter;
use Modules\Shop\Http\Filters\Order;
use Modules\Shop\Http\Filters\Search;

class ProductList extends Component
{
    use WithPagination;

    public Category $category;

    public $filter = [];

    public $search;

    public $order;

    protected $queryString = [
        'filter',
        'search',
        'order'
    ];

    // public function mount()
    // {
    //     $this->category->load('products');
    // }

    public function filterIsEnable($filterName)
    {
        return collect($this->filter)->filter(function ($item) use ($filterName) {
            return Str::contains($item, $filterName);
        })->count() > 0;
    }

    public function render()
    {

        $array = array();
        $this->category->getChildrenIds($array);

        $products =
            app(Pipeline::class)
            ->send(
                Product::query()
                    ->whereIn("category_id", $array)
                    ->orWhere('category_id', $this->category->id)
                    ->with(['attributes'])
            )
            ->through([
                new Order($this->order),
                new AttributesFilter($this->filter),
                new Search($this->search),
            ])
            ->thenReturn()
            ->paginate(20);

        app(Pipeline::class)
            ->send(
                Product::query()
                    ->whereIn("category_id", $array)
                    ->orWhere('category_id', $this->category->id)
                    ->with(['attributes'])
            )
            ->through([
                new Order($this->order),
                new AttributesFilter($this->filter),
                new Search($this->search),
            ])
            ->thenReturn()
            ->paginate(20);

        return view('shop::livewire.product-list', compact('products'));
    }
}
