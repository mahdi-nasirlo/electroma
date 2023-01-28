<div>
    <div>
        @php
            $cart = Jackiedo\Cart\Facades\Cart::name('shopping');
            $countOfCart = (int) $cart->getDetails()->items_count;
            $totalPrice = (int) $cart->getDetails()->total;
        @endphp
        <style>
            .cartBtn {
                background-color: #555;
                color: white;
                text-decoration: none;
                padding: 15px 26px;
                position: relative;
                display: inline-block;
                border-radius: 2px;
            }

            .cartBtn:hover {
                background: red;
            }

            .cartBtn .badge {
                position: absolute;
                top: -10px;
                right: -10px;
                padding: 5px 8px;
                border-radius: 50%;
                background: var(--orange);
                color: white;
            }
        </style>
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
                                @include('payment::cart.cart-header-item')
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
