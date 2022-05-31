<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\OAuth2\Client\Provider\GenericProvider;

class SMELogbook extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $url = 'http://devdloan.ccbi.co.id/api/aplikasi/comex/5/trackingUser/tables';
//$url = 'http://devdloan.ccbi.co.id/api/v1/aplikasi/2602/';
        $headers = ['Content-Type' => 'application/json; charset=utf-8'];
dd ([
\App\Models\User::first()->createToken('SSO')->toArray(),
\App\Models\User::first()->tokens,
session()->get(config('oauth2login.session_key'))->getToken(),

]);
        $genericProvider = (new GenericProvider(config('oauth2login.oauthconf')));
//$request = $genericProvider->getAuthenticatedRequest('GET', $url, session()->get(config('oauth2login.session_key')), [
        $request = $genericProvider->getAuthenticatedRequest('POST', $url, session()->get(config('oauth2login.session_key')), [
                'headers' => $headers,
                'body' => '{}'
            ]);

        return view('SME.logbook.index', [
            'applications' => $genericProvider->getParsedResponse($request),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        return view('SME.logbook.show', [
            //'applications' => $genericProvider->getParsedResponse($request),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
