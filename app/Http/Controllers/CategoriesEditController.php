<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class CategoriesEditController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $categories = Category::all();
        return view('shop.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $selectedValue = $request->input('categorySelect');
        $inputText = $request->input('categoryName');
        $photo = Category::query();
        $selectedValue = ($selectedValue == 0) ? null : $selectedValue;
        $photo -> create([
            'name' => $inputText,
            'category_id' => $selectedValue,
        ]);
        return redirect()->route('CategoryEdit')->with('status', 'Dodano kategorię!');
    }

    public function destroy(Request $request){
        try{
            $photo = Category::query()->find($request['id']);
            $photo->delete();
        }catch (Exception $e){
            return redirect()->route('shop')->with('status', 'Błąd usuwania kategorii!');
        }
        return redirect()->route('shop')->with('status', 'Usunięto kategorie!');
    }

}
