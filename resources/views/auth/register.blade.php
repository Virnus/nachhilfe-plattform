@extends('auth._auth')

@section('auth')
  <div class="card">

    <div class="card-content">
      <div class="tabs is-toggle is-fullwidth">
        <ul>
          <li>
            <a href="/login">
              <span>Login</span>
            </a>
          </li>
          <li class="is-active">
            <a>
              <span>Registrieren</span>
            </a>
          </li>
        </ul>
      </div>
      <form class="login-form" method="POST" action="{{ route('register') }}">
          {{ csrf_field() }}

          <div class="field">
              <label class="label">Voller Name</label>
              <div class="control">
                  <input class="input{{ $errors->has('name') ? ' is-danger' : '' }}" id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
              </div>
              @if ($errors->has('name'))
                <p class="help is-danger">
                    {{ $errors->first('name') }}
                </p>
              @endif
          </div>

          <div class="field">
              <label class="label">E-Mail Address</label>
              <div class="control">
                  <input class="input{{ $errors->has('email') ? ' is-danger' : '' }}" id="email" type="email" name="email" value="{{ old('email') }}">
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
                  <input class="input{{ $errors->has('password') ? ' is-danger' : '' }}" id="password" type="password" name="password" required>
              </div>
              @if ($errors->has('password'))
                  <p class="help is-danger">
                      {{ $errors->first('password') }}
                  </p>
              @endif
          </div>

          <div class="field">
              <label class="label">Password wiederholen</label>
              <div class="control">
                  <input class="input" id="password-confirm" type="password" name="password_confirmation" required>
              </div>
          </div>

          <div class="field">
            <div class="control">
              <button class="button is-primary is-fullwidth">Registrieren</button>
            </div>
          </div>
      </form>
    </div>
  </div>
@endsection
