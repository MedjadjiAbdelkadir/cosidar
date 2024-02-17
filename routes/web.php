<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/dashboard', function () {
    return view('dashboard');
});


Route::get('/dashboard/users', function () {
    return view('dashboard.user.index');
});

Route::group(['prefix'=> 'dashboard', 'as'=>'dashboard.'], function (){

    /**
     * Batiment Management
     */
    Route::group(['prefix'=> 'batiments','as'=>'batiments.'], function () {
        Route::resource('/', BatimentController::class);
        Route::get('/batiments/create_ajax/get', [BatimentController::class ,'create_ajax' ])->name('create_ajax');
        Route::post('/batiments/store_ajax', [BatimentController::class ,'store_ajax'])->name('store_ajax');

        // Route::get('/batiment/{Num_batiment}', [BatimentController::class ,'show'])->name('batiment.show');
        // Route::get('/batiments/create', [BatimentController::class ,'create'])->name('batiments.create');

        // Route::get('get_stages', [StageController::class, 'getStages'])->name('stages.get_stages');
    });
});



