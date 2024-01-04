<?php

namespace App\Http\Controllers;

use App\Models\photos_orders;
use App\Models\SliderPhoto;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('slider.index');
    }

    public function show()
    {
        $data = SliderPhoto::all();
        return view('slider.edit',$data);
    }
    public function store()
    {
        $data = request()->validate([
//            'caption' => 'required',
            'image' => ['required', 'image'],
        ]);
        $imagePath = request('image')->store('uploads', 'public');
        $image = Image::make(public_path("{$imagePath}"))->fit(600, 400);
//        $image = Image::make(public_path("{$imagePath}"));
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
    public function destroy(){
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
    public function update(){
        $photoId = request('id');

        try {
            // Sprawdź, czy istnieje rekord o danym ID
            $existingOrder = photos_orders::findOrFail(1);

            // Sprawdź, czy zdjęcie już istnieje w photos_ids
            if (strpos($existingOrder->photos_ids, $photoId) === false) {
                // Jeżeli nie istnieje, dodaj nowe ID do photos_ids
                $jsonArray = json_decode($existingOrder->photos_ids, true);
                $jsonArray[] = $photoId;
                $existingOrder->update(['photos_ids' => json_encode($jsonArray)]);
            }
        } catch (ModelNotFoundException $e) {
            // Jeżeli nie istnieje rekord o danym ID, utwórz nowy rekord
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
