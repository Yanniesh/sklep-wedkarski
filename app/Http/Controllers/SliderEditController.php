<?php

namespace App\Http\Controllers;

use App\Models\photos_orders;
use App\Models\SliderPhoto;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use \Illuminate\Http\RedirectResponse;
class SliderEditController extends Controller
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
    public function index(): Renderable
    {
        return view('slider.index');
    }

    public function show(): Renderable
    {
        $data = SliderPhoto::all();
        return view('slider.edit',$data);
    }
    public function store(): RedirectResponse
    {
        $data = request()->validate([
//            'caption' => 'required',
            'image' => ['required', 'image'],
        ]);
        $imagePath = request('image')->store('uploads', 'public');
        $image = Image::make(public_path("{$imagePath}"))->fit(600, 400);
        $image->save();
        $photo = SliderPhoto::query();
        $photo -> create([
            'caption' => "caption",
            'imagePath' => $imagePath,
        ]);
        if(count(photos_orders::all()) == 0){
            photos_orders::create([
                'id' => 1,
                'photos_ids' => json_encode([]),
                'ids_order' => json_encode([]),
            ]);
        }
        return redirect('/slideredit')->with('status', 'Dodano zdjęcie!');
    }
    public function destroy(): RedirectResponse
    {
        $data = request();
        try{
            $photo = SliderPhoto::query()->find($data['id']);
            unlink(public_path($photo['imagePath']));
            $photo ->delete();
        }catch (Exception $e){
            return redirect('/slideredit')->with('status', 'Błąd usuwania zdjęcia!');
        }
        return redirect('/slideredit')->with('status', 'Usunięto zdjęcie!');
    }
    public function update(): RedirectResponse
    {
        $photoId = request('id');

        try {
            $existingOrder = photos_orders::findOrFail(1);
            if (!str_contains($existingOrder->photos_ids, $photoId)) {
                $jsonArray = json_decode($existingOrder->photos_ids, true);
                $jsonArray[] = $photoId;
                $existingOrder->update(['photos_ids' => json_encode($jsonArray)]);
            }
        } catch (ModelNotFoundException $e) {
            photos_orders::create([
                'id' => 1,
                'photos_ids' => json_encode([$photoId]),
                'ids_order' => json_encode([$photoId]),
            ]);
        } catch (Exception $e) {
            return redirect('/slideredit')->with('status', 'Błąd dodawania/zaktualizowania rekordu w sliderze!');
        }

        return redirect('/slideredit')->with('status', 'Dodano/zaktualizowano rekord w sliderze!');}
}
