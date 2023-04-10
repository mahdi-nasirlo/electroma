<?php

namespace Modules\Payment\Http\Livewire\Cart;

use Jackiedo\Cart\Facades\Cart;
use Jackiedo\Cart\Item;
use Livewire\Component;
use Modules\Shop\Entities\Product;

class CartItem extends Component
{
    protected  $cartItem;

    public $product;
    public $hash;
    public $new_price;
    public $is_removed = false;

    public $count = 1;

    public function mount(Product $cartItem, $hash)
    {
        $this->product = $cartItem;
        $this->hash = $hash;
        $this->count = $this->cartItem()->getQuantity();
        $this->new_price = $this->cartItem()->getPrice();
    }

    protected function cartItem()
    {
        return collect(Cart::name('shopping')->getItems([
            'title' => $this->product->name,
            'id' => $this->product->id
        ]))->first();
    }

    public function removeCart()
    {
        $hash = $this->cartItem()->getHash();

        Cart::name('shopping')->removeItem($hash);
        $this->emit('cartUpdated');

        $this->is_removed = true;
    }

    public function increment()
    {
        if ($this->product->inventory > $this->count) {
            $this->count++;
            $this->updateQuantity();
        }
    }

    public function decrement()
    {
        if ($this->count > 1) {
            $this->count--;
            $this->updateQuantity();
        }
    }

    private function getNewPrice()
    {
        $product = $this->product;

        $price_levels = collect($product->tiered_price)->sortByDesc('quantity');

        $selected_level = $price_levels->first(function ($level) {
            return $this->count > $level['quantity'] and $level['price'] < $this->product->price;
        });

        return $selected_level ? $selected_level['price'] : $product->discounted_price;
    }

    public function changeQuantity()
    {
        if ($this->product->inventory < $this->count) {
            $this->count = (int) $this->product->inventory;

            session()->flash('cart_message', ['status' => 'danger', 'text' => 'موجودی کالا کافی نمی باشد.']);
        } elseif ($this->count < 0) {
            $this->count = 1;

            session()->flash('cart_message', ['status' => 'danger', 'text' => 'مقدار نامعتبر است.']);
        }

        $this->getNewPrice();
    }

    private function updateQuantity()
    {
        $new_price = $this->getNewPrice();

        $hash = $this->cartItem()->getHash();
        Cart::name('shopping')->updateItem($hash, [
            'quantity' => $this->count,
            'price' => $new_price
        ]);

        $this->new_price = $this->cartItem()->getPrice();

        $this->emit('cartUpdated');
    }

    public function render()
    {
        return view('payment::livewire.cart.cart-item');
    }
}
