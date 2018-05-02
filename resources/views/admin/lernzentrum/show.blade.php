@extends('admin.layouts.blank')

@section('admin.content')
    <section class="hero is-info welcome is-small">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    Lernzentrum vom {{ $lernzentrum->date->format('d.m.Y') }}
                </h1>
                <p class="subtitle">
                    {{ $lernzentrum->info }}
                </p>
            </div>
        </div>
    </section>
    <section class="info-tiles m-t-m">
        <div class="tile is-ancestor has-text-centered">
            <div class="tile is-parent">
                <article class="tile is-child box">
                    <p class="title">{{ $lernzentrum->date->format('d.m.y') }}</p>
                    <p class="subtitle">Datum</p>
                </article>
            </div>
            <div class="tile is-parent">
                <article class="tile is-child box">
                    <p class="title">{{ $lernzentrum->date->format('h:i') }}</p>
                    <p class="subtitle">Uhrzeit</p>
                </article>
            </div>
            <div class="tile is-parent">
                <article class="tile is-child box">
                    <p class="title">{{ $lernzentrum->room }}</p>
                    <p class="subtitle">Ort</p>
                </article>
            </div>
            <div class="tile is-parent">
                <article class="tile is-child box">
                    <p class="title">{{ $lernzentrum->max_participants }}</p>
                    <p class="subtitle">Maximale Plätze</p>
                </article>
            </div>
        </div>
    </section>
    <div class="columns">
        <div class="column is-6">
            <div class="card events-card">
                <header class="card-header">
                    <p class="card-header-title">
                        Anmeldungen
                    </p>
                    <a href="#" class="card-header-icon" aria-label="more options">
                        <lernzentrum-status
                            max="{{ $lernzentrum->max_participants }}"
                            current="{{ $lernzentrum->anmeldungen->count() }}" />
                    </a>
                </header>
                <div class="card-table">
                    <div class="content">
                        <table class="table is-fullwidth is-striped">
                            <tbody>
                                @foreach ($lernzentrum->anmeldungen as $anmeldung)
                                <tr>
                                    <td>
                                        @include('layouts.partials._user-badge', ['user' => $anmeldung->user])
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <footer class="card-footer">
                    <a href="#" class="card-footer-item">View All</a>
                </footer>
            </div>
            <div class="card m-t-md">
                <header class="card-header">
                    <p class="card-header-title">
                        Themen
                    </p>
                    <a href="#" class="card-header-icon" aria-label="more options">
                        <span class="icon">
                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                        </span>
                    </a>
                </header>
                <div class="card-content">
                    <ul>
                        @foreach ($lernzentrum->anmeldungen as $anmeldung)

                            @foreach ($anmeldung->topics as $topic)
                                <li class="p-t-sm">
                                    {{ $topic->name }}
                                    <span class="tag is-info is-pulled-right">
                                        {{ $topic->subject->name }}
                                    </span>
                                </li>

                            @endforeach

                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="column is-6">
            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">
                        Leitung
                    </p>
                    <a href="#" class="card-header-icon" aria-label="more options">
                        <span class="icon">
                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                        </span>
                    </a>
                </header>
                <div class="card-content">
                    @include('layouts.partials._user-badge', ['user' => $lernzentrum->teacher])
                </div>
            </div>
            <div class="card m-t-md">
                <header class="card-header">
                    <p class="card-header-title">
                        Unterstützung
                    </p>
                    <a href="#" class="card-header-icon" aria-label="more options">
                        <span class="icon">
                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                        </span>
                    </a>
                </header>
                <div class="card-content">
                    @each('layouts.partials._user-badge', $lernzentrum->assistants, 'user')
                </div>
            </div>
        </div>
    </div>
@endsection
