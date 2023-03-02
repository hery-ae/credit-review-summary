<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SMEApproval extends Controller
{
    public function index()
    {
        return view('SME.approval.index');
    }
}
