<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\User;

class ActivationController extends Controller
{
    /**
     * Sucht den gesuchten User in der DB
     * Updated den gesuchten User als activated
     * Loggt den gesuchten User ein
     * @param  Request $request
     * @return Redirect home
     */
    public function activate(Request $request)
    {
        $user = User::byActivationColumns($request->email, $request->token)->firstOrFail();

        $user->update([
            'active' => true,
            'activation_token' => null
        ]);

        Auth::loginUsingId($user->id);

        return redirect()->route('home')->withSuccess('Aktiviert. Sie wurden erfolgreich eingeloggt.');
    }


}
