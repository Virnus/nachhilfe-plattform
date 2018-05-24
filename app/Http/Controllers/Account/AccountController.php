<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    /**
     * Gibt gibt den View für das Account Dashboard zurück
     * @return View account.index
     */
    public function index()
    {
        return view('account.index');
    }
}
