<?php

namespace Modules\Shop\Http\Livewire;

use Jackiedo\Cart\Facades\Cart;
use Livewire\Component;
use Modules\Shop\Entities\Product;

class ProductCart extends Component
{
    public Product $product;
    public $new_price;
    public $has_inventory;

    public function mount($product)
    {
        $this->has_inventory = $product->inventory > 0;
        $this->product = $product;
    }

    protected function cartItem()
    {
        return collect(Cart::name('shopping')->getItems([
            'title' => $this->product->name,
            'id' => $this->product->id
        ]))->first();
    }

    public function addToCart()
    {
        if (!$this->cartItem() and $this->has_inventory) {
            $this->product->addToCart(
                'shopping',
                [
                    "id" => $this->product->id,
                    'title' => $this->product->name,
                    "price" => $this->updateNewPrice(),
                    'quantity' => 1
                ]
            );
        }

        $this->emit('cartUpdated');
    }

    private function updateNewPrice()
    {
        $product = $this->product;

        $price_levels = collect($product->tiered_price)->sortByDesc('quantity');

        $selected_level = $price_levels->first(function ($level) {
            return 1 > $level['quantity'] and $level['price'] < $this->product->price;
        });

        $this->new_price = $selected_level ? $selected_level['price'] : $product->price;

        return $this->new_price;
    }

    public function render()
    {
        return view('shop::livewire.product-cart');
    }
}
