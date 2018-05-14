<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\Angebot;
use App\Lernzentrum;
use App\Subject;


class HomeController extends Controller
{
    public function index(Request $request)
    {
        $lernzentrum = Lernzentrum::isFuture()->orderBy('date', 'asc')->first();

        $angebots= Angebot::paginate(10);



        $subjects = Subject::all();

        $topics = Subject::find(1)
        ->topics;

        return view('home', compact('lernzentrum'))
        ->with('angebots', $angebots)
        ->with('subjects', $subjects)
        ->with('topics', $topics);

        }



}
