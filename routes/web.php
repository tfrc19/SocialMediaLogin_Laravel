<?php

use App\Http\Controllers\SocialMediaLoginController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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
    return view('welcome');
});

//Route Login Social Media
/*
Route::get('/auth/facebook',function(){
    return Socialite::driver('facebook')->redirect();
});
Route::get('/auth/facebook/callback',function(){
    $user=Socialite::with('facebook')->stateless()->user();
    dd($user);
});*/

Route::get('/auth/{driver}',[SocialMediaLoginController::class,'SocialRedirect']);
Route::get('/auth/{driver}/callback',[SocialMediaLoginController::class,'LoginSocialMedia']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
