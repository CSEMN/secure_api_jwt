<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      dir="{{($_COOKIE['lang']=='ar')?'rtl':'ltr'}}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{($_COOKIE['lang']=='ar')?'لارافيل':'Laravel'}}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!--Jquery -->
{{--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">--}}
{{--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">--}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container " dir="ltr">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{($_COOKIE['lang']=='ar')?'لارافيل':'Laravel'}}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent" >
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                       <a class="nav-link" id="ar_btn" href='#'>{{($_COOKIE['lang']=='ar')?'عربي':'AR'}}</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="en_btn" href="#">{{($_COOKIE['lang']=='ar')?'انجليزي':'En'}}</a>
                    </li>

                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{($_COOKIE['lang']=='ar')?'تسجيل الدخول':'Login'}}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{($_COOKIE['lang']=='ar')?'حساب جديد':'Register'}}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
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
        @yield('content')
    </main>
</div>

<script type="text/javascript">
    function setCookieAr() {
        document.cookie = "lang=ar;path=/";
        location.reload();
    }

    function setCookieEn() {
        document.cookie = "lang=en;path=/";
        location.reload();
    }

    document.getElementById("ar_btn").addEventListener("click", setCookieAr);
    document.getElementById("en_btn").addEventListener("click", setCookieEn);
</script>
</body>
</html>

<style>

    .btn-primary {
        background-color: #ef5684;
        border-color: #ef5684;
        transition-duration: 0.4s;
    }

    .btn-primary:hover {
        background-color: #8c1235;
        border-color: #8c1235;
    }

    .btn-primary:focus {
        background-color: #8c334e;
        border-color: #8c334e;
        box-shadow: 0 0 0 0.25rem rgba(215, 51, 97, 0.1);

    }

    .btn-primary:active {
        background-color: #d0184f;
        border-color: #d0184f;
    }

    .btn-primary:active:focus {
        box-shadow: 0 0 0 0.25rem rgba(215, 51, 97, 0.1);
    }

    .form-control:focus {
        color: #212529;
        background-color: #f8fafc;
        border-color: #ef5684;
        outline: 0;
        box-shadow: 0 0 0 0.25rem rgba(239, 86, 132, 0.25);
    }

    .form-check-input:checked {
        background-color: #ef5684;
        border-color: #ef5684;
    }

    .form-check-input:focus {
        border-color: #ef5684;
        outline: 0;
        box-shadow: 0 0 0 0.25rem rgba(239, 86, 132, 0.25);
    }

    .btn-link {
        color: #ef5684;
        transition-duration: 0.4s;
    }

    .btn-link:hover {
        color: #a93257;
        transition-duration: 0.4s;
    }

    .btn-link:focus {
        border-color: #a93257;
        box-shadow: 0 0 0 0.25rem rgba(239, 86, 132, 0.25);
    }
</style>


