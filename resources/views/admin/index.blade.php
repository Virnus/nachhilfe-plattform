@extends('admin.layouts.default')

@section('admin.title', 'Dashboard')

@section('admin.content')
    <data-table endpoint="{{ route('users.index') }}"></data-table>
@endsection
