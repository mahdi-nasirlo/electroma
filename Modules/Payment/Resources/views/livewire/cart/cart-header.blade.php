<div>
    <div>
        @php
            $cart = Jackiedo\Cart\Facades\Cart::name('shopping');
            $countOfCart = (int) $cart->getDetails()->items_count;
            $totalPrice = (int) $cart->getDetails()->total;
        @endphp
        <li class="has-submenu parent-menu-item d-flex ms-1">
            <div class="dropdown">
                <button style="box-shadow: none" type="button" class="btn px-2 py-1 mt-3 btn-soft-primary cartBtn"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <x-icon-o-shopping-cart />

                    @if ($countOfCart)
                        <span class="badge bg-warning">{{ $countOfCart }}</span>
                    @endif
                </button>
                <div class="dropdown-menu dd-menu dropdown-menu-end bg-white rounded border mt-3 p-4"
                    style="width: 350px; margin: 0px;">
                    @if ($countOfCart)
                        <div class="pb-4">
                            @foreach ($carts as $cart)
                                @if ($cart->getModel() instanceof \Modules\Shop\Entities\Product)
                                    <a href="{{ route('shop.product.single', $cart->getModel()) }}"
                                        class="d-flex align-items-center">
                                        <img src="{{ asset('/storage/' . $cart->getModel()->cover) }}"
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
                                    {{-- <a href="{{ route('shop.product.single', $cart->getModel()) }}" class="d-flex align-items-center my-4">
        <img src="{{ asset('/storage/' . $cart->getModel()->cover) }}" class="shadow rounded" style="max-height: 30px;"
            alt="">
        <div class="flex-1 text-start ms-3">
            <h6 class="text-dark mb-0">{{ $cart->getModel()->name }}</h6>
            @if ($cart->getModel()->discountItem)
                <p class="text-muted mb-0">{{ number_format((int) $cart->getModel()->price) }}
                    هزار
                    تومان</p>
            @endif
        </div>
        <h6 class="text-dark mb-0">
            {{ number_format((int) $cart->getModel()->discounted_price) }} × {{ $cart->get('quantity') }} تومان
        </h6>
    </a> --}}
                                @else
                                    <a href="{{ route('course.single', $cart->getModel()) }}"
                                        class="d-flex align-items-center my-4">
                                        <img src="{{ asset('/storage/' . $cart->getModel()->image) }}"
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
                                @endif

                                {{-- 
    TODO add discount on items
    TODO display count of product in cart
    FIXME fix price of course in cart
    TODO add discount on producgt
 --}}
                            @endforeach
                        </div>

                        <div class="d-flex align-items-center justify-content-between pt-4 border-top">
                            <h6 class="text-dark mb-0">مجموع (تومان):</h6>
                            <h6 class="text-dark mb-0">{{ number_format($totalPrice) }} تومان</h6>
                        </div>

                        <div class="mt-3 text-center">
                            <a href="{{ route('cart.index') }}" class="btn btn-primary me-2">نمایش سبد خرید </a>
                            <button wire:click='redirectToPayment' class="btn btn-primary">پرداخت </button>
                        </div>
                    @else
                        <div style=" display: flex;flex-direction: column;align-content: center;"
                            class="cart-empty-content">
                            <span class="icon text-center">
                                <x-icon-o-shopping-bag class="h-25 w-25" />
                            </span>
                            <h6 class="title text-center">سبد خرید شما در حال حاضر خالی است.</h6>
                        </div>
                    @endif
                </div>
        </li>
    </div>
</div>
