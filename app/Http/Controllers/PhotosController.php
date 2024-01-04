<?php

namespace App\Http\Controllers;


use App\Models\SliderPhoto;
use Illuminate\Http\Request;

class PhotosController extends Controller
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
        return view('home');
    }
//     public function store(){
//         $data = request()->validate([
//             'image' => ['required', 'image'],
//         ]);
//         $imagePath = request('image')->store('uploads', 'public');
//         $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
//         $image->save();
//
//         auth()->user()->posts()->create([
//             'caption' => $data['caption'],
//             'image' => $imagePath,
//         ]);
//
//         return redirect('/profile/' . auth()->user()->id);
//     }
}
