<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rules\CurrentPassword;
use Illuminate\Support\Facades\Mail;
use App\Mail\Account\PasswordUpdated;

class PasswordController extends Controller
{
    public function index()
    {
        return view('account.password');
    }

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

        return redirect()->route('account')->withSuccess('Passwort wurde geändert.');
    }
}
