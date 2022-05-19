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

/*
Route::post('/oauth2', function() {



$http = Http::withHeaders([
    'Content-Type' => 'application/json',
    'Accept' => 'application/json',
    'Authorization' => 'Bearer eyJhbGciOiJSUzI1NiIsInR5cCIgOiAiSldUIiwia2lkIiA6ICJRT0Exdl9IaWN4eEl1WkxlNHlDQ21pN0lxM3RmcEUwT2RrMXJtYnVQRVNZIn0.eyJqdGkiOiI1ODBlMWUxNC05NzhmLTRjNjctODEyYi04OWE5ZThlOTk4ZDkiLCJleHAiOjE2NTA4NzU0MDksIm5iZiI6MCwiaWF0IjoxNjUwODczNjY5LCJpc3MiOiJodHRwczovL3Nzby5jY2JpLmNvLmlkL2F1dGgvcmVhbG1zL2NjYmkiLCJhdWQiOiJkY3JvcHMiLCJzdWIiOiIyMjUxM2MyNS02YWI2LTQwNjUtYTEyYi03NDNhY2VjMzAwOTMiLCJ0eXAiOiJCZWFyZXIiLCJhenAiOiJkY3JvcHMiLCJhdXRoX3RpbWUiOjE2NTA4NzI4NDksInNlc3Npb25fc3RhdGUiOiIxZTViMTQ2Ni02MThmLTQ4MGYtYjIxNi02Nzg2OWU5OGJjNGUiLCJhY3IiOiIwIiwiYWxsb3dlZC1vcmlnaW5zIjpbImh0dHBzOi8vZGNyb3BzLmNjYmkuY28uaWQiXSwicmVhbG1fYWNjZXNzIjp7InJvbGVzIjpbIlNVUEVSIEFETUlOIiwib2ZmbGluZV9hY2Nlc3MiLCJ1bWFfYXV0aG9yaXphdGlvbiJdfSwicmVzb3VyY2VfYWNjZXNzIjp7Imxvcy1zZXJ2aWNlIjp7InJvbGVzIjpbImNvbW1lcmNpYWwiLCJjb21leCIsImNvcnBvcmF0ZSIsImNvbnN1bWVyIl19LCJsb3MiOnsicm9sZXMiOlsiU0EiXX0sImRjcm9wcyI6eyJyb2xlcyI6WyJVc2VyIERDUk9QUyJdfSwiZGNpZiI6eyJyb2xlcyI6WyJBRE0iXX0sInJlYWxtLW1hbmFnZW1lbnQiOnsicm9sZXMiOlsidmlldy1yZWFsbSIsInZpZXctaWRlbnRpdHktcHJvdmlkZXJzIiwibWFuYWdlLWlkZW50aXR5LXByb3ZpZGVycyIsImltcGVyc29uYXRpb24iLCJyZWFsbS1hZG1pbiIsImNyZWF0ZS1jbGllbnQiLCJtYW5hZ2UtdXNlcnMiLCJxdWVyeS1yZWFsbXMiLCJ1bWFfcHJvdGVjdGlvbiIsInZpZXctYXV0aG9yaXphdGlvbiIsInF1ZXJ5LWNsaWVudHMiLCJxdWVyeS11c2VycyIsIm1hbmFnZS1ldmVudHMiLCJtYW5hZ2UtcmVhbG0iLCJ2aWV3LWV2ZW50cyIsInZpZXctdXNlcnMiLCJ2aWV3LWNsaWVudHMiLCJtYW5hZ2UtYXV0aG9yaXphdGlvbiIsIm1hbmFnZS1jbGllbnRzIiwicXVlcnktZ3JvdXBzIl19LCJiaW1hIjp7InJvbGVzIjpbIlNVUEVSX0FETUlOIl19LCJjdXN0b2R5Ijp7InJvbGVzIjpbImFkbWluIl19LCJhY2NvdW50Ijp7InJvbGVzIjpbIm1hbmFnZS1hY2NvdW50IiwibWFuYWdlLWFjY291bnQtbGlua3MiLCJ2aWV3LXByb2ZpbGUiXX0sInNzby1tYW5hZ2VtZW50Ijp7InJvbGVzIjpbIlNTT19BRE1JTiJdfX0sInNjb3BlIjoicHJvZmlsZSBFbXBsb3llZV9BdHRyaWJ1dGVzIGVtYWlsIiwiaWRfbnVtYmVyIjoiMzI3NzAzMDUwNTk0MDAyMiIsImVtYWlsX3ZlcmlmaWVkIjp0cnVlLCJlbXBsb3llZV9hZGRyZXNzIjoiSmwuIENpYXdpdGFsaSBOby4gMjAyIEEgUnQwMDQtUncwMDlcclxuS2VsLiBDaXRldXJldXBcclxuS2VjLiBDaW1haGkgVXRhcmFcclxuQ2ltYWhpIiwic3RhdHVzX25hbWUiOiJBY3RpdmUiLCJyb2xlcyI6WyJvZmZsaW5lX2FjY2VzcyIsInVtYV9hdXRob3JpemF0aW9uIiwiU1VQRVIgQURNSU4iXSwic2V4IjoiTWFsZSIsImVtcGxveWVlX2NvbnRhY3QiOiIiLCJzZWN0aW9uIjoiIiwicHJlZmVycmVkX3VzZXJuYW1lIjoiMTggMzg5MSIsImdpdmVuX25hbWUiOiJGQVFJSCBTQUxCQU4gUkFCQkFOSSIsImJyYW5jaCI6IkthbnRvciBQdXNhdC1CYW5kdW5nIiwicGljdHVyZSI6Imh0dHA6Ly9hY2NvdW50LmNjYmkuY28uaWQvcHJvZmlsZS9waWN0dXJlIiwic3ViX3VuaXQiOiIiLCJkaXZpc2lvbiI6IklUIFNZU1RFTSBERVZFTE9QTUVOVCIsInVuaXQiOiIiLCJtYXJpdGFsX3N0YXR1cyI6IlNpbmdsZSIsImVtcGxveWVlX2hhbmRfcGhvbmUiOiIiLCJuYW1lIjoiRkFRSUggU0FMQkFOIFJBQkJBTkkiLCJlbXBsb3llZV9zdGF0dXMiOiJQZXJtYW5lbnQiLCJqb2IiOiJQcm9ncmFtbWVyIiwiZGVwYXJ0bWVudCI6IiIsImpvYl90aXRsZSI6IkNsZXJpY2FsIiwiZW1haWwiOiJmYXFpaC5zYWxiYW5AaWRuLmNjYi5jb20ifQ.bDL8-8WBKS-r9x0g-vx5CDVKUINoFvd4FrSTMzQFnSrxfJa41QH0Z4Hhh1gn_8mfz41rqYorax-w15GGzazgN5EK4-7-oQThufClr2pjju83qXtSMagKpo_I0CcIZIMw_tjQJSIbZ2lCZDFtxUgmWchrn8E56OAxqS82QBjSs3s6LSPd5k1P6A1llDHirIcFZn17P_CrSWQgFDX9JKDA5ns-QoW2n0CsKcYet-wjZkOHnpzFlFdJIZEq8zn7V45HxSrMYFZzs3ByANu9vy-pASDW1kRBBrDxz3PBtBgOhloKXHJB_wEdagsZFhxrYfLbdWnxlFNCzK_Tt6HVqBqn6g',
])
->post('http://devdloan.ccbi.co.id/api/aplikasi/commercial/0/trackingUser/tables', request()->all())

;

return $http;



return view('SME.logbook.index');

    return view('oauth2');
    //return redirect('/oauth2/callback?code='.Str::random(64).'&state='.session()->get(config('oauth2login.session_key_state')));
});

Route::get('/oauth', function() {



return view('SME.logbook.index');
});
*/

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
