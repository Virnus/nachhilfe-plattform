@extends('layouts.app')

@section('section_title', 'Admin')

@section('content')
    @include('admin.layouts.partials._hero', ['title' => "@yield('admin.title')"])

    <section class="section">
        <div class="container">
            @include('layouts.partials._alert')

            <div class="card">
                <header class="card-header">
                    <p class="card-header-title">
                        @yield('admin.title')
                    </p>
                </header>

                <div class="card-content">
                    @yield('admin.content')
                </div>
            </div>
        </div>
    </section>
@endsection
