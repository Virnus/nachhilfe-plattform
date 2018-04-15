@extends('layouts.blank')

@section('content')

    <section class="hero is-fullheight">
        <div class="hero-body">
          <div class="container">
            <div class="columns is-marginless is-centered">
              <div class="column is-5">
                <h1 class="title has-text-centered">
                    Nachhilfe
                </h1>
                <h2 class="subtitle has-text-centered">
                  Plattform
                </h2>

                @include('layouts.partials._alert')

                @yield('auth')

              </div>
            </div>
          </div>
        </div>
    </section>
@endsection
