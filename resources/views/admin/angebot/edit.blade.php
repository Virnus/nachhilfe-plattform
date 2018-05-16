@extends('admin.layouts.default')


@section('admin.content')
<form action="{{ route('admin.angebote.update', ['id' => $angebot->id]) }}" method="post">
    {{ csrf_field() }}
    {{ method_field('PATCH') }}

    <div class="field">
        <label class="label">Titel</label>
        <div class="control">
            <input class="input{{ $errors->has('title') ? ' is-danger' : '' }}" id="title" type="text" name="title" value="{{ old('title', $angebot->title) }}">
        </div>
        @if ($errors->has('title'))
          <p class="help is-danger">
              {{ $errors->first('title') }}
          </p>
        @endif
    </div>

    <div class="field">
        <label class="label">Info</label>
        <div class="control">
            <textarea class="textarea{{ $errors->has('info') ? ' is-danger' : '' }}" id="info" name="info">{{ old('info', $angebot->info) }}</textarea>
        </div>
        @if ($errors->has('info'))
          <p class="help is-danger">
              {{ $errors->first('info') }}
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
