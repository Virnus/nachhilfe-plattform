<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

use App\User;
use App\Mail\Home\UserContacted;

class UserController extends Controller
{
    public function detail(User $user)
    {
        return view('home.users.detail')
            ->with('user', $user);
    }

    public function store(User $user, Request $request)
    {
        Mail::to($user)->send(new UserContacted(auth()->user(), $request->title, $request->content));

        return back()
            ->withSuccess('Benutzer wurde kontaktiert.');
    }
}