@extends('admin.layouts.blank')

@section('admin.title', 'Topics')

@section('admin.content')
    <data-table endpoint="{{ route('datatable.subjects.index') }}" title="Fächer"></data-table>
@endsection
