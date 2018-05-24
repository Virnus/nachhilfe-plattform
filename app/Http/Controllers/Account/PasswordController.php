<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rules\CurrentPassword;
use Illuminate\Support\Facades\Mail;
use App\Mail\Account\PasswordUpdated;

class PasswordController extends Controller
{
    /**
     * Gibt gibt den View zuück mit dem Formular um das Passwort zurückzusetzten.
     * @return View account.password
     */
    public function index()
    {
        return view('account.password');
    }

    /**
     * Testet ob das alte Passwort korrekt ist das neue zweimal gleich eigegeben wurde.
     * Das neue Passwort wird verschlüsselt und gespeichert.
     * Dem Benutze wird ein Mail gesendet mit der Information, dass sein Passwort geändert wurde.
     * @param  Request $request [description]
     * @return Redirect account.index
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'password_current' => ['required', new CurrentPassword()],
            'password' => 'required|string|min:6|confirmed'
        ]);

        $request->user()->update([
            'password' => bcrypt($request->password)
        ]);

        Mail::to($request->user())->send(new PasswordUpdated());

        return redirect()->route('account.index')->withSuccess('Passwort wurde geändert.');
    }
}
