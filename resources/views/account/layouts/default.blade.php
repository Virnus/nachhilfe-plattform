@extends('layouts.app')

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
                        <li><a>Angebote</a></li>
                        <li><a>Neues Angebot</a></li>
                    </ul>
                    <p class="menu-label">
                        lernzentrum
                    </p>
                    <ul class="menu-list">
                        <li><a>Anmeldungen</a></li>
                        <li><a>Aufgebote</a></li>
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
