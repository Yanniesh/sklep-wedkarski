<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Exception;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function store(Request $request)
    {
//        dd($request['comment_text']);
        $request->validate([
            'comment_text' => 'required|string',
            'product_id' => 'required|exists:products,id',
        ]);

        // Zapis komentarza
        Comment::create([
            'text' => $request->input('comment_text'),
            'product_id' => $request->input('product_id'),
            'user_id' => auth()->id(),
            'parent_comment_id' => null,
        ]);

        // Dodaj dowolną logikę sukcesu lub przekierowanie
        return redirect()->back()->with('success', 'Komentarz został przesłany do zatwierdzenia.');
    }

    public function update(Request $request, $id){
        $request->validate([
            'comment_text' => 'required|string',
        ]);

        Comment::create([
            'text' => $request->input('comment_text'),
            'product_id' => $request->input('product_id'),
            'user_id' => auth()->id(),
            'parent_comment_id' => $id,
        ]);

        return redirect()->back()->with('status', 'Komentarz został przesłany do zatwierdzenia.');
    }

    public function destroy($id){
        try{
            Comment::query()->find($id)->delete();
        }catch (Exception $e){
            return redirect()->back()->with('status', 'Błąd usuwania komentarza.');
        }
        return redirect()->back()->with('status', 'Komentarz został przesłany do zatwierdzenia.');
    }
}
