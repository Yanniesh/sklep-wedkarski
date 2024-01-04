<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use App\Models\ProductPhoto;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        $categories = Category::all();
        $role = auth()->user()['role'];
        if($role == "admin"){
            $products = Product::all();
        }
        else{
            $products = Product::query()->where('user_id', auth()->id())->get();
        }

        return view('shop.products.create', compact('categories','products'));
    }
    public function show($id): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $product = Product::query()->findOrFail($id);
        $parentCategories = Category::query()->where('category_id', null)->get();
        $parentComments=$product->comments()->where('parent_comment_id', null)->get();

        return view('shop.products.show',compact('product', 'parentCategories', 'parentComments'));
    }
    public function edit($id): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $product = Product::query()->findOrFail($id);
        $categories = Category::all();
        return view('shop.products.edit',compact('product', 'categories'));
    }
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->category_id = $request->input('categorySelect');
        $product->save();
        if ($request->has('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('uploads/product', 'public');
                $image = Image::make(public_path($path))->fit(600, 400);
                $image->save();
                ProductPhoto::create([
                    'path' => $path,
                    'product_id' => $product->id,
                ]);
            }
        }
        $categories = Category::all();
        return view('shop.products.edit',compact('product', 'categories')) ->with('status', 'Zaktualizowano produkt!');
    }

    public function store(Request $request)
    {
//        $request->validate([
//            'name' => 'required|string|max:255',
//            'description' => 'required|string',
//            'categorySelect' => 'required|number',
//            'price' => 'required|decimal',
//            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:102400',
//        ]);

        $request->validate([
            'images.*' => 'required|max:30720'
        ]);
        $name = $request->input('name');
        $selectedValue = $request->input('categorySelect');
        $description = $request->input('description');
        $price = $request->input('price');
        if(!$request->has('images')){
            return redirect()->route('product.create')->with('status', 'Brak zdjecia!');
        }
        if(!$request->has('categorySelect')){
            return redirect()->route('product.create')->with('status', 'Nie wybrano kategorii!');
        }
        $productID = Product::query()->insertGetId([
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'category_id' => $selectedValue,
            'user_id' => auth()->id(),
        ]);
        foreach ($request->file('images') as $image) {
            $path = $image->store('uploads/product', 'public'); // Zapisz zdjęcie w storage
            $image = Image::make(public_path("{$path}"))->fit(600, 400);
            $image->save();
            ProductPhoto::query() -> create([
                    'path' => $path,
                    'product_id' => $productID,
            ]);
        }
        return redirect()->route('product.create')->with('status', 'Dodano produkt!');
    }

    public function destroy($id){
        try{
            $product = Product::query()->find($id);
            foreach ($product->photos() as $photo) {
                Storage::disk('public')->delete($photo->path);
            }
            $product->photos()->delete();
            $product->delete();
        }catch (Exception $e){
            return redirect()->route('product.create')->with('status', 'Błąd usuwania produktu!');
        }
        return redirect()->route('product.create')->with('status', 'Usunięto produkt!');
    }
}
