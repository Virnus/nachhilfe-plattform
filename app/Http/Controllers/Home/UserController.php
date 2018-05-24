<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

use App\User;
use App\Mail\Home\UserContacted;

class UserController extends Controller
{
    /**
     * Das Profil des gewünschten Users wird angezeigt
     * @param  Request $request
     * @param  String  $username
     * @return View    home.users.detail
     */
    public function detail(Request $request, $username)
    {
        if (strlen($username) < 3) {
            return abort(404);
        }

        $subject = $request->get('subject');
        $topic = $request->get('topic');
        $perPage = 10;

        $user = User::byUsername($username)->isActive()->firstOrFail();

        if (!empty($subject)) {
            $angebote = $user->angebots()->bySubject($subject)->byTopic($topic)->orderBy('created_at', 'desc')->paginate($perPage);
        } else {
            $angebote = $user->angebots()->orderBy('created_at', 'desc')->paginate($perPage);
        }

        return view('home.users.detail')
            ->with('user', $user)
            ->with('angebote',$angebote);
    }

    /**
     * dem gewünschten User wird eine Mail vom authentifizierten User gesendet
     * @param  String   $username
     * @param  Request  $request
     * @return Redirect back
     */
    public function store($username, Request $request)
    {
        $user = User::byUsername($username)->isActive()->firstOrFail();

        Mail::to($user)->send(new UserContacted(auth()->user(), $request->title, $request->content));

        return back()
            ->withSuccess('Benutzer wurde kontaktiert.');
    }
}
