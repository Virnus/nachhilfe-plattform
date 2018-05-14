@extends('account.layouts.default')

@section('account.title', 'Angebot')

@section('account.content')
    <angebot-create base="{{ url('/') }}" />
@endsection
