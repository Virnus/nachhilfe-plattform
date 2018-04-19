@extends('account.layouts.default')

@section('account.title', 'Profil')

@section('account.content')
    <form class="" action="{{ route('account.profile.update') }}" method="post">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}

        <div class="field">
            <label class="label">Voller Name</label>
            <div class="control">
                <input class="input{{ $errors->has('name') ? ' is-danger' : '' }}" id="name" type="text" name="name" value="{{ old('name', auth()->user()->name) }}" autofocus>
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
                <input class="input{{ $errors->has('email') ? ' is-danger' : '' }}" id="email" type="email" name="email" value="{{ old('email', auth()->user()->email) }}">
            </div>
            @if ($errors->has('email'))
              <p class="help is-danger">
                  {{ $errors->first('email') }}
              </p>
            @endif
        </div>

        <div class="field">
          <div class="control">
            <button class="button is-primary">Speichern</button>
          </div>
        </div>
    </form>
@endsection
