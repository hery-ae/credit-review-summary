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

Route::get('/oauth2', function() {

return view('SME.logbook.index');

    return view('oauth2');
    //return redirect('/oauth2/callback?code='.Str::random(64).'&state='.session()->get(config('oauth2login.session_key_state')));
});

Route::middleware('oauth2')->group( function() {

    Route::get('/', function () {
        return view('welcome');
    });

    Route::resource('users', User::class);

    Route::prefix('SME')->group( function() {
        Route::resource('logbook', SMELogbook::class);
    });

    Route::prefix('commercial')->group( function() {
        Route::resource('logbook', CommercialLogbook::class);
    });

});
