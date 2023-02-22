<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User;
use App\Http\Controllers\SMELogbook;

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

Route::middleware('oauth2')->group( function() {

    Route::get('/', function () {
        return view('welcome');
    });

    Route::resource('users', User::class);

    Route::prefix('SME')->name('SME.')->group(function () {
        Route::resource('logbook', SMELogbook::class);

        Route::resource('assignment', SMEAssignment::class);
/*
        Route::get('approval', [SMEApproval::class, 'index'])
        ->name('approval');
*/
    });

    Route::prefix('commercial')->group( function() {
        Route::resource('logbook', CommercialLogbook::class);
    });

});
