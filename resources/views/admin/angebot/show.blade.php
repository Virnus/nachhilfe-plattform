@extends('admin.layouts.blank')


@section('admin.content')
<section class="accordions">
    <article class="accordion is-active">
        <div class="accordion-header toggle">
            <p>
                {{ $angebot->title }}
            </p>
            <p>
                @include('layouts.partials._user-badge', ['user' => $angebot->user])
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
            </div>
        </article>
    </article>
</section>
@endsection
