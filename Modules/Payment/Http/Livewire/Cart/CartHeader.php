<?php

namespace Modules\Payment\Http\Livewire\Cart;

use Illuminate\Support\Facades\Log;
use Jackiedo\Cart\Facades\Cart;
use Livewire\Component;

class CartHeader extends Component
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
        Log::info("cart header is listen", [$carts]);
        return view('payment::livewire.cart.cart-header', compact('carts'));
    }
}
