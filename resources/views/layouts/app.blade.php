<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} {{ app()->version() }}</title>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <!-- SVG Icons -->
        <svg class="is-hidden">
            <symbol id="icon-check" viewBox="0 0 45.701 45.7">
                <g>
                    <path d="M20.687,38.332c-2.072,2.072-5.434,2.072-7.505,0L1.554,26.704c-2.072-2.071-2.072-5.433,0-7.504    c2.071-2.072,5.433-2.072,7.505,0l6.928,6.927c0.523,0.522,1.372,0.522,1.896,0L36.642,7.368c2.071-2.072,5.433-2.072,7.505,0    c0.995,0.995,1.554,2.345,1.554,3.752c0,1.407-0.559,2.757-1.554,3.752L20.687,38.332z" fill="#FFFFFF"/>
                </g>
            </symbol>
		</svg>

        <div id="app">
            <nav class="navbar has-shadow">
                <div class="container">
                    <div class="navbar-brand">
                        <a href="{{ url('/') }}" class="navbar-item">
                            <strong>Nachhilfe</strong>Plattform
                        </a>
                        <div class="navbar-item has-dropdown is-hoverable">
                            <a class="navbar-link" href="#">@yield('section_title')</a>

                            <div class="navbar-dropdown">
                                <a class="navbar-item{{ on_page('lernzentrum') ? ' is-active' : '' }}" href="{{ route('lernzentrum') }}">
                                    Lernzentrum
                                </a>
                                @if(Auth::user()->isNotSchueler())
                                    <a class="navbar-item{{ on_page('admin/*') ? ' is-active' : '' }}" href="{{ route('admin.lernzentrum.index') }}">
                                        Admin
                                    </a>
                                @endif
                            </div>
                        </div>



                        <div class="navbar-burger burger" data-target="navMenu">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>

                    <div class="navbar-menu" id="navMenu">
                        <div class="navbar-start"></div>

                        <div class="navbar-end">
                            <div class="navbar-item has-dropdown is-hoverable">
                                <a class="navbar-link" href="#">{{ Auth::user()->name }}</a>

                                <div class="navbar-dropdown">
                                    <a class="navbar-item" href="{{ route('account') }}">
                                        Account
                                    </a>
                                    <a class="navbar-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            @yield('content')
        </div>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
