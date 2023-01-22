<?php

namespace Modules\Course\Http\Livewire;

use Jackiedo\Cart\Facades\Cart as FacadesCart;
use Livewire\Component;

class Cart extends Component
{
    public $course;
    public $btnText = "ثبت نام در دروه";
    public $link = "#";

    public function mount($course)
    {
        $this->course = $course;

        if (FacadesCart::name("shopping")->getItems(['id' => $this->course->id])) {
            $this->btnText = 'ثبت و نهایی سازی خرید     <span style="font-size: 18px">&#10003;</span>';
            $this->link = route("cart.index");
        }
    }


    public function addToCart()
    {
        if (empty(FacadesCart::name("shopping")->getItems(['id' => $this->course->id]))) {

            $cart = $this->course->addToCart(
                'shopping',
                [
                    "id" => $this->course->id,
                    "price" => $this->course->price,
                    'quantity' => 1
                ]
            );

            if ($this->course->discountItem) {
                $cart = FacadesCart::name('shopping');

                $action = $cart->applyAction([
                    'id' => $this->course->id,
                    'title' => 'Discount 10%',
                    'value' => '-' . $this->course->discountItem->percent . '%'
                ]);
            }
        }

        $this->btnText = 'ثبت و نهایی سازی خرید     <span style="font-size: 18px">&#10003;</span>';
        $this->link = route("cart.index");

        $this->emit('cartUpdated');
    }

    public function render()
    {
        return view('course::livewire.cart');
    }
}
