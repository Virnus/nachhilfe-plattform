@extends('layouts.app')

@section('section_title', 'Admin')

@section('content')
    @include('admin.layouts.partials._hero', ['title' => ''])

    <section class="section">
        <div class="container">
            @include('layouts.partials._alert')

            @yield('admin.content')
        </div>
    </section>
@endsection
