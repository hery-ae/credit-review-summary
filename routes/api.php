<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use League\OAuth2\Client\Provider\GenericProvider;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/SME/logbook', function (Request $request) {
    $url = 'http://devdloan.ccbi.co.id/api/aplikasi/comex/5/trackingUser/tables';

    $headers = ['Content-Type' => 'application/json; charset=utf-8'];
    $body = json_encode((object) $request->all());

    [$id, $token] = explode('|', $request->bearerToken(), 2);

    $genericProvider = new GenericProvider(config('oauth2login.oauthconf'));

    $request = $genericProvider->getAuthenticatedRequest('POST', $url, $token, [
            'headers' => $headers,
            'body' => $body,
        ]);

    $response = $genericProvider->getParsedResponse($request);

    $response['data'] = collect($response['data'])->map( function($item) use($genericProvider, $headers, $body, $token) {
        $url = 'http://devdloan.ccbi.co.id/api/v1/aplikasi/'.$item['id'];

        $request = $genericProvider->getAuthenticatedRequest('GET', $url, $token, [
            'headers' => $headers,
            'body' => $body,
        ]);

        $response = $genericProvider->getParsedResponse($request);
        $item['facilities'] = $response['data']['facilities'];

        return $item;
    });

    return response()->json($response);
});
