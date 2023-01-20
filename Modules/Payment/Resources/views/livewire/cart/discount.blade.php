<div class="col-lg-5 col-md-6 mt-4 mt-sm-0 pt-2 pt-sm-0">
    <div class="rounded shadow-lg p-4">
        <div class="d-flex mb-4 justify-content-between">
            <h5> آیتم {{ $order->orderItems->count() }}</h5>
            <a href="{{ route('profile', ['tab' => 'order']) }}" class="text-muted h6">نمایش جزئیات</a>
        </div>
        <div class="table-responsive">
            <table class="table table-center table-padding mb-0">
                <tbody>
                    <tr>
                        <td class="h6 border-0">مجموع </td>
                        <td class="text-end fw-bold border-0">{{ number_format($order->price_without_delivery) }}
                            تومان</td>
                    </tr>
                    @if ($discount)
                        <tr>
                            <td class="h6"> تخفیف </td>
                            <td class="text-end fw-bold">
                                {{ number_format($order->amount_of_discount) }} تومان
                            </td>
                        </tr>
                    @endif
                    <tr>
                        <td class="h6">هزینه حمل و نقل</td>
                        <td class="text-end fw-bold"> {{ number_format(config('shop.delivery_price')) ?? 'رایگان' }}
                            تومان
                        </td>
                    </tr>
                    <tr class="bg-light">
                        <td class="h5 fw-bold">مبلغ نهایی </td>
                        <td class="text-end text-primary h4 fw-bold">
                            {{ number_format($order->total_price) }} تومان</td>
                    </tr>
                </tbody>
            </table>

            <div class="mt-4 pt-2">
                @if ($discount)
                    <div style="margin-top: 10px" class="alert alert-success">
                        کد تخفیف {{ $discount }} درصدی اعمال شده است .
                    </div>
                @else
                    <form wire:submit.prevent='checkDiscount' action="">
                        <div style="align-items: center" class="d-flex">
                            <div style="" class="my-3 mb-1 w-100">
                                <label class="form-label">کد تخفیف<span class="text-danger">*</span></label>
                                <input wire:model="code" type="text" name="city" id="city"
                                    class="form-control">

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
                            <div style="margin-top: 10px" class="alert alert-danger">
                                {{ session('discountError') }}
                            </div>
                        @endif
                    </form>
                @endif
            </div>
            <div class="mt-4 pt-2">
                <livewire:payment::cart.payment-btn :order="$order" />
            </div>
        </div>
    </div>
</div>
