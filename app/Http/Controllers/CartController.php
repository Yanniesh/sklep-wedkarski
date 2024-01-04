<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function index(): Application|View|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $user = auth()->user();
        $products = $user->carts;
        return view('cart.index',compact('products'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $Cart = Cart::query()->where('product_id', $id)->first();
        $quantity = 1;
        $price = Product::query()->where('id', $id)->first()->price;
        if($Cart == null){
            Cart::query()->create([
                'product_id' => $id,
                'user_id' => auth()->id(),
                'quantity'=> $quantity,
                'amount' => $price,
            ]);
        }else{
            $Cart->quantity = $Cart->quantity + 1;
            $Cart->amount = $price * $Cart->quantity;
            $Cart->save();
        }

        return redirect()->back()->with('status', 'Dodano produkt do koszyka!');
    }

    public function destroy(Request $request): RedirectResponse
    {
        try{
            $Cart = Cart::query()->find($request['id']);
            $Cart->delete();
        }catch (Exception $e){
            return redirect()->back()->with('status', 'Błąd usuwania produktu z koszyka');
        }
        return redirect()->back()->with('status', 'Usunięto produkt z koszyka');
    }
}
