@extends('layouts.app')

@section('section_title', 'Account')

@section('content')
    <div class="container">
        <div class="columns is- is-marginless">
            <div class="column is-3">
                <aside class="menu">
                    <p class="menu-label">
                        Account
                    </p>
                    <ul class="menu-list">
                        <li><a href="{{ route('account') }}" class="{{ on_page('account') ? 'is-active' : '' }}">Dashboard</a></li>
                        <li><a href="{{ route('account.profile') }}" class="{{ on_page('*/profile') ? 'is-active' : '' }}">Profil</a></li>
                        <li><a href="{{ route('account.password') }}" class="{{ on_page('*/password') ? 'is-active' : '' }}">Passwort ändern</a></li>
                    </ul>
                    <p class="menu-label">
                        Nachhilfe
                    </p>
                    <ul class="menu-list">
                        <li><a href="{{ route('account.angebot.index') }}">Angebote</a></li>
                        <li><a href="{{ route('account.angebot.create') }}">Neues Angebot</a></li>
                    </ul>
                    <p class="menu-label">
                        lernzentrum
                    </p>
                    <ul class="menu-list">
                        <li><a href="{{ route('account.lernzentrum') }}" class="{{ on_page('*/lernzentrum') ? 'is-active' : '' }}">Anmeldungen</a></li>
                        @if (auth()->user()->verified)
                            <li><a href="{{ route('account.lernzentrum.support') }}" class="{{ on_page('*/lernzentrum/support') ? 'is-active' : '' }}">Aufgebote</a></li>
                        @endif
                    </ul>
                </aside>
            </div>
            <div class="column is-9">
                @include('layouts.partials._alert')

                <nav class="card">
                    <header class="card-header">
                        <p class="card-header-title">
                            @yield('account.title')
                        </p>
                    </header>

                    <div class="card-content">
                        @yield('account.content')
                    </div>
                </nav>
            </div>
        </div>
    </div>
@endsection
