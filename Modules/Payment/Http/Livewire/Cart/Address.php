<?php

namespace Modules\Payment\Http\Livewire\Cart;

use Livewire\Component;
use Modules\Payment\Entities\Order;

class Address extends Component
{
    protected $listeners = ['checkUserInfo' => 'payment'];

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

    public function payment(Order $order)
    {
        $this->validate();

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


        return redirect(route("payment.index", $order));
    }


    public function mount()
    {
        $user = auth()->user();

        $this->name = $user->last_name;
        $this->state = $user->state;
        $this->city = $user->city;
        $this->address = $user->address;
        $this->post = $user->post;
        $this->mobile = $user->mobile;
    }

    public function saveinformation()
    {
        $this->validate();

        auth()->user()->update(
            [
                'last_name' => $this->name,
                'state' => $this->state,
                'city' => $this->city,
                'address' => $this->address,
                'post' => $this->post,
                'mobile' => $this->mobile
            ]
        );

        session()->flash("message", "اطلاعات با موفقیت ثبت شد.");
    }

    public function render()
    {
        return view('payment::livewire.cart.address');
    }
}
