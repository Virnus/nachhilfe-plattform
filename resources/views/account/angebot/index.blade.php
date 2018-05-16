@extends('account.layouts.default')

@section('account.title', 'Angebote')

@section('account.content')
    <table class="table is-hoverable is-fullwidth is-responsive">
        <thead>
            <tr>
                <th>Titel</th>
                <th>Fach</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($angebots as $angebot)
                <tr>
                    <td>{{ $angebot->title }}</td>
                    <td>{{ $angebot->subject->name }}</td>
                    <td>
                        <a class="button is-primary" href="{{ route('account.angebote.edit', [$angebot->id]) }}">Bearbeiten</a>
                        <form class="is-inline-block"  action="{{ route('account.angebote.destroy', [$angebot->id]) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('Delete') }}
                            <input class="button is-danger is-outlined" onclick="return confirm('Datensatz wirklich löschen?')" type="submit" value="Löschen" />
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
