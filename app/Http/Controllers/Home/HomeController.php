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
        $angebot = $request->get('angebot');
        $search = $request->get('search');
        $subject = $request->get('subject');
        $topic = $request->get('topic');

        if (!empty($search)) {
            $angebote = Angebot::filter($search);
        } else if (!empty($angebot)) {
            $angebote = Angebot::byId($angebot);
        } else if (!empty($subject)) {
            $angebote = Angebot::bySubject($subject)->byTopic($topic)->orderBy('created_at', 'desc');
        } else {
            $angebote = Angebot::orderBy('created_at', 'desc');
        }

        $lernzentrum = Lernzentrum::isFuture()->orderBy('date', 'asc')->first();

        return view('home')
            ->with('angebote', $angebote->paginate(10))
            ->with('lernzentrum', $lernzentrum);

    }
}
