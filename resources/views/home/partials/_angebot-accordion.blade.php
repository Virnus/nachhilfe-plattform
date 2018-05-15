<div class="angebot-accordion">
    <header class="angebot-accordion__header">
        <p class="is-size-5">
            {{ $angebot->subject->name }}: {{ $angebot->title }}
        </p>
        <div class="angebot-accordion__header__user is-flex">
            @include('layouts.partials._user-badge', ['user' => $angebot->user])
            <span>{{ $angebot->created_at->diffForHumans() }}</span>
        </div>
    </header>
    <div class="angebot-accordion__body">
        <div class="angebot-accordion__body__wrapper">
            <p>
                {{ $angebot->info }}
            </p>
            <p>
                <span class="has-text-weight-bold">Fach:</span> {{ $angebot->subject->name }}
            </p>
            <p>
                <span class="has-text-weight-bold">Themen:</span> @foreach ($angebot->topics as $topic) {{ $topic->name }}, @endforeach
            </p>
            <p>
                <contact-modal action="{{ route('user.store', ['id' => $angebot->user->username]) }}" name="{{ $angebot->user->name }}" />

            </p>
        </div>
    </div>
</div>
