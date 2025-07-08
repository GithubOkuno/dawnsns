<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FollowsController extends Controller
{
    public function followList(){
        // select username from users join follows on follows.follower = users.id
        $followLists = DB::table('users')
        ->join('follows', 'users.id', '=', 'follows.follow')
        ->where('follower',Auth::id())
        ->select('users.id', 'users.images')
        ->get();
        // dd($followLists);
        // return view('follows.followList',['followLists'=>$followLists]);

        $followusersposts = DB::table('posts')
        ->join('follows', 'posts.user_id', '=', 'follows.follow')
        ->Leftjoin('users','posts.user_id', '=', 'users.id')
        ->where('follower',Auth::id())
        ->select('posts.*','users.id','users.username','users.images')
        // ->latest()
        ->get();
        // dd($followusersposts);
        // return view('follows.followList',['followusersposts'=>$followusersposts]);
        return view('follows.followList',compact('followLists','followusersposts'));
    }

    public function followerList(){
        $followerLists = DB::table('users')
        ->join('follows', 'follows.follower', '=', 'users.id')
        ->where('follow',Auth::id())
        ->select('users.id', 'users.images')
        ->get();
        // dd($followerusers);

        $followerusersposts=DB::table('posts')
        ->join('follows', 'posts.user_id', '=', 'follows.follow')
        ->Leftjoin('users','posts.user_id', '=', 'users.id')
        ->where('follow',Auth::id())
        ->select('posts.*','users.id','users.username','users.images')
        // ->latest()
        ->get();
        // dd($followusersposts);
        // return view('follows.followList',['followerLists'=>$followerList]);
        return view('follows.followerList',compact('followerLists','followerusersposts'));
    }
}
