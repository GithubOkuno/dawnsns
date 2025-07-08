<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class UsersController extends Controller
{
    public function index(){
        $keyword = '';
        $users = DB::table('users')
        ->where('id','!=',Auth::id())
        ->get();
        $follows = DB::table('follows')
        ->where('follower',Auth::id())
        ->pluck('follow')
        ->toArray();
        return view('users.search',['users'=>$users,'follows'=>$follows,'keyword'=>$keyword]);
   }

    public function profile($userId){
        $profiles=DB::table('users')
        ->where('id',$userId)
        ->select('users.id','users.username','users.bio','users.images')
        ->first();
        $profilePosts=DB::table('posts')
        ->join('users', 'posts.user_id', '=', 'users.id')
        ->where('user_id',$userId)
        ->select('users.id','users.username','users.images','posts.posts','posts.created_at')
        ->get();
        $follows = DB::table('follows')
        ->where('follower',Auth::id())
        ->pluck('follow')
        ->toArray();
        return view('users.profile',['profiles'=>$profiles,'profilePosts'=>$profilePosts,'follows'=>$follows]);
    }

    public function search(Request $request){
        $keyword = $request->input('username');
        $users = DB::table('users')
        ->where('id','!=',Auth::id())
        ->where('username','LIKE','%'.$request->input('username').'%')
        ->get();
        $follows = DB::table('follows')
        ->where('follower',Auth::id())
        ->pluck('follow')
        ->toArray();
        return view('users.search',['users'=>$users,'follows'=>$follows,'keyword'=>$keyword]);
    }

    public function follow(Request $request){
        $follow = $request->input('user_id');
        DB::table('follows')->insert([
            'follow' => $follow,
            'follower' => Auth::id()
        ]);
        return back();
    }

    public function unfollow(Request $request){
        $unfollow = $request->input('user_id');
        DB::table('follows')
        ->where([
            ['follower','=',Auth::id()],
            ['follow','=',$unfollow],
        ])/*https://qiita.com/saizen/items/b6991a2066a4b1a7adb9*/
        ->delete();
        return back();
    }

    public function setting(){
        $setting = DB::table('users')
        ->where('id',Auth::id())
        ->select('users.username','users.mail','users.password','users.bio','users.images')
        //->get();
        //getの場合、インデックス[0]がついてしまい、blade側にインデックスの指定が必要になるので、今回はfirstが適切。
        ->first();
        // dd($setting);
        return view('users.setting',['setting'=>$setting]);
    }

    public function upsetting(Request $request)
    {
        $request->validate([
            'upUsername'=>['required','string','between:4,12'],
            'upMail'=>['required','string','email','between:4,255',Rule::unique('users','mail')->ignore(Auth::id())],
            'upPassword'=>['nullable','string','alpha_num','between:4,12'],
            'upPasswordConfirm'=>['nullable','string','alpha_num','between:4,12','same:password'],
            'upBio'=>['nullable','string','max:200'],
            'upimages'=>['nullable','mimes:jpg,png,bmp,gif,svg',
                            function($attribute, $value, $fail) {
                                $filename = $value->getClientOriginalName();
                                if(!preg_match('/^[a-zA-Z0-9!@#$%^&*()_+\-=\[\]{};\'\\:"|,.<>\/?]+$/', $filename)){
                                    $fail('ファイル名を英数字のみにしてください。');
                                }
                            }
                        ],
        ],[
            'upUsername.required'=>'ユーザー名は必須項目です。',
            'upUsername.string'=>'ユーザー名が文字列ではありません。',
            'upUsername.between'=>'ユーザー名は4文字以上、12文字以内で設定してください。',
            'upMail.required'=>'メールアドレスは必須項目です。',
            'upMail.string'=>'メールアドレスが文字列ではありません。',
            'upMail.email'=>'メールアドレスではありません。',
            'upMail.between'=>'メールアドレスの文字数が条件を満たしていません。',
            'upMail.unique'=>'登録済みのメールアドレスは使用できません。',
            'upPassword.string'=>'パスワードが文字列ではありません。',
            'upPassword.alpha_num'=>'パスワードは英数字のみで設定してください。',
            'upPassword.between'=>'パスワードは4文字以上、12文字以内で設定してください。',
            'upPasswordConfirm.string'=>'パスワードが文字列ではありません。',
            'upPasswordConfirm.alpha_num'=>'パスワードは英数字のみで設定してください。',
            'upPasswordConfirm.between'=>'パスワードは4文字以上、12文字以内で設定してください。',
            'upPasswordConfirm.same:password'=>'パスワードが一致しません。',
            'upBio.string'=>'Bioが文字列ではありません。',
            'upBio.max'=>'Bioは200文字以下で設定してください。',
            'upimages.mimes'=>'画像(jpg,png,bmp,gif,svg)ファイル以外はアップロードできません。',
            'upimages.regex'=>'ファイル名を英数字のみにしてください。'
        ]);
        $upUsername = $request->input('upUsername');
        $upMail = $request->input('upMail');
        $upPassword = $request->input('upPassword');
        $upPassword = $request->input('upPasswordConfirm');
        if(!isset($upPassword))
        {
            $upPassword = DB::table('users')
                            ->where('id', Auth::id())
                            ->select('users.password')
                            ->first()
                            ->password;
        }
        $upBio = $request->input('upBio');
        $upIcon = $request->file('upimages');
        if(!isset($upIcon))
        {
            $upimages = Auth::user()->images;
        }else{
            $upimages = $upIcon->getClientOriginalName();
            $upIcon->storeAs('/images', $upimages, 'public');

//Laravel6.X ファイルアップロードで検索して画像を保存するよっていう条件式を書く
        }
        // dd($upPassword);
        DB::table('users')
            ->where('id',Auth::id())
            ->update([
            'username' => $upUsername,
            'mail' => $upMail,
            'password' => $upPassword,
            'bio' => $upBio,
            'images' => $upimages,
            'updated_at' => Now()
        ]);
        return redirect('/profile');
    }
}
