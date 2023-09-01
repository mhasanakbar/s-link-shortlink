<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Models\Link;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\PasswordController;

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


Route::middleware('auth')->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.delete');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('/home',[DashboardController::class, 'index'])->name('home');
    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    
    Route::group(['middleware' => 'auth', 'as' => 'app.'], function () {
        Route::resource('links', LinkController::class)->names('link');
    });
});

require 'auth.php';

//Digunakan untuk mengarahkan lansung ke dashboard bila link nya /
// Route::get('/',function(){
//     return view('backend/dashboard/index');
// });

//Digunakan sementara untuk masuk ke login
// Route::get('/', function(){
//     return view('auth/login');
// });

Route::get('/', function () {
    return view('auth.LOGIN', [
        'title' => 'Login aS-Link',
    ]);
});

Route::post('/link/guest', [LinkController::class, 'guest'])->name('app.link.guest.store');


Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/logout', [LogoutController::class, '__invoke'])->name('logout');
Route::get('/home', [DashboardController::class, 'index'])->name('home');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::get('/forgot', [PasswordController::class, 'forgot_password'])->name('forgot');
Route::get('/user', [UserController::class, 'index'])->name('user');

//Digunakan Untuk Redirect Shortlink ke Original Link
Route::get('/{link}', function (string $link) {
    $link = Link::where('shorted_link', $link)->get()->first();
    return redirect()->away($link->original_link);
});