<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Angebot;

class AngebotController extends Controller
{
    public function index() {
        return view('admin.angebot.index')
            ->with('angebots', Angebot::all());
    }

    public function show(Angebot $angebot)
    {
        return view('admin.angebot.show')
            ->with('angebot', $angebot);
    }

    public function edit(Angebot $angebot)
    {
        return view('admin.angebot.edit')
            ->with('angebot', $angebot);
    }

    public function update(Request $request, Angebot $angebot)
    {

        $angebot->update($request->only('title', 'info'));

        return redirect()->route('admin.angebot.index')
            ->withSuccess('Angebot wurde erfolgreich bearbeitet.');
    }

    public function destroy(Angebot $angebot)
    {
        $angebot->delete();

        return redirect()->route('admin.angebot.index')
            ->withSuccess('Angebot wurde erfolgreich gelöscht.');
    }

}
