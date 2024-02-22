<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\Acte\ActeController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\User\UserController;
use App\Http\Controllers\Dashboard\Ilots\IlotController;
use App\Http\Controllers\Dashboard\Local\LocalController;
use App\Http\Controllers\Dashboard\Batiment\BatimentController;
use App\Http\Controllers\Dashboard\Inventaire\InventaireController;
use App\Http\Controllers\Dashboard\Proprietaire\ProprietaireController;
use App\Http\Controllers\HomeController;
use App\Models\Pays;
use Illuminate\Support\Facades\File;

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
// ? Router for home pages starting
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/template', [HomeController::class, 'template']);
// * end
Route::group(['prefix' => 'dashboard','as' => 'dashboard.'],function(){

    // ? Router for Ilots Management
    // Route::resource('ilots', IlotController::class)->only('show');
    Route::resource('/ilots', IlotController::class);
    Route::group(['prefix' => 'ilots', 'as' => 'ilots.'], function () {
        Route::delete('/deleted', [IlotController::class, 'deleted'])->name('deleted');
        Route::put('/ilot/update/{id}', [IlotController::class, 'updated'])->name('updated');
        Route::get('/{user_id}/getIliotsByIdUser', [IlotController::class, 'getIliotsByIdUser'])->name('');
        Route::get('/{Num_ilot}/getChildreenOfIlot', [IlotController::class, 'getChildreenOfIlot'])->name('');
        Route::get('/activity-users', [IlotController::class, 'activity_users'])->name('activityUsers');
        Route::post('/update-validation/{ilot}',[IlotController::class, 'updateValidation'])->name('updateValidation');
        Route::post('/filter/activity', [IlotController::class, 'filterActivityByDate'])->name('filterActivityByDate');
        // Route::get('/create', [IlotController::class, 'create'])->name();
    });
    //*  End Ilots Management ****************************************************************

});

Route::middleware(["auth"])->group(function() {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});

Route::group(['prefix'=> 'dashboard', 'as'=>'dashboard'], function (){
    /**
     * Dashboard Management
     */
    Route::get('/', DashboardController::class);
});

Route::group(['prefix'=> 'dashboard', 'as'=>'dashboard.'], function (){


    /**
     * Batiment Management
     */
    Route::resource('batiments', BatimentController::class);
    Route::group(['prefix'=> 'batiments','as'=>'batiments.'], function () {
        Route::get('/create_ajax/get', [BatimentController::class ,'create_ajax' ])->name('create_ajax');
        Route::post('/store_ajax', [BatimentController::class ,'store_ajax'])->name('store_ajax');
    });

        /**
     * Users Management
     */
    Route::resource('users', UserController::class);
    Route::group(['prefix'=> 'users','as'=>'users.'], function () {
        Route::post('changeuserstatus/{id}', [UserController::class ,'changeUserStatus'])->name('changeStatus');

        // Route::patch('changeuserstatus/{id}', 'UserController@changeUserStatus')->name('user.status')->middleware(['auth', 'xss']);

    });


    /**
     * inventaire Management
     */
    Route::group(['prefix'=> 'inventaires','as'=>'inventaires.'], function () {
        Route::resource('/', InventaireController::class)->only(['index']);
    });

    /**
     * Locaux Management
     */
    Route::resource('locaux', LocalController::class);

    Route::group(['prefix'=> 'locaux','as'=>'locaux.'], function () {
        // Route::resource('locaux', LocalController::class);
    });


    /**
     * Proprietaire Management
     */
    Route::resource('proprietaires', ProprietaireController::class);

    Route::group(['prefix'=> 'proprietaires','as'=>'proprietaires.'], function () {
    });

    /**
     * Actes Management
     */
    Route::resource('actes', ActeController::class);
    Route::group(['prefix'=> 'actes','as'=>'actes.'], function () {
    });

    // Route::resource('actes', 'ActeController')->middleware(['auth', 'xss']);
    // proprietaires
    // Route::resource('locaux', 'localController')->middleware(['auth', 'xss']);


});

