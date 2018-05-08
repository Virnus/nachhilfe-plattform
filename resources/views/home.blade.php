@extends('layouts.app')

@section('section_title', 'Home')

@section('content')
    <div class="container">
        <div class="columns is- is-marginless is-centered">
            <div class="column is-7">
                @include('layouts.partials._alert')

                <nav class="card">
                    <header class="card-header">
                        <p class="card-header-title">
                            Dashboard
                        </p>
                    </header>

                    <div class="card-content">
                        You are logged in!
                    </div>
                </nav>
            </div>
        </div>
    </div>
@endsection
