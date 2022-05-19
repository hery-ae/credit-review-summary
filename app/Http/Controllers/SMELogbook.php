<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\OAuth2\Client\Provider\GenericProvider;
use Illuminate\Support\Facades\Http;

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
        $headers = ['Content-Type' => 'application/json; charset=utf-8'];

        $genericProvider = (new GenericProvider(config('oauth2login.oauthconf')));
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
        //
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
