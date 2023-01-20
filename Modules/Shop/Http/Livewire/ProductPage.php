<?php

namespace Modules\Shop\Http\Livewire;

use Jackiedo\Cart\Facades\Cart;
use Livewire\Component;
use Modules\Shop\Entities\Product;

class ProductPage extends Component
{
    public Product $product;
    public $count = 1;


    public function mount()
    {
        $cartItems = collect(Cart::name("shopping")->getItems([
            'associated_class' => 'App\Models\Shop\Product',
            'id' => $this->product->id
        ]));

        if ($cartItems->isEmpty())
            $this->count = 1;
        else
            $this->count = $cartItems->first()->get('quantity');
    }

    public function increment()
    {
        if ($this->product->inventory > $this->count) {
            $this->count++;
        }
    }

    public function decrement()
    {
        if ($this->count > 1) {
            $this->count--;
        }
    }

    public function addToCart()
    {
        $cart = collect(Cart::name("shopping")->getItems([
            'associated_class' => 'App\Models\Shop\Product',
            'id' => $this->product->id
        ]));

        if ($cart->isEmpty()) {
            $this->product->addToCart(
                'shopping',
                [
                    "id" => $this->product->id,
                    'title' => $this->product->name,
                    "price" => $this->product->price,
                    'quantity' => $this->count
                ]
            );

            if ($this->product->discountItem) {
                $cart = Cart::name('shopping');

                $action = $cart->applyAction([
                    'id' => $this->product->id,
                    'title' => 'Discount 10%',
                    'value' => '-' . $this->product->discountItem->percent . '%'
                ]);
            }
        } else {
            Cart::name("shopping")->updateItem($cart->first()->getHash(), [
                'quantity' => $this->count
            ]);
        }

        $this->emit('cartUpdated');
    }

    public function payment()
    {
        $this->addToCart();

        return redirect(route('cart.index'));
    }

    public function render()
    {
        return view('shop::livewire.product-page');
    }
}
