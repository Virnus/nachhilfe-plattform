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
            <div class="card is-shady">
                <header class="card-header">
                    <p class="card-header-title">
                        Filter
                    </p>
                </header>
                <div class="card-content">
                    <div class="field">
                        <div class="control">
                            <div class="select is-fullwidth">
                                <select>
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <div class="select is-fullwidth">
                                <select>
                                    @foreach ($topics as $topic)
                                        <option value="{{ $topic->id }}" {{ ($topic->subject_id === $subject->id) ? 'selected' : '' }}>{{ $topic->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="control">
                        <button class="button is-primary" value="filtern">Filtern</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="column is-6">
            <div class="card is-shady">
                <header class="card-header">
                    <p class="card-header-title">
                        Resultate - {{ $angebots->count() }} Einträge
                    </p>
                </header>
                <div class="card-content">
                    @foreach ($angebots as $angebot)
                        <article class="media">
                            <div class="media-content">
                                <div class="content">
                                    @foreach ($angebot->topics as $topic)
                                    <h4>
                                        {{ $angebot->subject->name }}: {{ $topic->name }}
                                    </h4>
                                    @endforeach
                                    <p>
                                    @include('layouts.partials._user-badge', ['user' => $angebot->provider])
                                    </p>
                                </div>

                                <article class="media">
                                    <div class="media-content">
                                        <p>
                                            {{ $angebot->info }}
                                        </p>
                                            <contact-modal
                                                action="{{ route('user.store', ['id' => $angebot->provider->username]) }}"
                                                name="{{ $angebot->provider->name }}" />
                                    </div>
                                </article>
                            </div>
                            <div class="media-right">
                                <span class="icon is-small"><i class="arrow down"></i></span>
                            </div>
                        </article>
                    @endforeach
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
                            {{ $lernzentrum->max_participants - $lernzentrum->anmeldungen->count() }}
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

.down {
    transform: rotate(45deg);
    -webkit-transform: rotate(45deg);
}
</style>
