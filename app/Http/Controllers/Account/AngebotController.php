<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Angebot;
use App\Subject;
use App\Topic;

class AngebotController extends Controller
{
    public function index(Request $request)
    {
        return view('account.angebot.index')
            ->with('angebots', $request->user()->angebots);
    }

    public function create()
    {
        return view('account.angebot.create');
    }

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

    public function edit(Angebot $angebot)
    {
        if (!$angebot->isOwner(auth()->user())) {
            abort(404);
        }

        return view('account.angebot.edit')
            ->with('angebot', $angebot);
    }

    public function update(Request $request, Angebot $angebot)
    {
        if (!$angebot->isOwner(auth()->user())) {
            abort(404);
        }

        $angebot->update($request->only(['title', 'info']));

        return redirect()->route('account.angebote.index')
            ->withSuccess('Angebot wurde erfolgreich bearbeitet');
    }

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
