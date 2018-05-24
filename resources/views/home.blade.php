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
    @include('layouts.partials._alert')
    <div class="columns">
        <div class="column is-3">
            <angebote-filter base="{{ url('/') }}"
                action="{{ route('home') }}"
                subject="{{ Request::get('subject') }}"
                topic="{{ Request::get('topic') }}" />
        </div>
        <div class="column is-6">
            <div class="card is-shady">
                <header class="card-header">
                    <p class="card-header-title">
                        Resultate<span class="has-text-weight-normal">&nbsp;- {{ $angebote->count() }} von {{ $angebote->total() }} Einträgen</span>
                    </p>
                </header>
                <div class="card-content is-paddingless">
                    @each('layouts.partials._angebot-accordion', $angebote, 'angebot')
                </div>
            </div>
            <div class="m-t-md">
                {{ $angebote->appends(Request::only(['subject', 'topic']))->links() }}
            </div>
        </div>
        <div class="column is-3">
            <div class="card is-shady">
                <header class="card-header">
                    <p class="card-header-title">
                        Lernzentrum
                        <div class="card-header-icon">
                            <lernzentrum-status
                                max="{{ $lernzentrum->max_participants }}"
                                current="{{ $lernzentrum->anmeldungen->count() }}"/>
                        </div>
                    </p>
                </header>
                <div class="card-content">
                        <div class="field">
                            <p>
                                <span class="has-text-weight-bold">Datum:</span> {{ $lernzentrum->date->formatLocalized('%A, %d. %B %Y') }}
                            </p>
                            <p>
                                <span class="has-text-weight-bold">Leitung:</span> {{ $lernzentrum->teacher->name }}
                            </p>
                        </div>
                        <div class="field">
                            <a class="button is-primary is-outlined is-fullwidth" href="{{ route('lernzentrum.detail', ['id' => $lernzentrum->id]) }}">Details</a>
                        </div>
                        <div class="field">
                            <lernzentrum-anmeldung
                                angemeldet="{{ $lernzentrum->isSignUp(auth()->user()) }}"
                                action="{{ route('lernzentrum.detail', [$lernzentrum->id]) }}"
                                base="{{ url('/') }}" />
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

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
