@extends('admin.layouts.default')

@section('content')
  <div style="margin-top: 20px;" class="container">
      <div class="card is-5">
        <data-table endpoint="{{ route('users.index') }}"></data-table>
      </div>
  </div>
@endsection
