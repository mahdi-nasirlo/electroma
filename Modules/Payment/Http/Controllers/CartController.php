<?php

namespace Modules\Payment\Http\Controllers;

use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Jackiedo\Cart\Facades\Cart;
use Modules\Payment\Entities\Order;
use Modules\Payment\Entities\Payment as EntitiesPayment;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Payment\Facade\Payment;
use Shetabit\Multipay\Invoice;

class CartController extends Controller
{
    public function index()
    {
        return view('payment::cart.index');
    }

    public function profile()
    {
        SEOMeta::setTitle("اکانت کاربری")
            ->setDescription("از داشبورد حساب خود می توانید اطلاعات خود را مشاهده کنید سفارشات اخیر, با مدیریت شما آدرس حمل و نقل و صورتحساب, و رمز ورود و جزئیات حساب خود را ویرایش کنید.")
            ->addMeta("designer", env("DESIGNER"));

        return view("payment::profile.index");
    }

    public function payment(Order $order)
    {
        $payment_id = $order->orderHasPayment() ? $order->payments[0]->verify_code : md5(uniqid());

        $invoice = new Invoice();
        $invoice->amount($order->total_price);

        $payment = Payment::callBackUrl(route('payment.callback', ['payment' => $payment_id]));

        // dd($payment);
        $payment->purchase($invoice, function ($driver, $transactionId) use ($order, $payment_id) {
            Log::debug("call back  ::  " . $transactionId . "    ******    " . $payment_id);
            if ($order->orderHasPayment())
                $order->payments[0]->update(['resnumber' => $transactionId]);
            else
                $order->payments()->create([
                    'resnumber' => $transactionId,
                    'verify_code' => $payment_id
                ]);
        });

        return ($payment->pay()->render());
    }

    public function callback(Request $request)
    {
        $payment  = EntitiesPayment::where('verify_code', $request->payment)->first();


        if (is_null($payment)) {
            return view('error');
        }


        // if ($payment->order->user->id !== Auth::id()) {
        //     return view('error');
        // }


        // Log::debug("call back  ::  " . $payment->resnumber . "    ******    " . $request->payment);


        // You need to verify the payment to ensure the invoice has been paid successfully.
        // We use transaction id to verify payments
        // It is a good practice to add invoice amount as well.
        try {
            $receipt = Payment::amount($payment->order->total_price)->transactionId($payment->resnumber)->verify();


            // dd($payment->order, $payment->order->products);

            $payment->order->courses->map(function ($course) {
                $course->update([
                    'inventory' => $course->inventory - 1
                ]);
            });


            $payment->order->products->map(function ($product) {
                $product->update([
                    'inventory' => $product->inventory - 1
                ]);
            });

            $payment->update([
                'status' => true
            ]);

            $payment->order->update([
                'status' => 'paid'
            ]);


            Cart::clearItems();

            Cookie::forget('cart_discount_id');

            return redirect(route('payment.successful', $payment->order))->with('message', true);
            // return redirect(Route("profile", ['tab' => "order"]));
        } catch (InvalidPaymentException $exception) {
            /**
        when payment is not verified, it will throw an exception.
        We can catch the exception to handle invalid payments.
        getMessage method, returns a suitable message that can be used in user interface.
             **/
            // echo $exception->getMessage();

            return redirect(route('payment.unsuccessful', $payment->order))->with('error', $exception->getMessage() . " (پرداخت ناموفق) ");
        }
    }

    public function paymentPage(Order $order)
    {
        SEOMeta::setTitle("صندوق")
            ->addMeta("designer", env("DESIGNER"));

        Gate::authorize("view-payment", $order);

        return view("payment::cart.payment", ['order' => $order]);
    }

    public function guestUserPay()
    {
        // SEOMeta::setTitle("صندوق")
        //     ->addMeta("designer", env("DESIGNER"));

        // Gate::authorize("view-payment", $order); , ['order' => $order]

        $items = collect(Cart::name("shopping")->getItems());

        if ($items->isEmpty()) {
            return redirect(route('cart.index'));
        }

        return view("payment::cart.guestPay");
    }

    public function successful(Order $order)
    {
        session()->reflash();

        if (!Session::has('message')) {
            return abort(404);
        }

        $data = null;

        if ($address = $order->address) {
            $data = $order->address->toArray();
        } else {
            $user = $order->user;

            $data = [
                'last_name' => $user->name,
                'state' => $user->state,
                'city' => $user->city,
                'address' => $user->address,
                'post' => $user->post,
                'mobile' => $user->mobile
            ];
        }

        return view('payment::message.successful', compact('data', 'order'));
    }

    public function unsuccessful()
    {
        session()->reflash();

        if (!Session::has('error')) {
            return abort(404);
        }

        return view('payment::message.unsuccessful');
    }
}
