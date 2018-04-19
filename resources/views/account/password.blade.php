@extends('account.layouts.default')

@section('account.title', 'Passwort ändern')

@section('account.content')
    <form class="" action="{{ route('account.password.update') }}" method="post">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}

        <div class="field">
            <label class="label">Aktuelles Password</label>
            <div class="control">
                <input class="input{{ $errors->has('password_current') ? ' is-danger' : '' }}" id="password_current" type="password" name="password_current" required>
            </div>
            @if ($errors->has('password_current'))
                <p class="help is-danger">
                    {{ $errors->first('password_current') }}
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
            <button class="button is-primary">Speichern</button>
          </div>
        </div>
    </form>
@endsection
