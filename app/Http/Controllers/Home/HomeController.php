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
        $subject = $request->get('subject');
        $topic = $request->get('topic');
        $perPage = 5;

        if (!empty($subject)) {
            $angebots = Angebot::bySubject($subject)->byTopic($topic)->paginate($perPage);
        } else {
            $angebots = Angebot::paginate($perPage);
        }

        $lernzentrum = Lernzentrum::isFuture()->orderBy('date', 'asc')->first();

        return view('home', compact('lernzentrum', 'angebots'));

    }
}
