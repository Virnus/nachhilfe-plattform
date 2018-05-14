<div class="card is-shady">
    <header class="card-header">
        <p class="card-header-title">
            Kalender
        </p>
    </header>
    <div class="card-content">
        <ul>
        @foreach ($lernzentrums as $lernzentrum)
            <li>
                <a href="{{ route('lernzentrum.detail', ['id' => $lernzentrum->id]) }}" class="is-size-5">{{ $lernzentrum->date->formatLocalized('%A, %d. %B %Y') }}</a>
            </li>
        @endforeach
        </ul>
    </div>
</div>
