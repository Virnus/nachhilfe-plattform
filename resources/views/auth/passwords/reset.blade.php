@extends('auth._auth')

@section('auth')
  <div class="card">

    <div class="card-content">
      @if (session('status'))
          <div class="notification is-info">
              {{ session('status') }}
          </div>
      @endif

      <form class="login-form" method="POST" action="{{ route('password.request') }}">
          {{ csrf_field() }}

          <input type="hidden" name="token" value="{{ $token }}">

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
                  <input class="input{{ $errors->has('email') ? ' is-danger' : '' }}" id="password" type="password" name="password" required>
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
              <button class="button is-primary is-fullwidth">Submit</button>
            </div>
          </div>
      </form>
    </div>
  </div>
@endsection
