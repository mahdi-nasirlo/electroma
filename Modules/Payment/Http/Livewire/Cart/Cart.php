<?php

namespace Modules\Payment\Http\Livewire\Cart;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Jackiedo\Cart\Facades\Cart as FacadesCart;
use Livewire\Component;

class Cart extends Component
{
    use AuthorizesRequests;

    protected $listeners = [
        'cartUpdated' => '$refresh',
        'header_payment' => 'payment'
    ];

    public function payment()
    {
        $totalPrice = FacadesCart::name("shopping")->getDetails()->total;
        $deliveryPrice = $totalPrice >  env('DELIVERY_PRICE_MIN_CON') ? 0 : $totalPrice;
        $totalPriceWithDelivery = $totalPrice + $deliveryPrice;

        $order =  auth()->user()->orders()->create([
            'price' => $totalPriceWithDelivery,
            'status' => 'unpaid'
        ]);

        $cartItems = collect(FacadesCart::name("shopping")->getItems())->map(function ($item) {
            return [
                'orderable_id' => $item->get('id'),
                'orderable_type' => get_class($item->getModel()),
                'price' => $item->getModel()->price
            ];
        })->toArray();

        $order->orderItems()->createMany($cartItems);

        FacadesCart::clearItems();

        $this->emit('addressUpdate');

        return redirect(route("cart.address", $order));
    }

    public function increment()
    {
        $this->count++;
    }

    public function render()
    {
        $cart = FacadesCart::name('shopping');
        $count = $cart->getDetails()->items_count;
        $cartTotalPrice = $cart->getDetails()->total;

        return view('payment::livewire.cart.cart', compact('cartTotalPrice', 'count', 'cart'));
    }
}
