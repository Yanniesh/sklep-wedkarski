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
    public function index(): \Illuminate\Contracts\Foundation\Application
    {
        $user = auth()->user();
        $orders = $user->orders;
        return view('orders.index',compact('orders'));
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        dd("co jest kurwa");
        $rules = [
            'name' => 'required|string|regex:/^[A-Za-z]+$/',
            'surname' => 'required|string|regex:/^[A-Za-z]+$/',
            'postalCode' => 'required|regex:/^\d{2}-\d{3}$/',
            'city' => 'required|string',
            'street' => 'required|string',
            'houseNumber' => 'required|numeric',
            'phoneNumber' => 'required|numeric',
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

        $user = auth()->user();
        $carts = $user->carts;
        $order = Order::query()->create([
            'user_id' => auth()->id()
        ]);
        $address= Address::query()->create([
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
            'city' => $request->input('city'),
            'postal_code' => $request->input('postalCode'),
            'street' => $request->input('street'),
            'house_number' => $request->input('houseNumber'),
            'phone_number' => $request->input('phoneNumber'),
            'order_id' => $order->id,
        ]);
        $carts->where('processed', false)->update([
            'processed' => true,
            'order_id' => $order->id
        ]);
        $order->update(['address_id' => $address->id]);
        return redirect()->route('orders.index')->with('status', 'Zamówienie w trakcie realizacji!');
    }
    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        Order::query()->find($id)->update(['paid' => true]);

        return redirect()->route('orders.index')->with('status', 'Zamówienie opłacone!');
    }
    public function destroy(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        Order::query()->find($id)->delete();
        return redirect()->route('orders.index')->with('status', 'Zamówienie usunięte!');
    }
}
