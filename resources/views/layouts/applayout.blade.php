<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" ></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script>
        var BASE = '{{url('')}}';
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">Navigation</div>

                            <div class="card-body">
                                <ul>
                                    <li><a href="{{route('home')}}">Home</a></li>
                                    <li><a href="{{route('subjects')}}">Manage Subjects</a></li>
                                    <li><a href="{{route('students')}}">Manage Students</a></li>
                                    <li><a href="{{route('marks-add')}}">Manage Marks</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">{{isset($card_title) ? $card_title : config('app.name', 'Laravel')}}</div>

                            <div class="card-body">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @isset($styles)
        @if(count($styles))
            @foreach($styles as $value)
                <link href="{{asset('css/'.$value.'.css?v=1.'.rand(10,100))}}" />
            @endforeach
        @endif
    @endisset


    @isset($scripts)
        @if(count($scripts))
            @foreach($scripts as $value)
                <script src="{{asset('js/'.$value.'.js?v=1.'.rand(10,100))}}"></script>
            @endforeach
        @endif
    @endisset

    @if(session('common_msg'))
        <script>
            swal("{{session('common_msg')['title']}}", "{{session('common_msg')['message']}}", "{{session('common_msg')['type']}}");
        </script>
    @endif
</body>
</html>
