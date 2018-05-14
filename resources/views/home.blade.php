@extends('layouts.app')

@section('section_title', 'Home')

@section('content')
<section class="hero is-medium is-primary is-bold">
    <div class="hero-body">
        <div class="container">
                <div class="columns">
                    <div class="column is-4">
                    </div>
                    <div class="column is-4">
                        <nachhilfe-suche endpoint="{{ url('/') }}" />
                    </div>
                    <div class="column is-4">
                    </div>
                </div>
        </div>
    </div>
</section>

<section class="container m-t-md">
    <div class="columns">
        <div class="column is-3">
            <angebote-filter base="{{ url('/') }}" />
        </div>
        <div class="column is-6">
            <div class="card is-shady">
                <header class="card-header">
                    <p class="card-header-title">
                        Resultate - {{ $angebote->count() }} Einträge
                    </p>
                </header>
                <div class="card-content">
                    @foreach ($angebote as $angebot)
                        <section class="accordions">
                            <article class="accordion is-active">
                                <div class="accordion-header toggle">
                                    <p>
                                        {{ $angebot->subject->name }}: {{ $angebot->title }}
                                    </p>
                                    <p>
                                        @include('layouts.partials._user-badge', ['user' => $angebot->user])
                                    </p>

                                </div>
                                <div class="accordion-body">
                                    <div class="accordion-content">
                                        <p>{{ $angebot->info }}</p>
                                        <br>
                                        <label class="label">Fach: {{ $angebot->subject->name }}</label>
                                        <br>
                                        <div class="is-flex">
                                            <label class="label">Themen:</label>
                                            @foreach ($angebot->topics as $topic)
                                                <label class="label"> &#8201;{{ $topic->name }},</label>
                                            @endforeach
                                        </div>
                                        <contact-modal
                                            action="{{ route('user.store', ['id' => $angebot->user->username]) }}"
                                            name="{{ $angebot->user->name }}" />
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    {{ $angebote->appends(Request::only(['subject', 'topic']))->links() }}
                </div>
            </div>
        </div>
        <div class="column is-3">
            <div class="card is-shady">
                <header class="card-header">
                    <p class="card-header-title">
                        Lernzentrum
                    </p>
                </header>
                <div class="card-content">
                        <div class="container is-flex">
                            <label style="margin-right: 10px" class="label">Datum:</label>
                            {{ $lernzentrum->date->format('l, d. F Y') }}
                        </div>
                        <div class="container is-flex">
                            <label style="margin-right: 10px" class="label">Leitung:</label>
                            {{ $lernzentrum->teacher->name }}
                        </div>
                        <div class="container is-flex">
                            <label style="margin-right: 10px" class="label">Freie Plätze:</label>
                            <lernzentrum-status
                                max="{{ $lernzentrum->max_participants }}"
                                current="{{ $lernzentrum->anmeldungen->count() }}"/>
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

<script type="text/javascript" src="/node_modules/bulma-extensions/bulma-accordion/dist/bulma-accordion.min.js"></script>

<style>
i {
border: solid black;
border-width: 0 3px 3px 0;
display: inline-block;
padding: 3px;
}

.up {
    transform: rotate(225deg);
    -webkit-transform: rotate(225deg);
}

.down {
    transform: rotate(45deg);
    -webkit-transform: rotate(45deg);
}
</style>
