<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Lernzentrum;
use App\User;

class LernzentrumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.lernzentrum.index')
            ->with('lernzentrums', Lernzentrum::orderBy('date')->paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::isActive()->get();

        return view('admin.lernzentrum.create')
            ->with('users', $users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->_validate($request);

        $lernzentrum = Lernzentrum::create($request->only('date', 'info', 'room', 'teacher_id', 'max_participants'));
        $lernzentrum->assistants()->sync($request->assistants);

        return redirect()->route('admin.lernzentrum.show', ['id' => $lernzentrum->id])
            ->withSuccess('Lernzentrum wurde erfolgreich erstellt.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Lernzentrum $lernzentrum)
    {
        return view('admin.lernzentrum.show')
            ->with('lernzentrum', $lernzentrum);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Lernzentrum $lernzentrum)
    {
        $users = User::isActive()->get();

        return view('admin.lernzentrum.edit')
            ->with('lernzentrum', $lernzentrum)
            ->with('users', $users);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lernzentrum $lernzentrum)
    {
        $this->_validate($request);

        $lernzentrum->update($request->only('date', 'info', 'room', 'teacher_id', 'max_participants'));
        $lernzentrum->assistants()->sync($request->assistants);

        return redirect()->route('admin.lernzentrum.index')
            ->withSuccess('Lernzentrum wurde erfolgreich bearbeitet.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lernzentrum $lernzentrum)
    {
        $lernzentrum->assistants()->detach();
        $lernzentrum->delete();

        return redirect()->route('admin.lernzentrum.index')
            ->withSuccess('Lernzentrum wurde erfolgreich gelöscht.');
    }

    private function _validate(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'info' => 'required',
            'room' => 'required',
            'teacher_id' => 'required|numeric',
            'max_participants' => 'required|numeric',
            'assistants[]' => 'array',
        ]);
    }
}
