<?php

namespace Modules\Payment\Http\Livewire\Cart;

use Livewire\Component;
use Modules\Payment\Entities\Discount as EntitiesDiscount;
use Modules\Payment\Entities\Order;

class Discount extends Component
{
    public $code;
    public $order;
    public $discount = null;

    public function mount(Order $order)
    {
        $this->order = $order;
        if ($order->discount_percent) {
            $this->code = false;
            $this->discount = $order->discount_percent;
        }
    }

    protected $rules = [
        'code' => 'required|exists:discounts,code',
    ];

    public function checkDiscount()
    {
        $this->validate();

        if ($this->discount) {
            session()->flash("discountError", " کد تخفیف قبلا اعمال شده است.");
        } else {
            $discount = EntitiesDiscount::where("code", $this->code)->whereDate('expired_at', ">", date("Y-m-d h:i:s"));

            if ($discount->count() > 0) {

                $this->order->update([
                    'discount_percent' => $discount->first()->percent
                ]);

                $this->discount = $discount->first()->percent;
            } else
                session()->flash("discountError", "کد تایید قابل استفاده نمی باشد.");
        }
    }

    public function render()
    {
        return view('payment::livewire.cart.discount');
    }
}
