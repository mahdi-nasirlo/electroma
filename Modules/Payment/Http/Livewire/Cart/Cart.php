<?php

namespace Modules\Payment\Http\Livewire\Cart;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Cookie;
use Jackiedo\Cart\Facades\Cart as FacadesCart;
use Livewire\Component;
use Modules\Payment\Entities\Discount;
use Modules\Payment\Entities\Order;

class Cart extends Component
{
    use AuthorizesRequests;

    public $count;
    public $cartTotalPrice;

    public $code;
    public $discount = null;

    protected $listeners = [
        'cartUpdated' => '$refresh',
        'header_payment' => 'payment'
    ];

    protected $rules = [
        'code' => 'required|exists:discounts,code',
    ];

    public function mount()
    {
        $discount = Cookie::get('cart_discount_id');

        if ($discount) {
            $discount =  Discount::find($discount);
            $this->discount = $discount;
            $this->code = $discount->code;
        }
    }

    public function checkDiscount()
    {
        $this->validate();

        if ($this->discount) {
            return session()->flash("discountError", " کد تخفیف قبلا اعمال شده است.");
        }

        $discount = Discount::where("code", $this->code)
            ->whereDate('expired_at', ">", date("Y-m-d h:i:s"))
            ->where(function ($query) {
                $query->where('limit_on_use', '>', 0)
                    ->orWhereNull('limit_on_use');
            })
            ->first();

        if (!$discount) {
            return session()->flash("discountError", "کد تخفیف منقضی شده است.");
        }

        if ($discount && $discount->min_order_value >= $this->cartTotalPrice) {
            return session()->flash("discountError", "حداقل هزینه اعمال کد تخفیف " . number_format($discount->min_order_value) . " تومان می باشد.");
        }

        Cookie::queue("cart_discount_id", $discount->id);

        $this->discount = $discount;

        if ($discount->type == 'percent') {
            return session()->flash('discount', "کد تخفیف $discount->discount_value درصدی اعمال شد.");
        }

        if ($discount->type == 'value') {
            return session()->flash('discount', "کد تخفیف " . number_format($discount->discount_value) . " تومانی اعمال شد.");
        }
    }

    protected function updateDiscount(): void
    {
        if ($this->discount & $this->discount->limit_on_use) {
            Discount::update(['discount_value' => $this->discount->limit_on_use--]);
        }
    }


    public function payment()
    {
        // $totalPrice = FacadesCart::name("shopping")->getDetails()->total;
        // $deliveryPrice = $totalPrice >  env('DELIVERY_PRICE_MIN_CON') ? 0 : $totalPrice;
        // $totalPriceWithDelivery = $totalPrice + $deliveryPrice;

        // $order = [
        //     'price' => $totalPriceWithDelivery,
        //     'status' => 'unpaid'
        // ];

        // if (auth()->check()) {
        //     $order['user_id'] = auth()->user()->id;
        // }

        // $order =  Order::create($order);

        // $cartItems = collect(FacadesCart::name("shopping")->getItems())->map(function ($item) {
        //     return [
        //         'orderable_id' => $item->get('id'),
        //         'orderable_type' => get_class($item->getModel()),
        //         'price' => $item->getModel()->price
        //     ];
        // })->toArray();

        // $order->orderItems()->createMany($cartItems);

        // FacadesCart::clearItems();

        // $this->emit('addressUpdate');

        return redirect(route("cart.guestPay")); //, $order
    }

    public function render()
    {
        $cart = FacadesCart::name('shopping');
        $this->count = $cart->getDetails()->items_count;
        $this->cartTotalPrice = $cart->getDetails()->total;

        $discount_value = 0;

        if ($this->discount)
            $discount_value = $this->discount->type == 'percent'
                ? $this->cartTotalPrice - ($this->cartTotalPrice * ($this->discount->discount_value / 100))
                : $this->discount->min_order_value;


        return view('payment::livewire.cart.cart', compact('discount_value'));
    }
}
