<?php

namespace App\Http\Controllers;

use App\Models\ProductPhoto;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductPhotoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   public function destroy($id){
       try{
           $photo = ProductPhoto::query()->find($id);
           Storage::disk('public')->delete($photo['path']);
           $photo->delete();
       }catch (Exception $e){
           return redirect()->back()->with('status', 'Błąd usuwania zdjecia!');
       }
       return redirect()->back()->with('status', 'Usunięto zdjęcie!');
   }
}
