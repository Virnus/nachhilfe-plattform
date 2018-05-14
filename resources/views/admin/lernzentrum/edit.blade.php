@extends('admin.layouts.default')

@section('admin.title', "Lernzentrum vom {$lernzentrum->date->format('d.m.Y')} bearbeiten")

@section('admin.content')
    <form action="{{ route('admin.lernzentrum.update', ['id' => $lernzentrum->id]) }}" method="post">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}

        <div class="field">
            <label class="label">Datum</label>
            <div class="control">
                <input class="input{{ $errors->has('date') ? ' is-danger' : '' }}" id="date" type="text" name="date" value="{{ old('date', $lernzentrum->date) }}" data-calendar="calendar" autofocus>
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
                <textarea class="textarea{{ $errors->has('info') ? ' is-danger' : '' }}" id="info" name="info">{{ old('info', $lernzentrum->info) }}</textarea>
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
                <input class="input{{ $errors->has('room') ? ' is-danger' : '' }}" id="room" type="text" name="room" value="{{ old('room', $lernzentrum->room) }}">
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
                      <option>-- Leitung wählen --</option>
                      @foreach ($users as $teacher)
                          @if ($teacher->isNotSchueler())
                              <option value="{{ $teacher->id }}" {{ ($lernzentrum->teacher_id === $teacher->id) ? 'selected' : '' }}>{{ $teacher->name }}</option>
                          @endif
                      @endforeach
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
                <input class="input{{ $errors->has('max_participants') ? ' is-danger' : '' }}" id="max_participants" type="number" name="max_participants" value="{{ old('max_participants', $lernzentrum->max_participants) }}">
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
            @foreach ($users as $assistant)
                @if ($assistant->verified)
            <option{{ ($lernzentrum->assistants->contains($assistant)) ? ' selected' : '' }} value="{{ $assistant->id }}">{{ $assistant->name }}</option>
@endif
            @endforeach
                    </select>
                </div>
            </div>
            @if ($errors->has('assistants[]'))
              <p class="help is-danger">
                  {{ $errors->first('assistants[]') }}
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
