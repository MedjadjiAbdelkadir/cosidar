<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\Ilots\IlotController;
use Illuminate\Support\Facades\Auth;
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
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'dashboard','as' => 'dashboard.','middleware' => ['auth', 'verified']],function(){

    Route::get('/', function () {
        return view('dashboard');
    });

    Route::group(['prefix' => 'ilots'], function(){
        Route::resource('/', [IlotController::class]);

    });

    Route::get('/users', function () {
        return view('dashboard.user.index');
    });
});

Route::middleware(["auth"])->group(function() {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
