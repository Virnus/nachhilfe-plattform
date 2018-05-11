@extends('admin.layouts.default')

@section('admin.title')
    Lernzentrum
    <div class="card-header-icon">
        <a href="{{ route('admin.lernzentrum.create') }}" class="button is-info is-small">
            Neuer Eintrag
        </a>
    </div>
@endsection

@section('admin.content')
    <table class="table is-hoverable is-fullwidth is-responsive">
        <thead>
            <tr>
                <th>Status</th>
                <th>Datum</th>
                <th>Leitung</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lernzentrums as $lernzentrum)
                <tr>
                    <td>
                        <lernzentrum-status
                            max="{{ $lernzentrum->max_participants }}"
                            current="{{ $lernzentrum->anmeldungen->count() }}"/>
                    </td>
                    <td>{{ $lernzentrum->date->format('d.m.Y') }}</td>
                    <td>{{ $lernzentrum->teacher->name }}</td>
                    <td>
                        <a class="button is-primary is-small" href="{{ route('admin.lernzentrum.show', [$lernzentrum->id]) }}">Details</a>
                        <a class="button is-info is-small" href="{{ route('admin.lernzentrum.edit', [$lernzentrum->id]) }}">Bearbeiten</a>
                        <form class="is-inline-block" action="{{ route('admin.lernzentrum.destroy', [$lernzentrum->id]) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('Delete') }}
                            <button class="button is-danger is-small" >Löschen</button>

                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
