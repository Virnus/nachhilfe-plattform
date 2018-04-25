<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Lernzentrum;

class LernzentrumController extends Controller
{
    public function index()
    {
        $lernzentrum = Lernzentrum::isFuture()->orderBy('date', 'asc')->first();

        return view('home.lernzentrum', compact('lernzentrum'));
    }

    public function detail(Lernzentrum $lernzentrum)
    {
        return view('home.lernzentrum', compact('lernzentrum'));
    }

    public function signup(Request $request, Lernzentrum $lernzentrum)
    {
        if (!$request->user()->lernzentrums->contains($lernzentrum)) {
            $request->user()->lernzentrums()->attach($lernzentrum);
        }

        return back();
    }

    public function signout(Request $request, Lernzentrum $lernzentrum)
    {
        $request->user()->lernzentrums()->detach($lernzentrum);

        return back();
    }
}
