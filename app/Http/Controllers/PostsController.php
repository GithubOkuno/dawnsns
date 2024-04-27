<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    //
    public function index(){
        return view('posts.index');
    }

    public function create(Request $request)
    {
        $newPost = $request->input('newPost');
        DB::table('posts')->insert([
            'posts' => $newPost,
            'user_id' => Auth::id()
        ]);
        return redirect('/top');
    }
}
