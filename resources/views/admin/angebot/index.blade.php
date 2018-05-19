@extends('admin.layouts.default')

@section('admin.title')
    Angebot
@endsection

@section('admin.content')
<table class="table is-hoverable is-fullwidth is-responsive">
    <thead>
        <tr>
            <th>Titel</th>
            <th>Anbieter</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($angebots as $angebot)
            <tr>
                <td>
                    {{ $angebot-> title }}
                </td>
                <td>@include('layouts.partials._user-badge', ['user' => $angebot->user])</td>
                <td>
                    <a class="button is-primary is-small" href="{{ route('admin.angebote.show', [$angebot->id]) }}">Details</a>
                    <a class="button is-info is-small" href="{{ route('admin.angebote.edit', [$angebot->id]) }}">Bearbeiten</a>
                    <form class="is-inline-block" action="{{ route('admin.angebote.destroy', [$angebot->id]) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('Delete') }}
                        <button class="button is-danger is-small" onclick="return confirm('Datensatz wirklich löschen?')">Löschen</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $angebots->links() }}
@endsection
