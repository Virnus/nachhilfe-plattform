<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Lernzentrum;
use App\Anmeldung;
use App\Topic;

class LernzentrumController extends Controller
{
    /**
     * Gibt gibt den View zurück mit dem aktuellen Lernzentrum
     * @return View home.lernzentrum
     */
    public function index()
    {
        $lernzentrum = Lernzentrum::isFuture()->orderBy('date', 'asc')->first();

        return view('home.lernzentrum', compact('lernzentrum'));
    }

    /**
     * Gibt gibt den View zurück mit dem gegebenen Lernzentrum
     * @return View home.lernzentrum
     */
    public function detail(Lernzentrum $lernzentrum)
    {
        return view('home.lernzentrum', compact('lernzentrum'));
    }

    /**
     * Der angemeldete benutzer wird für das gewünschte Lernzentrum angemeldet,
     * falls er nicht schon angemeldet ist
     * Das fasch, sowie die Topics die der Benutzer lernen will werden gespeichert
     * @param  Request     $request
     * @param  Lernzentrum $lernzentrum
     * @return Redirect    back
     */
    public function signup(Request $request, Lernzentrum $lernzentrum)
    {
        if (!$lernzentrum->isSignUp($request->user())) {

            $anmeldung = Anmeldung::create([
                'user_id' => $request->user()->id,
                'lernzentrum_id' => $lernzentrum->id
            ]);

            if ($request->topics) {
                $topics = explode(',', $request->topics);

                foreach ($topics as $topic) {

                    if (is_numeric($topic)) {
                        $anmeldung->topics()->attach(Topic::find(intval($topic)));
                    } else {
                        $topic = Topic::create([
                            'name' => $topic,
                            'subject_id' => $request->subject_id
                        ]);

                        $anmeldung->topics()->attach($topic);
                    }
                }

            }
        }

        return back();
    }

    /**
     * Der angemeldete Benutzer wird vom gewünschten Lernzentrum abgemeldet
     * @param  Request     $request
     * @param  Lernzentrum $lernzentrum
     * @return Redirect    back
     */
    public function signout(Request $request, Lernzentrum $lernzentrum)
    {
        $anmeldung = $request->user()->anmeldungen()->byLernzentrum($lernzentrum)->first();

        $anmeldung->topics()->detach();
        $anmeldung->delete();

        return back();
    }
}
