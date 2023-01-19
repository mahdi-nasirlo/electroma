<?php

namespace Modules\Shop\Http\Livewire;

use Livewire\Component;
use Modules\Shop\Entities\Product;

class ProductPage extends Component
{
    public Product $product;
    public $count = 1;

    public function render()
    {
        return view('shop::livewire.product-page');
    }
}
