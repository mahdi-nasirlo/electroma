<?php

namespace Modules\Payment\Http\Livewire\Cart;

use Livewire\Component;
use Modules\Payment\Entities\Order;

class PaymentBtn extends Component
{

    public Order $order;

    public function mount($order)
    {
        $this->order = $order;
    }


    public function checkUserInfo()
    {
        $this->emit('checkUserInfo', $this->order);
    }

    public function render()
    {
        return view('payment::livewire.cart.payment-btn');
    }
}
