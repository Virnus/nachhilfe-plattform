@extends('account.layouts.default')

@section('account.title', 'Neues Angebot')

@section('account.content')
    <angebot-create base="{{ url('/') }}" action="{{ route('account.angebote.store') }}" />
@endsection
