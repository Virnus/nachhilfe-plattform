<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LernzentrumSupportController extends Controller
{
    /**
     * Gibt gibt den View zuück auf dem alle Lernzentrum Aufgebote aufgelistet sind
     * @param  Request $request
     * @return View account.lernzentrum-support
     */
    public function index(Request $request)
    {
        return view('account.lernzentrum-support');
    }
}
