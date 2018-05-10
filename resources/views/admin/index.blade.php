@extends('admin.layouts.blank')

@section('admin.title', 'Dashboard')

@section('admin.content')
    <data-table endpoint="{{ route('users.index') }}" title="Benutzer" />
@endsection
