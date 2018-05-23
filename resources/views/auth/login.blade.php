@extends('auth._auth')

@section('section_title', 'Login')

@section('auth')
  <div class="card">

    <div class="card-content">
      <div class="tabs is-toggle is-fullwidth">
        <ul>
          <li class="is-active">
            <a>
              <span>Login</span>
            </a>
          </li>
          <li>
            <a href="/register">
              <span>Registrieren</span>
            </a>
          </li>
        </ul>
      </div>
      <form class="login-form" method="POST" action="{{ route('login') }}">
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
              <label class="label">Password</label>
              <div class="control">
                  <input class="input" id="password" type="password" name="password" required>
              </div>
              @if ($errors->has('password'))
                  <p class="help is-danger">
                      {{ $errors->first('password') }}
                  </p>
              @endif
          </div>

          <div class="field">
            <div class="control">
                <label class="checkbox">
                    <input type="checkbox"
                           name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                </label>
            </div>
          </div>

          <div class="field">
            <div class="control">
              <button class="button is-primary is-fullwidth">Einloggen</button>
            </div>
          </div>
      </form>
    </div>
  </div>
  <a class="is-block has-text-centered" href="{{ route('password.request') }}">
      Passwort vergessen?
  </a>
@endsection
