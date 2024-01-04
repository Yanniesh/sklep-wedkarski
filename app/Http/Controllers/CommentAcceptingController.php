<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentAcceptingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $comments = Comment::query()->where('accepted', '0')->get();
        if(auth()->user()['role']=="admin"){
            return view('admin.index',compact('comments'));
        }
        else{
            return view('home');
        }
    }
    public function update($id){
        if(auth()->user()['role']=="admin"){
            $comment = Comment::query()->find($id);
            $comment['accepted'] = '1';
            $comment ->save();
            return redirect()->back()->with('status', 'Komentarz został zatwierdzony.');
        }
        return redirect()->back()->with('status', 'Brak uprawnień!');
    }
}
