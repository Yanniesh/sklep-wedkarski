<?php

namespace App\Http\Controllers;

use App\Mail\OrderCreated;
use App\Mail\OrderShipped;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendShippedMail(): \Illuminate\Http\RedirectResponse
    {
//        Mail::to(auth()->user()->email)->send(new OrderShipped());
        Mail::to('yaniesh000@gmail.com')->send(new OrderShipped());
        return redirect()->route('shop.orders.index')->with('status', 'Zamówienie opłacone!');
    }

    public function sendCreatedMail(): \Illuminate\Http\RedirectResponse
    {

        Mail::to('yaniesh000@gmail.com')->send(new OrderCreated());
//        Mail::to(auth()->user()->email)->send(new OrderCreated());
        return redirect()->back()->with('status', 'Zamówienie w trakcie realizacji!');
    }
}
