<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController as hc;
use App\Http\Controllers\ActionController as ac;
use App\Http\Controllers\ChatController as cc;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[hc::class,'home']);
Route::get('register',[hc::class,'register']);
Route::get('login',[hc::class,'login']);
Route::get('forget-password',[hc::class,'forgetPassword']);
Route::get('logout',[hc::class,'logout']);


// Post
Route::post('register',[hc::class, 'registerUser']);
Route::post('login',[hc::class, 'auth']);

Route::group(['middleware'=>'loginauth'],function(){
    Route::get('chat/{username}',[hc::class,'chat']);
    Route::get('profile/{username}',[hc::class,'profile']);
    Route::get('edit-profile',[hc::class,'editProfile']);
    Route::get('post',[ac::class,'post']);
    Route::get('feed',[ac::class,'feed']);
    
    // Ajax
    Route::get('like-post',[ac::class,'likePost']);
    Route::get('get-likes',[ac::class,'getLikes']);
    Route::get('get-comments',[ac::class,'getComments']);
    Route::get('get-recent-comments',[ac::class,'getRecentComments']);

    Route::post('add-comment',[ac::class,'addComment']);
    Route::post('send-msg',[cc::class,'sendMessage']);
    Route::get('get-messages',[cc::class,'getMessages']);

    
    
    Route::post('edit-profile',[hc::class,'updateProfile']);
    Route::post('post',[ac::class,'savePost']);
});