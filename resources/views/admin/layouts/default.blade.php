@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="columns is- is-marginless">
            <div class="column is-3">
                <aside class="menu">
                    <p class="menu-label">
                        General
                    </p>
                    <ul class="menu-list">
                        <!-- <li><a href="{{ route('account') }}" class="{{ on_page('account') ? 'is-active' : '' }}">Dashboard</a></li> -->
                    </ul>
                    <p class="menu-label">
                        Benutzerverwaltung
                    </p>
                    <ul class="menu-list">
                        <li><a>Schüler</a></li>
                        <li><a>Lehrer</a></li>
                        <li><a>Neuer Benutzer</a></li>
                    </ul>
                    <p class="menu-label">
                        Angeboteverwaltung
                    </p>
                    <ul class="menu-list">
                        <li><a>Angebote</a></li>
                        <li><a>Neues Angebot</a></li>
                    </ul>
                    <p class="menu-label">
                        Lernzentrumverwaltung
                    </p>
                    <ul class="menu-list">
                        <li><a>Lernzentrum</a></li>
                    </ul>
                </aside>
            </div>
            <div class="column is-9">
                @include('layouts.partials._alert')

                <nav class="card">
                    <header class="card-header">
                        <p class="card-header-title">
                            @yield('admin.title')
                        </p>
                    </header>

                    <div class="card-content">
                        @yield('admin.content')
                    </div>
                </nav>
            </div>
        </div>
    </div>
@endsection
