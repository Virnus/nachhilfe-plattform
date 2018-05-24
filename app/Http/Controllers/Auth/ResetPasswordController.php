<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Setzt das Passwort zurück
     * Führt Illuminate\Auth\Events\PasswordReset Event aus
     * Loggt dn User ein, falls er aktiv ist
     * @param User $user
     * @param String $password
     */
    protected function resetPassword($user, $password)
    {
        $user->password = Hash::make($password);

        $user->setRememberToken(str_random(60));

        $user->save();

        event(new PasswordReset($user));

        if ($user->active) {
            $this->guard()->login($user);
        }
    }

    /**
     * Leitet den User weiter
     */
    protected function sendResetResponse($response)
    {
        return redirect($this->redirectPath())
            ->withSuccess('Ihr Passwort wurde zurückgesetzt.');
    }
}
