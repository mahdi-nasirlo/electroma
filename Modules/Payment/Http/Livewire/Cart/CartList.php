<?php

namespace Modules\Payment\Http\Livewire\Cart;

use Jackiedo\Cart\Facades\Cart;
use Livewire\Component;

class CartList extends Component
{
    protected $cartItems = [];


    public function removeCart($hash)
    {
        Cart::name("shopping")->removeItem($hash);
        $this->emit('cartUpdated');
    }

    public function render()
    {
        $cartItems = $this->cartItems = Cart::name("shopping")->getItems();
        return view('payment::livewire.cart.cart-list', compact('cartItems'));
    }
}
