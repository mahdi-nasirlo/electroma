<?php

namespace Modules\Payment\Http\Livewire\GuestPay;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Jackiedo\Cart\Facades\Cart;
use Livewire\Component;
use Modules\Payment\Entities\Address;
use Modules\Payment\Entities\Delivery;
use Modules\Payment\Entities\Discount;
use Modules\Payment\Entities\Order;

class Payment extends Component
{
    public $selectedDelivery;
    public $deliveryPrice = 0;
    public $totalPrice = 0;
    public $discount_value  = 0;
    public $code;
    public $discount = null;

    public $name = "";
    public $city = "";
    public $state = "";
    public $address = "";
    public $post = "";
    public $mobile = "";

    protected $rules = [
        'name' => 'required|min:8',
        'state' => 'required',
        'city' => 'required',
        'address' => 'required',
        'post' => 'required',
        'mobile' => ['required'],
    ];

    public function payment() //Order $order
    {
        $this->validate();

        if (!$this->selectedDelivery) {
            return session()->flash('delivery_error', 'لطفا نوع حمل و نقل را تعیین کنید.');
        }

        $finalPrice = $this->totalPrice + $this->deliveryPrice - $this->discount_value;

        $order = [
            'price' => $finalPrice,
            'delivery_id' => $this->selectedDelivery,
            'status' => 'unpaid'
        ];

        $addressData = [
            'last_name' => $this->name,
            'state' => $this->state,
            'city' => $this->city,
            'address' => $this->address,
            'post' => $this->post,
            'mobile' => $this->mobile
        ];

        if (auth()->check()) {
            $order['user_id'] = auth()->user()->id;
            auth()->user()->update($addressData);
        } else {
            $address =  Address::create($addressData);
            $order['address_id'] = $address->id;
        }

        $order =  Order::create($order);

        $cartItems = collect(Cart::name("shopping")->getItems())->map(function ($item) {
            return [
                'orderable_id' => $item->get('id'),
                'orderable_type' => get_class($item->getModel()),
                'price' => $item->getPrice()
            ];
        })->toArray();

        $order->orderItems()->createMany($cartItems);

        Cart::clearItems();

        Cookie::forget('cart_discount_id');

        $this->emit('addressUpdate');

        return redirect(route("payment.index", $order));
    }


    public function mount()
    {
        // mount total price cart
        $this->totalPrice = Cart::name("shopping")->getDetails()->total;

        // get saved data for user data and delivery type
        $userData = json_decode(Cookie::get('guest_data'), true);
        $selectedDeliveryId = Cookie::get('guest_delivery');

        // set delivery price
        if ($selectedDeliveryId) {
            $delivery = Delivery::find($selectedDeliveryId);

            if (
                $delivery && $delivery->free_con && $delivery->free_con <= $this->totalPrice
            ) {
                $this->deliveryPrice = 0;
            } else {
                $this->deliveryPrice = $delivery ? $delivery->price : 0;
            }

            $this->selectedDelivery = $selectedDeliveryId;
        }

        // set user data
        if ($userData) {
            $this->name = $userData['last_name'];
            $this->state = $userData['state'];
            $this->city = $userData['city'];
            $this->address = $userData['address'];
            $this->post = $userData['post'];
            $this->mobile = $userData['mobile'];
        }

        $discount = Cookie::get('cart_discount_id');

        if ($discount) {
            $discount =  Discount::find($discount);
            $this->discount = $discount;
            $this->code = $discount->code;
        }
    }

    public function saveinformation()
    {
        $this->validate();

        $cookieData = [
            'last_name' => $this->name,
            'state' => $this->state,
            'city' => $this->city,
            'address' => $this->address,
            'post' => $this->post,
            'mobile' => $this->mobile
        ];

        Cookie::queue('guest_data', json_encode($cookieData));

        session()->flash("message", "اطلاعات با موفقیت ثبت شد.");
    }

    public function selectDelivery($deliveryId)
    {
        Cookie::queue('guest_delivery', (int) $deliveryId);

        $this->selectedDelivery = (int) $deliveryId;

        $delivery = Delivery::find($deliveryId);

        if ($delivery && $delivery->free_con && $delivery->free_con <= $this->totalPrice) {
            $this->deliveryPrice = 0;
        } else {
            $this->deliveryPrice = $delivery ? $delivery->price : 0;
        }
    }

    public function checkDiscount()
    {
        if ($this->discount) {
            return session()->flash("discountError", " کد تخفیف قبلا اعمال شده است.");
        }

        if (!$this->code) {
            return session()->flash("discountError", "لطفا کد تخفیف را وارد کنید.");
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

        if ($discount && $discount->min_order_value >= $this->totalPrice) {
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

    public function render()
    {
        $deliveries = Delivery::where('status', true)->get();

        if ($this->discount)
            $this->discount_value = $this->discount->type == 'percent'
                ? $this->totalPrice - ($this->totalPrice * ($this->discount->discount_value / 100))
                : $this->discount->min_order_value;

        return view('payment::livewire.guest-pay.payment', compact('deliveries'));
    }
}
