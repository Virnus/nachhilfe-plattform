<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    /**
     * Gibt gibt den View zurück mit dem Formular um das Profil zu ändern.
     * @return View account.profile
     */
    public function index()
    {
        return view('account.profile');
    }

    /**
     * Die Eingaben werden nach verschiedenen Kriterien geprüft.
     * Die neuen Daten werden gespeichert.
     * @param  Request $request
     * @return Redirect back
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . auth()->id()
        ]);

        $request->user()->update($request->only('name', 'email'));

        return back()->withSuccess('Profil wurde gespeichert.');
    }
}
