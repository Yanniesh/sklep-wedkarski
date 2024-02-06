<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(): \Illuminate\Contracts\View\View
    {
        $user = auth()->user();
        $orders = $user->orders;
        return view('shop.orders.index',compact('orders'));
    }
    public function show($id): \Illuminate\Contracts\View\View
    {
        $order = Order::query()->find($id);
        $carts = $order->carts;
        return view('shop.orders.show',compact('carts'));
    }
    /**
     * @throws ValidationException
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $rules = [
            'name' => 'required|string|regex:/^[A-Za-z]+$/',
            'surname' => 'required|string|regex:/^[A-Za-z]+$/',
            'postalCode' => 'required|regex:/^\d{2}-\d{3}$/',
            'city' => 'required|string',
            'street' => 'required|string',
            'houseNumber' => 'required|numeric',
            'phoneNumber' => 'required|string',
        ];

        $messages = [
            'name.regex' => 'Imię może zawierać tylko litery.',
            'surname.regex' => 'Nazwisko może zawierać tylko litery.',
            'postalCode.regex' => 'Nieprawidłowy format kodu pocztowego. Poprawny format to XX-XXX.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $address= Address::query()->create([
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
            'city' => $request->input('city'),
            'postal_code' => $request->input('postalCode'),
            'street' => $request->input('street'),
            'house_number' => $request->input('houseNumber'),
            'phone_number' => $request->input('phoneNumber'),
        ]);
        $user = auth()->user();
        $amount = $request->input('amount');
        $order = Order::query()->create([
            'amount' => $amount,
            'user_id' => auth()->id(),
            'address_id' => $address->id,
        ]);
        $carts = $user->carts;

        foreach ($carts as $cart) {
            $cart->where('processed', false)->update([
                'processed' => true,
                'order_id' => $order->id,
            ]);
        }
//        return redirect()->route('order.index')->with('status', 'Zamówienie w trakcie realizacji!');

        return redirect()->route('send.mail.created', $order->id);
    }
    public function update( $id): \Illuminate\Http\RedirectResponse
    {
        Order::query()->find($id)->update(['paid' => true]);
        return redirect()->route('send.mail.shipped');
    }
    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        Order::query()->find($id)->delete();
        return redirect()->route('shop.orders.index')->with('status', 'Zamówienie usunięte!');
    }
}
