<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @yield('styles')

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">

        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">

                        <li>
                            <div class="navbar-form">
                                <a href="{{ route('advert.create') }}" class="btn btn-success">{{ __('menu.add_advert') }}</a>
                            </div>
                        </li>

                        <!-- Authentication Links -->
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                @if (Auth::guest()) Account @else {{ Auth::user()->name }} @endif
                                <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu">
                                <li>
                                    <a href="#">
                                        {{ __('menu.my_favorites') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        {{ __('menu.my_comparing') }}
                                    </a>
                                </li>
                                @if (Auth::guest())
                                    <li role="separator" class="divider"></li>
                                    <li><a href="{{ route('login') }}">{{ __('menu.login') }}</a></li>
                                    <li><a href="{{ route('register') }}">{{ __('menu.register') }}</a></li>
                                @else
                                    <li>
                                        <a href="#">
                                            {{ __('menu.my_adverts') }}
                                        </a>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('menu.logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                @endif
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ App::getLocale() }} <span class="caret"></span></a>

                            <ul class="dropdown-menu">
                                @foreach (config('translatable.locales') as $lng => $k)
                                <li><a href="{{ $k }}">{{ $lng }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        @if(Auth::user() && Auth::user()->isAdmin())
            <nav class="navbar navbar-default">
                <div class="container">
                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                        <!-- Left Side Of Navbar -->
                        <ul class="nav navbar-nav">
                        <li><a href="{{ route('category.create') }}">{{ __('menu.create_category') }}</a></li>
                        <li><a href="{{ route('filter.create') }}">{{ __('menu.create_filter') }}</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        @endif

        @yield('content')

        <footer class="footer">
            <div class="container">
                <p>footer here</p>
            </div>
        </footer>

    </div>

    @yield('scripts')
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

</body>
</html>
