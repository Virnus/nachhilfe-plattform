@extends('account.layouts.default')

@section('account.title', 'Angebot')

@section('account.content')
        @foreach ($angebots as $angebot)
            <section class="accordions">
                <article class="accordion is-active">
                    <div class="accordion-header toggle">
                        <p>
                            {{ $angebot->subject->name }}: {{ $angebot->title }}
                        </p>
                    </div>
                    <article class="accordion-body">
                        <div class="accordion-content">
                            <p>
                                {{ $angebot->info }}
                            </p>
                            <br>
                            <label class="label">
                                Fach: {{ $angebot->subject->name }}
                            </label>
                            <br>
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
                </article>
            </section>
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
