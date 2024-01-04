<?php

namespace App\Http\Controllers;

use App\Models\photos_orders;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('order.index');
    }
    public function update(Request $request){
        $new_order = json_decode($request->input('sliderorder'));

        $slider = photos_orders::query()->find(1);

        if ($slider) {
            $slider->update(['ids_order' => json_encode($new_order)]);
            return redirect('/slideredit')->with('status', 'Zaktualizowano kolejność w bazie danych');
        } else {
            return redirect('/slideredit')->with('status', 'Nie znaleziono rekordu o id=1');
        }
    }
}
