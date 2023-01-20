@extends('layouts.master')


@section('content')
    <div>
        @include('blog::hero.index', ['name' => 'صندوق'])

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
                            @if ($cartTotalPrice > env('DELIVERY_PRICE_MIN_CON'))
                                <div class="alert alert-light" role="alert"> یک هشدار نور ساده - آن را بررسی کنید!</div>
                            @endif
                            <h5 class="mb-0">جزئیات صورتحساب :</h5>

                            <livewire:payment::cart.address />

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

                    <livewire:payment::cart.discount :order='$order' />
                </div>
            </div>
            <!--end row-->
        </section>
    </div>
@endsection
