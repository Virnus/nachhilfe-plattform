<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LernzentrumController extends Controller
{
    /**
     * Gibt gibt den View zuück auf dem alle Lernzentrum Anmeldungen aufgelistet sind
     * @param  Request $request
     * @return View account.lernzentrum
     */
    public function index(Request $request)
    {
        return view('account.lernzentrum')
            ->with('anmeldungen', auth()->user()->anmeldungen);
    }
}
