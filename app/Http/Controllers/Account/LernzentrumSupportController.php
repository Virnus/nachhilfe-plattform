<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LernzentrumSupportController extends Controller
{
    public function index(Request $request)
    {
        return view('account.lernzentrum-support');
    }
}
