<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/test', function () {
//    return [ٍ
//        'name'=>'reza',
//        'family'=>'hosseini',
//    ];
    return response()->json(['error' => 'testErr'], 401);
});
Route::group(['prefix' => 'user'], function () {
    Route::get('/users', [\App\Http\Controllers\userController::class, 'allUsersApi'])->name('usersApi');
    Route::get('/{id}', [\App\Http\Controllers\userController::class, 'userApi'])->name('userApi');
    Route::post('/create', [\App\Http\Controllers\userController::class, 'createUsersApi'])->name('createUsersApi');
    Route::put('/update/{id}', [\App\Http\Controllers\userController::class, 'updateUsersApi'])->name('updateUsersApi');
    Route::delete('/delete/{id}', [\App\Http\Controllers\userController::class, 'deleteUserApi'])->name('deleteUserApi');
});
Route::group(['prefix'=>'post'],function (){
   Route::get('/all',[\App\Http\Controllers\PostController::class,'allPostsApi'])->name('allPostsApi');
});
