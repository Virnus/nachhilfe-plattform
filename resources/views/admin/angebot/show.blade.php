@extends('admin.layouts.blank')


@section('admin.content')
<div class="card-content is-paddingless">
    @include('layouts.partials._angebot-accordion', ['angebot' => $angebot])
</div>
@endsection
