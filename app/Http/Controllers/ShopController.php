<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\photos_orders;
use App\Models\Product;
use App\Models\SliderPhoto;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ShopController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(Request $request): Renderable
    {
        $categoryId = $request['category'];
        $backCategory = null;
        if($categoryId != null and $categoryId != 0){
            $parentCategories = Category::query()->where('id', $categoryId)->get();
            if($parentCategories->first() != null){
                $backCategory = Category::query()->where('id', $parentCategories->first()->category_id)->first();
            }

        } else{
            $parentCategories = Category::query()->where('category_id', null)->get();
        }
        if($categoryId != null and $categoryId != 0){
            $products = Product::query()
                ->where('category_id', $categoryId)
                ->orWhere(function ($query) use ($categoryId) {
                    $query->whereIn('category_id', function ($subquery) use ($categoryId) {
                        $subquery->select('id')
                            ->from('categories')
                            ->where('category_id', $categoryId);
                    });
                })
                ->paginate(10);
        }
        else{
            $products = Product::query()->paginate(10);
        }

        return view('shop.index',compact('parentCategories','products','backCategory'));
    }

}
