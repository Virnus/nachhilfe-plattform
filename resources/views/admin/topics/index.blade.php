@extends('admin.layouts.default')

@section('admin.title', 'Topics')

@section('admin.content')
    <data-table endpoint="{{ route('datatable.topics.index') }}"></data-table>
@endsection
