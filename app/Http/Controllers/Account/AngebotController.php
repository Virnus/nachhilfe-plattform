<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Angebot;
use App\Subject;
use App\Topic;

class AngebotController extends Controller
{
    /**
     * Gibt den View für die eigenen Angebote zurück
     * @param  Request $request
     * @return View account.angebot.index
     */
    public function index(Request $request)
    {
        return view('account.angebot.index')
            ->with('angebots', $request->user()->angebots);
    }

    /**
     * Gibt den View für das Formular zurück um ein neues Angebot zu erstellen.
     * @return Viwe account.angebot.create
     */
    public function create()
    {
        return view('account.angebot.create');
    }

    /**
     * Speichert das erstellte Angebot mitsamt den Topics
     * @param  Request $request
     * @return Redirect
     */
    public function store(Request $request)
    {
        $angebot = Angebot::create([
            'title' => $request->title,
            'info' => $request->info,
            'user_id' => $request->user()->id,
            'subject_id' => $request->subject_id,
        ]);

        if ($request->topics) {
            $topics = explode(',', $request->topics);

            foreach ($topics as $topic) {

                if (is_numeric($topic)) {
                    $angebot->topics()->attach(Topic::find(intval($topic)));
                } else {
                    $topic = Topic::create([
                        'name' => $topic,
                        'subject_id' => $request->subject_id
                    ]);

                    $angebot->topics()->attach($topic);
                }
            }
        }

        return redirect()->route('account.angebote.index')
            ->withSuccess('Angebot wurde erfolgreich erstellt.');

    }

    /**
     * Gibt den View für das verlangte Angebot zurück sofern es zu dem angemeldeten User gehört.
     * @param  Angebot $angebot
     * @return View account.angebot.edit
     */
    public function edit(Angebot $angebot)
    {
        if (!$angebot->isOwner(auth()->user())) {
            abort(404);
        }

        return view('account.angebot.edit')
            ->with('angebot', $angebot);
    }

    /**
     * Updated das verlangte Angebot mitsamt den Topics sofern es zu dem angemeldeten User gehört.
     * @param  Request $request
     * @param  Angebot $angebot
     * @return Redirect account.angebote.index
     */
    public function update(Request $request, Angebot $angebot)
    {
        if (!$angebot->isOwner(auth()->user())) {
            abort(404);
        }

        $angebot->update($request->only(['title', 'info']));

        return redirect()->route('account.angebote.index')
            ->withSuccess('Angebot wurde erfolgreich bearbeitet');
    }

    /**
     * Löscht das verlangte Angebot sofern es zu dem angemeldeten User gehört.
     * @param  Angebot $angebot
     * @return Redirect account.angebote.index
     */
    public function destroy(Angebot $angebot)
    {
        if (!$angebot->isOwner(auth()->user())) {
            abort(404);
        }

        $angebot->delete();

        return redirect()->route('account.angebote.index')
            ->withSuccess('Angebot wurde erfolgreich gelöscht.');
    }
}
