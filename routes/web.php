<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login');
Route::post('/login', 'Auth\LoginController@login');
Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');
Route::get('/added', 'Auth\RegisterController@added');
Route::get('/logout', 'Auth\LoginController@logout');


//ログイン中のページ
Route::get('/top','PostsController@index');
Route::post('/create','PostsController@create');
Route::post('/delete','PostsController@delete');
Route::get('/profile/{userId}','UsersController@profile');
Route::get('/profile','UsersController@setting');
Route::post('/profile','UsersController@upsetting');
Route::get('/search','UsersController@index');
Route::post('/search','UsersController@search');
Route::post('/unfollow','UsersController@unfollow');
Route::post('/follow','UsersController@follow');
Route::get('/followList','followsController@followList');
Route::get('/followerList','followsController@followerList');
Route::post('/update','PostsController@update');

Route::get('/test','PostsController@tests');
