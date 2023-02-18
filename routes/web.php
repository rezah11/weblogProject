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
    $posts = \App\Models\Post::where('status', true)->get();
//    dd($posts);
    $images = \App\Models\Image::all();
    return view('index')->with(compact('posts', 'images'));
})->middleware('auth');

Route::group(['prefix' => 'dashboard'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/allusers', [App\Http\Controllers\HomeController::class, 'allUsers'])->name('allUsers');
    Route::get('/allposts', [App\Http\Controllers\HomeController::class, 'allPosts'])->name('allPosts');
    Route::get('/allposts/changeStatus/{id}', [App\Http\Controllers\HomeController::class, 'changeStatus'])->name('changeStatus');
    Route::get('/allusers/removeuser/{id}', [App\Http\Controllers\PostController::class, 'removeUser'])->name('removeUser');
    Route::get('/allcomments', [App\Http\Controllers\HomeController::class, 'allComments'])->name('allComments');
    Route::get('/changestatuscomment/{id}', [App\Http\Controllers\HomeController::class, 'changeStatusComment'])->name('changeStatusComment');

});
Auth::routes();
Route::group(['prefix' => 'post'], function () {
    Route::get('/userPost/{edit?}', function () {
        return view('content public/postUser');
    })->name('userPost');

    Route::get('/userPost/{edit?}/delImage/{id}', [\App\Http\Controllers\PostController::class, 'deleteImages'])->name('delImage');
    Route::post('/userPost/update/{id}', [\App\Http\Controllers\PostController::class, 'updatePost'])->name('updatePost');
    Route::get('/userPost/delete/{id}', [\App\Http\Controllers\PostController::class, 'deletePost'])->name('deletePost');
    Route::post('/sendPost', [\App\Http\Controllers\PostController::class, 'createPost'])->name('createPost');
    Route::post('/likePost', [\App\Http\Controllers\PostController::class, 'likePost'])->name('likePost');
    Route::post('/disLikePost', [\App\Http\Controllers\PostController::class, 'disLikePost'])->name('disLikePost');
});
Route::group(['prefix' => 'user'], function () {
    Route::get('/follow/{id}', [\App\Http\Controllers\HomeController::class, 'userFollow'])->name('userFollow');
    Route::get('/unFollow/{id}', [\App\Http\Controllers\HomeController::class, 'userUnfollow'])->name('userUnfollow');
    Route::get('/unFollowFollowing/{id}', [\App\Http\Controllers\HomeController::class, 'unfollowFollowingUser'])->name('UnfollowFollowing');
    Route::get('/follows/{type}', function () {
        return view('content public/follow');
    })->name('userFollowers')->middleware(['auth']);
});
Route::group(['prefix' => 'comment'], function () {
    Route::post('/createComment', [\App\Http\Controllers\commentController::class, 'create'])->name('createComment');
    Route::post('/likeComment', [\App\Http\Controllers\commentController::class, 'likeComment'])->name('likeComment');
    Route::post('/disLikeComment', [\App\Http\Controllers\commentController::class, 'disLikeComment'])->name('disLikeComment');
});


