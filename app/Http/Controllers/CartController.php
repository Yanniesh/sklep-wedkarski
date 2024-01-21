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
        $carts = $user->carts;
        $carts = $carts->where('processed', false);
        return view('cart.index',compact('carts'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $product_id = $request->input('productId');
        $price = Product::query()->where('id', $product_id)->first()->price;
        if($id != -1){
            $Cart = Cart::query()->where('id', $id)->first();
        }else{
            $Cart = Cart::query()
                ->where('product_id', $product_id)
                ->where('user_id', auth()->user()->id)
                ->where('processed', false)
                ->first();
        }
        if($Cart == null){
            Cart::query()->create([
                'product_id' => $product_id,
                'user_id' => auth()->id(),
                'quantity'=> 1,
                'amount' => $price,
            ]);
        }
        else{
             if($request->has('quantityFactor') and $request->input('quantityFactor') == 'increase'){
                $Cart->quantity = $Cart->quantity + 1;
                }
             else{
                $Cart->quantity = $Cart->quantity - 1;
                }
             $Cart->amount = $price * $Cart->quantity;
           if($Cart->quantity>0){
             $Cart->save();
           }
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
