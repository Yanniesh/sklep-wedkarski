<?php

namespace App\Http\Controllers;

use App\Mail\OrderCreated;
use App\Mail\OrderShipped;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendShippedMail($id): \Illuminate\Http\RedirectResponse
    {

//        Mail::to(auth()->user()->email)->send(new OrderShipped($id));
        Mail::to('yaniesh000@gmail.com')->send(new OrderShipped($id));
        return redirect()->route('shop.orders.index')->with('status', 'Zamówienie opłacone!');
    }

    public function sendCreatedMail($id): \Illuminate\Http\RedirectResponse
    {
        $order = Order::with('carts.product')->find($id);
        $orderCartsT = [];
        foreach ($order->carts as $cart) {
            $product = $cart->product;
            $orderCartsT[] = [
                'product' => $product->name,
                'quantity' => $cart->quantity,
                'price' => $product->price,
            ];
        }
        $orderCartsT['amount'] = $order->amount;

        Mail::to('yaniesh000@gmail.com')->send(new OrderCreated($orderCartsT));
//        Mail::to(auth()->user()->email)->send(new OrderCreated($id));
        return redirect()->back()->with('status', 'Zamówienie w trakcie realizacji!');
    }
}
