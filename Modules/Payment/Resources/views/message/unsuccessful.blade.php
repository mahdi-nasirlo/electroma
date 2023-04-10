@extends('payment::message.html')

@section('content')
    <div>
        <table cellpadding="0" cellspacing="0"
            style="direction:rtl; text-align: right; font-size: 15px; font-weight: 400; max-width: 600px; border: none; margin: 0 auto; border-radius: 6px; overflow: hidden; background-color: #fff; box-shadow: 0 0 3px rgba(60, 72, 88, 0.15);">
            <thead>
                <tr>
                    <div style="display: flex; justify-content: end;margin: 0 auto; max-width: 590px;">
                        <a href="{{ route('home') }}">
                            <x-font-angle-left style="width: 40px;height: 40px;" />
                        </a>
                    </div>
                </tr>
                <tr
                    style="background-color: #2f55d4; padding: 3px 0; line-height: 68px; text-align: center; color: #fff; font-size: 24px; font-weight: 700; letter-spacing: 1px;">
                    <th scope="col d-flex">
                        <span class="display-1" style="font-size: 20px !important; font-weight: bold">الکتروما - رسید
                            پرداخت
                        </span>
                    </th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td style="padding: 24px 24px;">
                        <div
                            style="padding: 8px; color: #e43f52; background-color: rgba(228, 63, 82, 0.2); border: 1px solid rgba(228, 63, 82, 0.2); border-radius: 6px; text-align: center; font-size: 16px; font-weight: 600;">
                            @if (session()->has('error'))
                                {{ session()->get('error') }}
                            @endif
                        </div>
                    </td>
                </tr>

                <tr>
                    <td style="padding: 0 24px 15px; color: #8492a6;">
                        پرداخت شما با خطا مواجه شد، در صورتی که تمایل به ادامه خرید دارید می توانید از لینک زیر اقدام کنید ،
                        یا در صورت بروز مشکل با پشتیبانی تماس بگیرید.
                    </td>
                </tr>

                <tr>
                    <td style="padding: 15px 24px;">
                        <a href="{{ route('cart.index') }}"
                            style="padding: 8px 20px; outline: none; text-decoration: none; font-size: 16px; letter-spacing: 0.5px; transition: all 0.3s; font-weight: 600; border-radius: 6px; background-color: #2f55d4; border: 1px solid #2f55d4; color: #ffffff;">
                            ادامه پرداخت
                        </a>
                    </td>
                </tr>

                <tr>
                    <td style="padding: 15px 24px 15px; color: #8492a6;">
                        {{ env('APP_NAME') }} <br> تیم پشتیبان
                    </td>
                </tr>

                <tr>
                    <td style="padding: 16px 8px; color: #8492a6; background-color: #f8f9fc; text-align: center;">
                        ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script>{{ env('APP_NAME') }}.
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
