@extends('layouts.app')

@section('content')
    <section class="hero is-medium is-primary is-bold">
        <div class="hero-body">
            <div class="container">
                <h1 class="title has-text-centered">
                    Lernzentrum
                </h1>
            </div>
        </div>
    </section>
    <section class="container m-t-md">
        <div class="columns">
            <div class="column is-9">
                <div class="card is-shady">
                    <header class="card-header">
                        <p class="card-header-title">
                            Lernzentrum am {{ $lernzentrum->date->format('l, d. F Y') }}
                        </p>
                    </header>
                    <div class="card-content">
                        <div class="columns">
                            <div class="column is-8 border-right-1">
                                <div class="content">
                                    <h4>Infos:</h4>
                                    <p>
                                        {{ $lernzentrum->info }}
                                    </p>
                                    <h4>Datum:</h4>
                                    <p>
                                        {{ $lernzentrum->date->format('d.m.Y h:m') }} Uhr
                                    </p>
                                    <h4>Ort:</h4>
                                    <p>
                                        {{ $lernzentrum->room }}
                                    </p>
                                    <h4>Freie Plätze:</h4>
                                    <progress class="progress is-primary" value="12" max="{{ $lernzentrum->max_participants }}">12</progress>
                                </div>
                            </div>
                            <div class="column is-4">
                                <div class="content">
                                    <h4>Leitung:</h4>
                                    @include('layouts.partials._user-badge', ['user' => $lernzentrum->teacher])
                                    <h4>Unterstütung:</h4>
                                    {{-- @include('layouts.partials._user-badge')
                                    @include('layouts.partials._user-badge')
                                    @include('layouts.partials._user-badge') --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column is-3">
                <div class="card is-shady">
                    <header class="card-header">
                        <p class="card-header-title">
                            Kalender
                        </p>
                    </header>
                    <div class="card-content">
                        <ul>
                        @foreach ($allLernzentrums as $date)
                            <li>
                                <a href="{{ route('lernzentrum.detail', ['id' => $date->id]) }}" class="is-size-5">{{ $date->date->formatLocalized('%A %d %B %Y') }}</a>
                            </li>
                        @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
