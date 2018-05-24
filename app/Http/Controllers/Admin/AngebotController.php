<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Angebot;

class AngebotController extends Controller
{
    /**
     * Gibt gibt den View zurück mit der Angebot Admin Liste
     * @return View admin.angebot.index
     */
    public function index() {
        return view('admin.angebot.index')
            ->with('angebots', Angebot::paginate(10));
    }

    /**
     * Gibt gibt den View zurück mit dem verlangten Angebot
     * @return View admin.angebot.show
     */
    public function show(Angebot $angebot)
    {
        return view('admin.angebot.show')
            ->with('angebot', $angebot);
    }

    /**
     * Gibt gibt den View zurück mit dem Formular um das verlangte Angebot zu bearbeiten
     * @return View admin.angebot.show
     */
    public function edit(Angebot $angebot)
    {
        return view('admin.angebot.edit')
            ->with('angebot', $angebot);
    }

    /**
     * Updated das verlangte Angebot
     * @param  Request $request
     * @param  Angebot $angebot
     * @return Redirect admin.angebot.index
     */
    public function update(Request $request, Angebot $angebot)
    {

        $angebot->update($request->only('title', 'info'));

        return redirect()->route('admin.angebot.index')
            ->withSuccess('Angebot wurde erfolgreich bearbeitet.');
    }

    /**
     * Löscht das verlangte Angebot
     * @param  Angebot $angebot
     * @return Redirect admin.angebot.index
     */
    public function destroy(Angebot $angebot)
    {
        $angebot->delete();

        return redirect()->route('admin.angebot.index')
            ->withSuccess('Angebot wurde erfolgreich gelöscht.');
    }

}
