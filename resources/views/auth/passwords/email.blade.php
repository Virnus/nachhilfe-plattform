@extends('auth._auth')

@section('auth')
  @if (session('status'))
      <div class="notification is-info">
          {{ session('status') }}
      </div>
  @endif
  <div class="card">

    <header class="card-header">
      <p class="card-header-title">
      Passwort zurücksetzten
    </p>
    </header>

    <div class="card-content">


      <form class="login-form" method="POST" action="{{ route('password.email') }}">
          {{ csrf_field() }}

          <div class="field">
              <label class="label">E-Mail Address</label>
              <div class="control">
                  <input class="input{{ $errors->has('email') ? ' is-danger' : '' }}" id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
              </div>
              @if ($errors->has('email'))
                <p class="help is-danger">
                    {{ $errors->first('email') }}
                </p>
              @endif
          </div>

          <div class="field">
            <div class="control">
              <button class="button is-primary is-fullwidth">Link senden</button>
            </div>
          </div>
      </form>
    </div>
  </div>
@endsection
