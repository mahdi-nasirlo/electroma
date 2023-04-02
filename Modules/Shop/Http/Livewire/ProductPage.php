<?php

namespace Modules\Shop\Http\Livewire;

use Jackiedo\Cart\Facades\Cart;
use Livewire\Component;
use Modules\Shop\Entities\Product;

class ProductPage extends Component
{
    public Product $product;
    public $count = 1;
    public $new_price;

    public function mount()
    {
        $cartItems = $this->cartItem();

        $this->updateNewPrice();

        if ($cartItems)
            $this->count = $cartItems->get('quantity');
        else
            $this->count = 1;
    }

    protected function cartItem()
    {
        return collect(Cart::name('shopping')->getItems([
            'title' => $this->product->name,
            'id' => $this->product->id
        ]))->first();
    }

    public function increment()
    {
        if ($this->product->inventory > $this->count) {
            $this->count++;
            $this->updateNewPrice();
        }
    }

    public function decrement()
    {
        if ($this->count > 1) {
            $this->count--;
            $this->updateNewPrice();
        }
    }

    private function updateNewPrice()
    {
        $product = $this->product;

        $price_levels = collect($product->tiered_price);

        $selected_level = $price_levels->first(function ($level) {
            return $this->count > $level['quantity'] and $level['price'] < $this->product->price;
        });

        $this->new_price = $selected_level ? $selected_level['price'] : $product->price;

        return $this->new_price;
    }

    public function addToCart()
    {
        if (!$this->cartItem()) {
            $this->product->addToCart(
                'shopping',
                [
                    "id" => $this->product->id,
                    'title' => $this->product->name,
                    "price" => $this->updateNewPrice(),
                    'quantity' => $this->count
                ]
            );
        } else {
            $this->updateQuantity();
        }

        $this->emit('cartUpdated');
    }

    private function updateQuantity()
    {
        $new_price = $this->updateNewPrice();

        $hash = $this->cartItem()->getHash();
        Cart::name('shopping')->updateItem($hash, [
            'quantity' => $this->count,
            'price' => $new_price
        ]);

        $this->new_price = $this->cartItem()->getPrice();

        $this->emit('cartUpdated');
    }

    public function payment()
    {
        $this->addToCart();

        return redirect(route('cart.index'));
    }

    public function render()
    {
        return view('shop::livewire.product-page');
    }
}
