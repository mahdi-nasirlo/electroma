@extends('payment::message.html')

@section('content')
    <div style="margin: 50px 0;">
        <table cellpadding="0" cellspacing="0"
            style="direction: rtl; text-align: right; font-size: 15px; font-weight: 400; max-width: 600px; border: none; margin: 0 auto; border-radius: 6px; overflow: hidden; background-color: #fff; box-shadow: 0 0 3px rgba(60, 72, 88, 0.15);">
            <thead>
                <tr
                    style="background-color: #2f55d4; padding: 3px 0; line-height: 68px; text-align: center; color: #fff; font-size: 24px; letter-spacing: 1px;">
                    <th scope="col d-flex">
                        <span class="display-1" style="font-size: 20px !important; font-weight: bold">الکتروما - رسید
                            پرداخت</span>
                    </th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td style="padding: 24px 24px 0;">
                        <table cellpadding="0" cellspacing="0" style="border: none;">
                            <tbody>
                                <tr>
                                    <div>
                                        <p>از خرید و اعتماد شما به {{ env('APP_NAME') }} سپاس گزاریم. </p>
                                        <p style="width: 334px">در صورت داشتن هر گونه مشکل یا سوال با تیم پشتیبانی
                                            {{ env('APP_NAME') }} تماس
                                            بگیرید.</p>
                                    </div>
                                </tr>
                                <td style="padding: 15px 24px 15px; color: #8492a6;">
                                    {{ env('APP_NAME') }} <br> تیم پشتیبان
                                </td>
                                <tr>
                                    <td style="min-width: 130px; padding-bottom: 8px;">وضعیت پرداخت :</td>
                                    <td style="color: #8492a6; padding-bottom: 8px;">
                                        @switch($key = $order->status)
                                            @case($key == 'unpaid')
                                                @if ($order->orderHasPayment())
                                                    <span class="text-danger"> پرداخت ناموفق </span>
                                                @else
                                                    <span class="text-danger"> در انتظار پرداخت </span>
                                                @endif
                                            @break

                                            @case($key == 'paid')
                                                <span class="text-success"> پرداخت موفق </span>
                                            @break

                                            @case($key == 'preparation')
                                                <span class="text-info"> در حال آماده سازی </span>
                                            @break

                                            @case($key == 'posted')
                                                <span class="text-primary"> پست شد </span>
                                            @break

                                            @case($key == 'received')
                                                <span class="text-dark"> دریافت شده </span>
                                            @break

                                            @default
                                        @endswitch
                                    </td>
                                </tr>
                                <tr>
                                    <td style="min-width: 130px; padding-bottom: 8px;">حمل و نقل :</td>
                                    <td style="color: #8492a6;">{{ $order->delivery->name }}
                                        {{ $order->delivery->take_time }}</td>
                                </tr>
                                <tr>
                                    <td style="min-width: 130px; padding-bottom: 8px;">شماره تلفن :</td>
                                    <td style="color: #8492a6;">{{ $data['mobile'] }}</td>
                                </tr>
                                <tr>
                                    <td style="min-width: 130px; padding-bottom: 8px;">نام :</td>
                                    <td style="color: #8492a6;">{{ $data['last_name'] }}</td>
                                </tr>
                                <tr>
                                    <td style="min-width: 130px; padding-bottom: 8px;">آدرس : </td>
                                    <td style="color: #8492a6;">
                                        <p class="m-0">{{ $data['city'] . ' --- ' . $data['state'] }}
                                            {{ $data['address'] }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="min-width: 130px; padding-bottom: 8px;">تاریخ :</td>
                                    <td style="color: #8492a6;">
                                        {{ \Morilog\Jalali\Jalalian::forge($order->created_at)->format('%A, %d %B %Y') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td style="padding: 24px;">
                        <div
                            style="display: block; overflow-x: auto; -webkit-overflow-scrolling: touch; border-radius: 6px; box-shadow: 0 0 3px rgba(60, 72, 88, 0.15);">
                            <table style="width: 100%" cellpadding="0" cellspacing="0">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col"
                                            style="text-align: right; vertical-align: bottom; border-top: 1px solid #dee2e6; padding: 12px;">
                                            ردیف </th>
                                        <th scope="col"
                                            style="text-align: right; vertical-align: bottom; border-top: 1px solid #dee2e6; padding: 12px; width: 200px;">
                                            مورد </th>
                                        <th scope="col"
                                            style="text-align: end; vertical-align: bottom; border-top: 1px solid #dee2e6; padding: 12px;">
                                            مجموع </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->products as $product)
                                        <tr>
                                            <th scope="row"
                                                style="text-align: right; padding: 12px; border-top: 1px solid #dee2e6;">
                                                {{ $loop->index + 1 }}
                                            </th>
                                            <td style="text-align: right; padding: 12px; border-top: 1px solid #dee2e6;">
                                                {{ $product->name }}
                                            </td>
                                            <td style="text-align: end; padding: 12px; border-top: 1px solid #dee2e6;">
                                                {{ $product->price }}
                                            </td>
                                        </tr>
                                    @endforeach

                                    @foreach ($order->courses as $course)
                                        <tr>
                                            <th scope="row"
                                                style="text-align: right; padding: 12px; border-top: 1px solid #dee2e6;">
                                                {{ $loop->index + 1 }}
                                            </th>
                                            <td style="text-align: right; padding: 12px; border-top: 1px solid #dee2e6;">
                                                {{ $course->title }}
                                            </td>
                                            <td style="text-align: end; padding: 12px; border-top: 1px solid #dee2e6;">
                                                {{ $course->price }}
                                            </td>
                                        </tr>
                                    @endforeach

                                    <tr
                                        style="background-color: rgba(47, 85, 212, 0.2); color: #2f55d4; overflow-x: hidden;">
                                        <th scope="row"
                                            style="text-align: left; padding: 12px; border-top: 1px solid rgba(47, 85, 212, 0.2);">
                                            مجموع </th>
                                        <td colspan="2"
                                            style="text-align: end; font-weight: 700; font-size: 18px; padding: 12px; border-top: 1px solid rgba(47, 85, 212, 0.2);">
                                            {{ number_format($order->price) }} تومان</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td style="padding: 16px 8px; color: #8492a6; background-color: #f8f9fc; text-align: center;">
                        ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script> الکتروما.
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
