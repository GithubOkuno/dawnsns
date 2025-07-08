<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function index(){
        $posts = DB::table('posts')
        ->leftJoin('follows', 'posts.user_id', '=', 'follows.follow')
        ->join('users','posts.user_id', '=', 'users.id')
        ->where('posts.user_id',Auth::id())
        ->orWhere('follows.follower',Auth::id())
        ->select('posts.id', 'posts.posts', 'posts.user_id', 'posts.created_at', 'users.username', 'users.images')
        ->orderBy('posts.created_at','desc')
        ->get();
        // dd($posts);
        return view('posts.index',['posts'=>$posts]);
    }

    public function create(Request $request)
    {
        //画面から何かしら値が送られてきたらバリデーションする
        $newPost = $request->input('newPost');
        DB::table('posts')->insert([
            'posts' => $newPost,
            'user_id' => Auth::id(),
            'created_at' => Now()
        ]);
        return redirect('/top');
    }

    public function update(Request $request)
    {
        $upPost = $request->input('upPost');
        $upId= $request->input('upId');
        DB::table('posts')
            ->where('id',$upId)
            ->update([
            'posts' => $upPost,
            'updated_at' => Now()
        ]);
        return redirect('/top');
    }

    public function delete(Request $request)
    {
        $deleteId= $request->input('deleteId');
        DB::table('posts')
            ->where('id',$deleteId)
            ->delete();
        return redirect('/top');
    }


    public function tests()
    {
        $tests = DB::table('posts')
            ->join('users','posts.user_id', '=', 'users.id')
            ->where('posts.user_id',Auth::id())
            ->select('posts.id', 'posts.posts', 'posts.user_id', 'posts.created_at', 'users.username', 'users.images')
            ->get();

        return view('posts.test', ['tests' => $tests]);
    }
}
