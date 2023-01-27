<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
//    return view('welcome');
    $posts=\App\Models\Post::all();
    $images=\App\Models\Image::all();
    return view('index')->with(compact('posts','images'));
})->middleware('auth');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();
Route::group(['prefix'=>'post'],function (){
    Route::get('/userPost',function (){return view('content public/postUser');})->name('userPost');
    Route::post('/sendPost',[\App\Http\Controllers\PostController::class,'createPost'])->name('createPost');
    Route::post('/likePost',[\App\Http\Controllers\PostController::class,'likePost'])->name('likePost');
    Route::post('/disLikePost',[\App\Http\Controllers\PostController::class,'disLikePost'])->name('disLikePost');
});
Route::group(['prefix'=>'comment'],function (){
    Route::post('/createComment',[\App\Http\Controllers\commentController::class,'create'])->name('createComment');

});

