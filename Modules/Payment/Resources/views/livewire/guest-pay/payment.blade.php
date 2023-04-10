<div>
    <!-- Start -->
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-6">
                    <div class="rounded shadow-lg p-4">
                        @php
                            $cart = Jackiedo\Cart\Facades\Cart::name('shopping');
                            $cartTotalPrice = $cart->getDetails()->total;
                        @endphp
                        {{-- @if ($cartTotalPrice > env('DELIVERY_PRICE_MIN_CON'))
                            <div class="alert alert-light" role="alert"> یک هشدار نور ساده - آن را بررسی کنید!</div>
                        @endif --}}
                        <h5 class="mb-0">جزئیات صورتحساب :</h5>
                        <div>
                            <form wire:submit.prevent='saveinformation' class="mt-4">
                                <div class="row">
                                    @if (session()->has('message'))
                                        <div style="margin-top: 10px" class="alert alert-success">
                                            {{ session('message') }}
                                        </div>
                                    @endif

                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label class="form-label">نام تحویل گیرنده <span
                                                    class="text-danger">*</span></label>
                                            <input wire:model='name' name="name" id="firstname" type="text"
                                                class="form-control" placeholder="نام اول :">
                                            @if ($errors->has('name'))
                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label class="form-label">آدرس خیابان <span
                                                    class="text-danger">*</span></label>
                                            <input wire:model='address' type="text" name="address1" id="address1"
                                                class="form-control" placeholder="شماره خانه و نام خیابان :">
                                            @if ($errors->has('address'))
                                                <span class="text-danger">{{ $errors->first('address') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">شهر / منطقه <span
                                                    class="text-danger">*</span></label>
                                            <input wire:model='city' type="text" name="city" id="city"
                                                class="form-control" placeholder="نام شهر :">
                                            @if ($errors->has('city'))
                                                <span class="text-danger">{{ $errors->first('city') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <!--end col-->

                                    <!--end col-->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">منطقه <span class="text-danger">*</span></label>
                                            <input wire:model='state' type="text" name="state" id="state"
                                                class="form-control" placeholder="نام شهر :">
                                            @if ($errors->has('state'))
                                                <span class="text-danger">{{ $errors->first('state') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <!--end col-->

                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label class="form-label">تلفن همراه <span
                                                    class="text-danger">*</span></label>
                                            <input wire:model='mobile' type="text" name="phone" id="phone"
                                                class="form-control">
                                            @if ($errors->has('mobile'))
                                                <span class="text-danger">{{ $errors->first('mobile') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">کد پستی <span class="text-danger">*</span></label>
                                            <input wire:model='post' type="text" name="postcode" id="postcode"
                                                class="form-control" placeholder="کد پستی :">
                                            @if ($errors->has('post'))
                                                <span class="text-danger">{{ $errors->first('post') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!--end row-->
                                <div class="mt-4 pt-2">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary">
                                            ذخیره
                                            <div style="width: 25px; height: 25px" wire:loading
                                                wire:target="saveinformation" class="spinner-grow" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                                <!--end form-->
                            </form>
                        </div>

                    </div>

                    <div class="rounded mt-5 shadow-lg p-4">
                        <div>
                            <label class="form-label">نظرات </label>
                            <textarea name="comments" id="comments" rows="4" class="form-control"
                                placeholder="یادداشت هایی در مورد سفارش شما :"></textarea>
                        </div>
                    </div>
                </div>
                <!--end col-->

                <div class="col-lg-5 col-md-6 mt-4 mt-sm-0 pt-2 pt-sm-0">
                    <div class="rounded shadow-lg p-4">
                        <div class="d-flex mb-4 justify-content-between">
                            {{-- <h5> آیتم {{ $order->orderItems->count() }}</h5> --}}
                            <a href="{{ route('cart.index') }}" class="text-muted h6">نمایش جزئیات</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-center table-padding mb-0">
                                <tbody>
                                    <tr>
                                        <td class="h6 border-0">مجموع </td>
                                        <td class="text-end fw-bold border-0">
                                            {{ number_format($totalPrice) }}
                                            تومان</td>
                                    </tr>
                                    <tr>
                                        <td class="h6">هزینه حمل و نقل</td>
                                        <td class="text-end fw-bold">
                                            {{ $deliveryPrice !== 0 ? number_format($deliveryPrice) . ' تومان ' : 'رایگان' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="h6">تخفیف</td>
                                        <td class="text-end fw-bold">
                                            {{ number_format($discount_value) }} تومان
                                        </td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td class="h5 fw-bold">مبلغ نهایی </td>
                                        <td class="text-end text-primary h4 fw-bold">
                                            {{ number_format($totalPrice + $deliveryPrice - (int) $discount_value) }}
                                            تومان
                                        </td>
                                    </tr>
                                </tbody>
                            </table>


                            @if ($deliveries->count())
                                <div class="text-muted h6 mt-4">
                                    روش ارسال
                                </div>
                                <ul class="list-unstyled mt-3 mb-0 px-0">
                                    @foreach ($deliveries as $delivery)
                                        <li class="{{ $loop->first ? '' : 'mt-3' }}"
                                            wire:click="selectDelivery({{ $delivery->id }})">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <div class="form-check mb-0">
                                                    <input class="form-check-input" type="radio"
                                                        name="flexRadioDefault" id="delivery_{{ $delivery->id }}"
                                                        {{ $selectedDelivery == $delivery->id ? 'checked' : '' }}>
                                                    <label class="form-check-label"
                                                        for="delivery_{{ $delivery->id }}">{{ $delivery->name }}
                                                        {{ $delivery->price != 0 ? ': ' . number_format($delivery->price) . ' تومان ' : '' }}

                                                    </label>
                                                    @if ($delivery->free_con)
                                                        <figcaption style="font-size: 13px" class="text-secondary">
                                                            رایگان برای سفارش بالای
                                                            {{ number_format($delivery->free_con) }}
                                                            تومان
                                                        </figcaption>
                                                    @endif
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                            @if (session()->has('delivery_error'))
                                <div style="margin-top: 10px" class="text-danger">
                                    {{ session('delivery_error') }}
                                </div>
                            @endif

                            <div class="pt-2">
                                @if ($discount)
                                    <div style="margin-top: 10px" class="alert alert-success">
                                        کد تخفیف
                                        {{ $discount->discount_value }}
                                        {{ $discount->type == 'value' ? 'تومانی' : 'درصدی' }}
                                        اعمال شده.
                                    </div>
                                @else
                                    <form wire:submit.prevent='checkDiscount' action="">
                                        <div style="align-items: center" class="d-flex">
                                            <div style="" class="my-3 mb-1 w-100">
                                                <label class="form-label">کد تخفیف<span
                                                        class="text-danger">*</span></label>
                                                <input wire:model="code" type="text" name="city"
                                                    id="city" class="form-control">

                                            </div>

                                            <button type="submit" style="margin-top: 43px;margin-right: 5px"
                                                class="btn btn-primary">اعمال</button>
                                        </div>
                                        @if ($errors->has('code'))
                                            <span class="text-danger">{{ $errors->first('code') }}</span>
                                        @endif
                                        @if (session()->has('discount'))
                                            <div style="margin-top: 10px" class="alert alert-success">
                                                {{ session('discount') }}
                                            </div>
                                        @endif
                                        @if (session()->has('discountError'))
                                            <div style="margin-top: 10px" class="text-danger">
                                                {{ session('discountError') }}
                                            </div>
                                        @endif
                                    </form>
                                @endif
                            </div>

                            <div class="mt-4 pt-2">
                                <div>
                                    <div class="d-grid">
                                        <button wire:click='payment' class="btn btn-primary">
                                            ثبت سفارش
                                            <div style="width: 25px; height: 25px" wire:loading wire:target='payment'
                                                class="spinner-grow" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!--end row-->
    </section>
</div>
