@extends('layouts.app')

@section('content')
    <section class="hero is-primary is-bold">
        <div class="hero-body">
            <div class="container">
                <div class="user-header">
                    <figure class="image is-180x180">
                      <img src="https://bulma.io/images/placeholders/128x128.png">
                    </figure>
                    <div class="user-header__content">
                        <h1 class="title is-size-1 has-text-weight-light">{{ $user->name }}</h1>
                        <div class="user-header__infos">
                            <p class="is-size-4">
                                <span class="ausbildung has-text-light">{{ $user->ausbildung }}</span>
                                @if ($user->verified)
                                    &#8226;
                                    <span class="tag is-info is-medium">
                                        <svg class="user-header__icon"><use xlink:href="#icon-check"></use></svg>
                                        verifiziert
                                    </span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="columns is-marginless">
            <div class="column is-3">
                <angebote-filter
                    base="{{ url('/') }}"
                    action="{{ route('user.detail', ['id' => $user->username]) }}"
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
                <contact-modal
                    action="{{ route('user.store', ['id' => $user->username]) }}"
                    name="{{ $user->name }}" />
            </div>
        </div>
    </div>
{{ $angebote->links() }}
@endsection
