<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\Ilots\IlotController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\User\UserController;
use App\Http\Controllers\Dashboard\Batiment\BatimentController;

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

define('PAGINATE_COUNT',7);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'dashboard','as' => 'dashboard.','middleware' => ['auth', 'verified']],function(){

    Route::get('/', function () {
        return view('dashboard');
    });


    Route::get('/users', function () {
        return view('dashboard.user.index');
    });
});

Route::middleware(["auth"])->group(function() {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});

Route::group(['prefix'=> 'dashboard', 'as'=>'dashboard.'], function (){

    /**
     * Batiment Management
     */
    Route::group(['prefix'=> 'batiments','as'=>'batiments.'], function () {
        Route::resource('/', BatimentController::class);
        Route::get('/create_ajax/get', [BatimentController::class ,'create_ajax' ])->name('create_ajax');
        Route::post('/store_ajax', [BatimentController::class ,'store_ajax'])->name('store_ajax');
    });

        /**
     * Batiment Management
     */
    Route::group(['prefix'=> 'users','as'=>'users.'], function () {
        Route::resource('/', UserController::class);
    });




});



