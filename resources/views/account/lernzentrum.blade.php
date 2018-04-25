@extends('account.layouts.default')

@section('account.title', 'Lernzentrum Anmeldungen')

@section('account.content')
    <table class="table is-hoverable is-fullwidth is-responsive">
        <thead>
            <tr>
                <th>Datum</th>
                <th>Leitung</th>
                <th>Ort</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach (auth()->user()->lernzentrums as $lernzentrum)
                <tr>
                    <td>{{ $lernzentrum->date }}</td>
                    <td>{{ $lernzentrum->teacher->name }}</td>
                    <td>{{ $lernzentrum->room }}</td>
                    <td>
                        <a class="button is-primary" href="{{ route('lernzentrum.detail', [$lernzentrum->id]) }}">Details</a>
                        <form class="is-inline-block"  action="{{ route('lernzentrum.signout', [$lernzentrum->id]) }}" method="post">
                            {{ csrf_field() }}
                            <input class="button is-danger is-outlined" type="submit" value="Abmelden" />
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
