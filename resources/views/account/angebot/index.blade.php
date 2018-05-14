@extends('account.layouts.default')

@section('account.title', 'Angebot')

@section('account.content')
        @foreach ($angebots as $angebot)
            <article class="media">
                <div class="media-content">
                    <div class="content">
                        <h4>
                            {{ $angebot->subject->name }}: {{ $angebot->title }}
                        </h4>
                    </div>
                    <article class="media">
                        <div class="media-content">
                            <p>
                                {{ $angebot->info }}
                            </p>
                            <br>
                            <label class="label">
                                Fach: {{ $angebot->subject->name }}
                            </label>
                            <div class="is-flex">
                                <label class="label">
                                    Themen:
                                </label>
                                @foreach ($angebot->topics as $topic)
                                    <label class="label">
                                        &#8194;{{ $topic->name }},
                                    </label>
                                @endforeach
                            </div>
                            <div class="is-flex">
                                <a class="button is-info is-small" href="{{ route('account.angebot.edit', [$angebot->id]) }}">Bearbeiten</a>
                                <form class="is-inline-block" action="{{ route('account.angebot.destroy', [$angebot->id]) }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('Delete') }}
                                    <button class="button is-danger is-small" >Löschen</button>

                                </form>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="media-right">
                    <span class="icon is-small"><i class="arrow down"></i></span>
                </div>
            </article>
        @endforeach
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
