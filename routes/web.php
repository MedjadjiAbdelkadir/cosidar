<?php

use App\Models\Pays;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\Acte\ActeController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\User\UserController;
use App\Http\Controllers\Dashboard\Ilots\IlotController;
use App\Http\Controllers\Dashboard\Local\LocalController;
use App\Http\Controllers\Dashboard\Article\ArticleController;
use App\Http\Controllers\Dashboard\Batiment\BatimentController;
use App\Http\Controllers\Dashboard\Evaluation\EvaluationController;
use App\Http\Controllers\Dashboard\Inventaire\InventaireController;
use App\Http\Controllers\Dashboard\Fournisseur\FournisseurController;
use App\Http\Controllers\Dashboard\IlotsArchive\IlotsArchiveController;
use App\Http\Controllers\Dashboard\Proprietaire\ProprietaireController;
use App\Http\Controllers\Dashboard\EtatInventaire\EtatInventaireController;

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

Route::middleware(["auth"])->group(function() {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});

Route::get('/template', [HomeController::class, 'template']);
// * end
Route::group(['prefix' => 'dashboard','as' => 'dashboard.', 'middleware' => ['auth']],function(){
    // ? Router for Ilots Management
    // Route::resource('ilots', IlotController::class)->only('show');
    Route::resource('/ilots', IlotController::class);
    Route::group(['prefix' => 'ilots', 'as' => 'ilots.'], function () {
        Route::delete('/deleted', [IlotController::class, 'deleted'])->name('deleted');
        Route::put('/ilot/update/{id}', [IlotController::class, 'updated'])->name('updated');
        Route::get('/{user_id}/getIliotsByIdUser', [IlotController::class, 'getIliotsByIdUser'])->name('');
        Route::get('/{Num_ilot}/getChildreenOfIlot', [IlotController::class, 'getChildreenOfIlot'])->name('');
        Route::post('/update-validation/{ilot}',[IlotController::class, 'updateValidation'])->name('updateValidation');
        Route::post('/filter/activity', [IlotController::class, 'filterActivityByDate'])->name('filterActivityByDate');
        Route::get('/vue-generale/{Num_ilot}',[IlotController::class, 'vueGenerale'])->name('vuegenerale');
        Route::post('/added/note', [IlotController::class, 'addNoteIlot'])->name('notes');
        Route::get('/vue/identification/{Num_ilot}', [IlotController::class, 'get_full_detail_ilot'])->name('vueidentification');
        // Route::get('/create', [IlotController::class, 'create'])->name();
    });
    Route::get('activity-users', [IlotController::class, 'activity_users'])->name('ilots.activityUsers');

    Route::get('details', [IlotController::class, 'details'])->name('ilots.details');
    Route::get('/proprietaire/pays/{pays}', [IlotController::class, 'getIlotsByPays'])->name('ilots.proprietaireby_country');

    Route::get('/proprietaire/{proprietaire_id}', [IlotController::class, 'getIlotsByPproprietaire'])->name('ilots.by_proprietaire');
    Route::get('/getIlotByProprietaire', [IlotController::class, 'getIlotByProprietaire'])->name('ilots.getIlotByProprietaire');
    Route::get('/getNuméroIlotByDenom_Ilot', [IlotController::class, 'getNuméroIlotByDenom_Ilot'])->name('ilots.getNuméroIlotByDenom_Ilot');

    // 
    Route::get('/ilots/get_full_detail_ilot/{Num_ilot}',[IlotController::class, 'get_full_detail_ilot'])->name('ilots.get_full_detail_ilot');
    // Route::get('/ilots/pays/{pays}', 'IlotController@getIlotsByPays')->name('ilots.by_pays');
    //*  End Ilots Management ****************************************************************

    //  ? Router for Evaluation  Management
    Route::resource( '/evaluations', EvaluationController::class );
    Route::group(['prefix' => 'evaluations', 'as' => 'evaluations.'], function () {
        Route::get('/immeuble', [EvaluationController::class, 'immeuble']);
        Route::get('/biens/consider', [EvaluationController::class, 'biensConsider'])->name('biens.consider');

    });
});

    Route::group(['prefix'=> 'dashboard', 'as'=>'dashboard', 'middleware' => ['auth']], function (){
        /**
         * Dashboard Management
         */
        Route::get('/', DashboardController::class);
    });

    Route::group(['prefix'=> 'dashboard', 'as'=>'dashboard.', 'middleware' => ['auth']], function (){
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
        Route::put('changeuserstatus/{id}', [UserController::class ,'changeUserStatus'])->name('changeStatus');
        // Route::patch('changeuserstatus/{id}', 'UserController@changeUserStatus')->name('user.status')->middleware(['auth', 'xss']);
    });
    /**
     * inventaire Management
     */
    Route::resource('inventaires', InventaireController::class);
    Route::group(['prefix'=> 'inventaires','as'=>'inventaires.'], function () {
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
    // Route::resource('proprietaires', ProprietaireController::class);
    Route::post('getProprietaireByPays', [ProprietaireController::class ,'getProprietaireByPays' ])->name('getProprietaireByPays');


    // 
    Route::group(['prefix'=> 'proprietaires','as'=>'proprietaires.'], function () {
        Route::post('/pays', [ProprietaireController::class, 'payaSreach'])->name('pays.search');
        Route::post('/postes/search', [ProprietaireController::class, 'postes'])->name('postes.search');
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

    Route::resource('fournisseurs', FournisseurController::class);

    Route::resource('articles', ArticleController::class);

    Route::resource('etats', EtatInventaireController::class);

    Route::resource('ilots-archive', IlotsArchiveController::class);

    Route::post('/ilots-archive/search', [IlotsArchiveController::class, 'getIlotByProprietaireId'])->name('ilots-archive.search');
    //
    // MutationGlobale

});

