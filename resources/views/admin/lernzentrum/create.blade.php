@extends('admin.layouts.default')

@section('admin.title', 'Lernzentrum erstellen')

@section('admin.content')
    <form action="{{ route('admin.lernzentrum.store') }}" method="post">
        {{ csrf_field() }}

        <div class="field">
            <label class="label">Datum</label>
            <div class="control">
                <input class="input{{ $errors->has('date') ? ' is-danger' : '' }}" id="date" type="text" name="date" value="{{ old('date') }}" autofocus>
            </div>
            @if ($errors->has('date'))
              <p class="help is-danger">
                  {{ $errors->first('date') }}
              </p>
            @endif
        </div>

        <div class="field">
            <label class="label">Info</label>
            <div class="control">
                <textarea class="textarea{{ $errors->has('info') ? ' is-danger' : '' }}" id="info" name="info">{{ old('info') }}</textarea>
            </div>
            @if ($errors->has('info'))
              <p class="help is-danger">
                  {{ $errors->first('info') }}
              </p>
            @endif
        </div>

        <div class="field">
            <label class="label">Ort</label>
            <div class="control">
                <input class="input{{ $errors->has('room') ? ' is-danger' : '' }}" id="room" type="text" name="room" value="{{ old('room') }}">
            </div>
            @if ($errors->has('room'))
              <p class="help is-danger">
                  {{ $errors->first('room') }}
              </p>
            @endif
        </div>

        <div class="field">
            <label class="label">Leitung</label>
            <div class="control">
                <div class="select">
                  <select name="teacher_id" id="teacher_id">
                    <option>Leitung wählen</option>
        @foreach ($teachers as $teacher)
            <option value="{{ $teacher->id }}" {{ (old('teacher_id') === $teacher->id) ? 'selected' : '' }}>{{ $teacher->name }}</option>
        @endforeach
                    <option>With options</option>
                  </select>
                </div>
            </div>
            @if ($errors->has('teacher_id'))
              <p class="help is-danger">
                  {{ $errors->first('teacher_id') }}
              </p>
            @endif
        </div>

        <div class="field">
            <label class="label">Maximale Platzanzahl</label>
            <div class="control">
                <input class="input{{ $errors->has('max_participants') ? ' is-danger' : '' }}" id="max_participants" type="number" name="max_participants" value="{{ old('max_participants') }}">
            </div>
            @if ($errors->has('max_participants'))
              <p class="help is-danger">
                  {{ $errors->first('max_participants') }}
              </p>
            @endif
        </div>

        <div class="field">
            <label class="label">Unterstützung</label>
            <div class="control">
                <div class="select is-multiple">
                    <select multiple size="4" name="assistants[]" id="assistants[]">
            @foreach ($teachers as $teacher)
            <option{{ (old('assistants[]') && old('assistants[]')->contains($teacher)) ? ' selected' : '' }} value="{{ $teacher->id }}">{{ $teacher->name }}</option>
            @endforeach
                    </select>
                </div>
            </div>
            @if ($errors->has('assistants'))
              <p class="help is-danger">
                  {{ $errors->first('assistants') }}
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
