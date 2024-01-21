<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use SebastianBergmann\Type\TrueType;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\PaymentIntent;
class PaymentController extends Controller
{
    public function showCheckout()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
        return view('payment.checkout');
    }

    public function createCheckoutSession($id): \Illuminate\Http\RedirectResponse
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $order = Order::find($id);
        $carts = $order->carts;
        $lineItems = [];
        foreach ($carts as $cart) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'pln',
                    'product_data' => [
                        'name' => $cart->product->name,
                    ],
                    'unit_amount' => $cart->product->price * 100,
                ],
                'quantity' => $cart->quantity,
            ];

        }
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('payment.success', ['id' => $id]),
            'cancel_url' => route('payment.cancel', ['id' => $id]),
        ]);

        return redirect()->away($session->url);

    }

    public function success($id)
    {
        Order::query()->find($id)->update(['paid' => true]);

        return redirect()->route('send.mail.shipped',$id);
    }

    public function cancel()
    {
        return redirect()->route('shop.orders.index')->with('status', 'Płatność odrzucona!');

    }
}
