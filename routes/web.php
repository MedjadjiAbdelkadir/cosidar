<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\Acte\ActeController;
use App\Http\Controllers\Dashboard\User\UserController;
use App\Http\Controllers\Dashboard\Ilots\IlotController;
use App\Http\Controllers\Dashboard\Local\LocalController;
use App\Http\Controllers\Dashboard\Batiment\BatimentController;
use App\Http\Controllers\Dashboard\Inventaire\InventaireController;
use App\Http\Controllers\Dashboard\Proprietaire\ProprietaireController;

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
    })->name('dashboard');

    // ? Router for Ilots Management
    Route::group(['prefix' => 'ilots', 'as' => 'ilots.'], function () {
        Route::resource('/', IlotController::class);
        Route::delete('/deleted', [IlotController::class, 'deleted'])->name('deleted');
        Route::put('/ilot/update/{id}', [IlotController::class, 'updated'])->name('updated');
        Route::get('/{user_id}/getIliotsByIdUser', [IlotController::class, 'getIliotsByIdUser'])->name('');
        Route::get('/{Num_ilot}/getChildreenOfIlot', [IlotController::class, 'getChildreenOfIlot'])->name('');
        Route::get('/activity-users', [IlotController::class, 'activity_users'])->name('activityUsers');
        Route::post('/update-validation/{ilot}',[IlotController::class, 'updateValidation'])->name('updateValidation');
        Route::post('/filter/activity', [IlotController::class, 'filterActivityByDate'])->name('filterActivityByDate');
    });
    //*  End Ilots Management ****************************************************************

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
     * Users Management
     */
    Route::group(['prefix'=> 'users','as'=>'users.'], function () {
        Route::resource('/', UserController::class);
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
    Route::group(['prefix'=> 'locaux','as'=>'locaux.'], function () {
        Route::resource('/', LocalController::class);
    });


    /**
     * Proprietaire Management
     */
    Route::group(['prefix'=> 'proprietaires','as'=>'proprietaires.'], function () {
        Route::resource('/', ProprietaireController::class);
    });

    /**
     * Actes Management
     */
    Route::group(['prefix'=> 'actes','as'=>'actes.'], function () {
        Route::resource('/', ActeController::class);
    });

    // Route::resource('actes', 'ActeController')->middleware(['auth', 'xss']);
    // proprietaires
    // Route::resource('locaux', 'localController')->middleware(['auth', 'xss']);

});



