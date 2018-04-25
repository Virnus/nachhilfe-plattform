@extends('account.layouts.default')

@section('account.title', 'Lernzentrum Aufgebote')

@section('account.content')
    <table class="table is-hoverable is-fullwidth is-responsive">
        <thead>
            <tr>
                <th>Datum</th>
                <th>Leitung</th>
                <th>Ort</th>
                <th>Anmeldungen</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach (auth()->user()->assistants as $lernzentrum)
                <tr>
                    <td>{{ $lernzentrum->date }}</td>
                    <td>{{ $lernzentrum->teacher->name }}</td>
                    <td>{{ $lernzentrum->room }}</td>
                    <td>{{ $lernzentrum->users()->count() }} / {{ $lernzentrum->max_participants }}</td>
                    <td>
                        <a class="button is-primary" href="{{ route('lernzentrum.detail', [$lernzentrum->id]) }}">Details</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
