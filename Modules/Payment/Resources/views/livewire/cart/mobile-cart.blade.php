<li class="has-submenu">
    @php
        $cart = Jackiedo\Cart\Facades\Cart::name('shopping');
        $totalPrice = (int) $cart->getDetails()->total;
    @endphp
    <a href="#" data-submenu="stores">
        <x-icon-o-shopping-cart />

        @if ((int) $cart->getDetails()->items_count)
            <span class="badge bg-warning">{{ (int) $cart->getDetails()->items_count }}</span>
        @endif
        سبد خرید
    </a>

    <div id="stores" class="submenu">
        <div class="submenu-header">
            <a href="#" data-submenu-close="stores">منو اصلی</a>
        </div>

        <label class="mx-1">سبد خرید</label>
        <ul>
            @if ((int) $cart->getDetails()->items_count)
                <div class="pb-4">
                    @foreach ($carts as $cart)
                        @if ($cart->getModel() instanceof \Modules\Shop\Entities\Product)
                            <li class="px-1">
                                <a href="{{ route('shop.product.single', $cart->getModel()) }}"
                                    class="d-flex align-items-center">
                                    <img data-src="{{ asset('/storage/' . $cart->getModel()->cover) }}"
                                        class="shadow rounded" style="max-height: 64px;" alt="">
                                    <div class="flex-1 text-start ms-3">
                                        <h6 class="text-dark mb-0">
                                            {{ $cart->getModel()->name }}
                                        </h6>
                                        <p class="text-muted mb-0">
                                            @if ($cart->getModel()->discountItem)
                                                {{ number_format((int) $cart->getModel()->price) }} تومان
                                                |
                                            @endif
                                            {{ $cart->get('quantity') }} عدد
                                        </p>
                                    </div>
                                    <h6 class="text-dark mb-0">
                                        {{ number_format((int) $cart->getModel()->discounted_price) }} تومان</h6>
                                </a>
                            </li>
                        @else
                            <li class="px-1">
                                <a href="{{ route('course.single', $cart->getModel()) }}"
                                    class="d-flex align-items-center my-4">
                                    <img data-src="{{ asset('/storage/' . $cart->getModel()->image) }}"
                                        class="shadow rounded" style="max-height: 30px;" alt="">
                                    <div class="flex-1 text-start ms-3">
                                        <h6 class="text-dark mb-0">{{ $cart->getModel()->title }}</h6>
                                        @if ($cart->getModel()->discountItem)
                                            <p class="text-muted mb-0">
                                                {{ number_format((int) $cart->getModel()->price) }}
                                                هزار
                                                تومان</p>
                                        @endif
                                    </div>
                                    <h6 class="text-dark mb-0">
                                        {{ number_format((int) $cart->getModel()->discounted_price) }} تومان
                                    </h6>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </div>

                <li class="mx-2">
                    <div class="d-flex align-items-center justify-content-between pt-4 border-top">
                        <h6 class="text-dark mb-0">مجموع (تومان):</h6>
                        <h6 class="text-dark mb-0">{{ number_format($totalPrice) }} تومان</h6>
                    </div>

                    <div class="mt-3 text-center">
                        <a href="{{ route('cart.index') }}" class="btn btn-primary me-2">نمایش سبد خرید </a>
                        <button wire:click='redirectToPayment' class="btn btn-primary">پرداخت </button>
                    </div>
                </li>
            @else
                <li>
                    سبد خرید شما خالی است.
                </li>
            @endif
        </ul>
    </div>
</li>
