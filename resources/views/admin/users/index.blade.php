@extends('admin.layouts.blank')

@section('admin.content')
    <data-table endpoint="{{ route('datatable.users.index') }}" title="Benutzer" />
@endsection
