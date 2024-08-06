<?php

namespace Modules\Shop\Http\Livewire;

use Illuminate\Support\Facades\Log;
use Jackiedo\Cart\Facades\Cart;
use Livewire\Component;
use Modules\Shop\Entities\Product;

class ProductPage extends Component
{
    public Product $product;
    public $count = 1;
    public $new_price;

    public function mount()
    {
        $cartItems = $this->cartItem();

        if ($cartItems)
            $this->count = $cartItems->get('quantity');
        else
            $this->count = 1;

        $this->updateNewPrice();
    }

    protected function cartItem()
    {
        return collect(Cart::name('shopping')->getItems([
            'title' => $this->product->name,
            'id' => $this->product->id
        ]))->first();
    }

    public function increment()
    {
        if ($this->product->inventory > $this->count) {
            $this->count++;
            $this->updateNewPrice();
        }
    }

    public function decrement()
    {
        if ($this->count > 1) {
            $this->count--;
            $this->updateNewPrice();
        }
    }

    public function changeQuantity()
    {
        if ($this->product->inventory < $this->count) {
            $this->count = $this->product->inventory;

            session()->flash('cart_message', ['status' => 'danger', 'text' => 'موجودی کالا کافی نمی باشد.']);
        } elseif ($this->count < 0) {
            $this->count = 1;

            session()->flash('cart_message', ['status' => 'danger', 'text' => 'مقدار نامعتبر است.']);
        }

        $this->updateNewPrice();
    }

    private function updateNewPrice()
    {
        $product = $this->product;

        $price_levels = collect($product->tiered_price)->sortByDesc('quantity');

        $selected_level = $price_levels->first(function ($level) {
            return $this->count > $level['quantity'] and $level['price'] < $this->product->price;
        });

        $this->new_price = $selected_level ? $selected_level['price'] : $product->price;

        return $this->new_price;
    }


    public function addToCart()
    {
        Log::info("product page cart updated", [$this->cartItem(), $this->product]);
        if (!$this->cartItem()) {
            $this->product->addToCart(
                'shopping',
                [
                    "id" => $this->product->id,
                    'title' => $this->product->name,
                    "price" => $this->updateNewPrice(),
                    'quantity' => $this->count
                ]
            );
        } else {
            $this->updateQuantity();
        }
        Log::info("product page after log create", [Cart::name('shopping')->getItems(), $this->product]);

        $this->emit('cartUpdated');

        if ($this->cartItem()) {
            session()->flash('cart_message', ['status' => 'success', 'text' => 'تعداد محصول در سبد خرید به (' . $this->count . ' عدد) با موفقیت بروزرسانی شد.']);
        } else {
            session()->flash('cart_message', ['status' => 'success', 'text' => 'محصول (' . $this->count . ' عدد) با موفقیت اضافه شد.']);
        }
    }

    private function updateQuantity()
    {
        $new_price = $this->updateNewPrice();

        $hash = $this->cartItem()->getHash();
        Cart::name('shopping')->updateItem($hash, [
            'quantity' => $this->count,
            'price' => $new_price
        ]);

        $this->new_price = $this->cartItem()->getPrice();

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
