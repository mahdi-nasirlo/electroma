<div>
    @if ($count)
        <section class="section">
            <div class="container">

                <livewire:payment::cart.cart-list />


                <div class="row">
                    <div class="col-lg-4 col-md-6 ms-auto mt-4 pt-2">
                        <div class="table-responsive bg-white rounded shadow">
                            <table class="table table-center table-padding mb-0">
                                <tbody>
                                    <tr>
                                        <td class="h6">مجموع </td>
                                        <td class="text-center fw-bold">{{ number_format($cartTotalPrice) }} تومان</td>
                                    </tr>
                                    <tr>
                                        <td class="h6">هزینه پست </td>
                                        <td class="text-center fw-bold">
                                            @if ($cartTotalPrice > env('DELIVERY_PRICE_MIN_CON'))
                                                رایگان
                                            @else
                                                {{ number_format(env('DELIVERY_PRICE')) }} تومان
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td class="h6">مجموع </td>
                                        <td class="text-center fw-bold">
                                            {{ number_format($cartTotalPrice + (int) ($cartTotalPrice > env('DELIVERY_PRICE_MIN_CON') ? 0 : env('DELIVERY_PRICE'))) }}
                                            تومان</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4 pt-2 text-end">
                            @auth
                                <button wire:click='payment' class="btn btn-primary">ادامه به پرداخت </button>
                            @endauth
                            @guest
                                <a href="#" class="btn btn-primary"> لطفا وارد شوید </a>
                            @endguest
                            <a href="javascript:void(0)" class="btn btn-soft-primary ms-2">
                                <span>بروز رسانی سبد</span>
                                <div style="width: 25px; height: 25px" wire:loading class="spinner-grow" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
            </div>
            <!--end container-->
        </section>
    @else
        <div class="section section-padding-bottom">
            <div class="container">
                <div style=" display: flex;flex-direction: column;align-content: center;" class="cart-empty-content">
                    <span class="icon text-center">
                        <x-icon-o-shopping-bag class="h-25 w-25" />
                    </span>
                    <h3 class="title text-center">سبد خرید شما در حال حاضر خالی است.</h3>

                    <a style="margin: 0 auto" href="{{ route('home') }}"
                        class="btn btn-primary btn-hover-secondary mx-auto">برگشت
                        به صفحه اصلی</a>
                </div>
            </div>
        </div>
    @endif
</div>
