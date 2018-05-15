<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\Angebot;
use App\Lernzentrum;


class HomeController extends Controller
{
    public function index(Request $request)
    {
        $subject = $request->get('subject');
        $topic = $request->get('topic');
        $perPage = 10;

        if (!empty($subject)) {
            $angebote = Angebot::bySubject($subject)->byTopic($topic)->orderBy('created_at', 'desc')->paginate($perPage);
        } else {
            $angebote = Angebot::orderBy('created_at', 'desc')->paginate($perPage);
        }

        $lernzentrum = Lernzentrum::isFuture()->orderBy('date', 'asc')->first();

        return view('home', compact('lernzentrum', 'angebote'));

    }
}
