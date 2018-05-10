@extends('admin.layouts.blank')

@section('admin.content')
    <data-table endpoint="{{ route('datatable.topics.index') }}" title="Topics"></data-table>
@endsection
