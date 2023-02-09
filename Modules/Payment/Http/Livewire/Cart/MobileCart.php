<?php

namespace Modules\Payment\Http\Livewire\Cart;

use Jackiedo\Cart\Facades\Cart;
use Livewire\Component;

class MobileCart extends Component
{
    protected $listeners = ['cartUpdated' => '$refresh'];
    protected $carts;

    public function redirectToPayment()
    {
        $this->emit("header_payment");
    }
    public function render()
    {
        $carts = $this->carts = Cart::name('shopping')->getItems();
        return view('payment::livewire.cart.mobile-cart', compact('carts'));
    }
}
