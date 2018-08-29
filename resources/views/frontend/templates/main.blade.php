<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@stack('title') | Pondokan Tjiburial</title>
    <link rel="icon" href="{{ asset('assets') }}/images/logo.png">

    {{--style asset--}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
          integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />

    @stack('css')
    @stack('style')
</head>
<body>
{{--header section--}}
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="z-index:1000">
    <a class="navbar-brand" href="{{ url('/') }}">
        <img src="{{ asset('assets') }}/images/logo.png" alt="Logo Tjiburial" width="50">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto">
            <li class="nav-item {{ @request()->segments(2)[0] == '' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/') }}">HOME <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item {{ @request()->segments(2)[0] == 'features' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/features') }}">FEATURES</a>
            </li>
            <li class="nav-item {{ @request()->segments(2)[0] == 'blog' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/blog') }}">BLOG</a>
            </li>
            <li class="nav-item {{ @request()->segments(2)[0] == 'book' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/book') }}">BOOK</a>
            </li>
            <li class="nav-item {{ @request()->segments(2)[0] == 'about' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/about') }}">ABOUT</a>
            </li>
            <li class="nav-item {{ @request()->segments(2)[0] == 'faq' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/faq') }}">FAQ</a>
            </li>
            <li class="nav-item {{ @request()->segments(2)[0] == 'contact' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/contact') }}">CONTACT US</a>
            </li>
            @guest
            <li class="nav-item {{ @request()->segments(2)[0] == 'login' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/login') }}">LOGIN</a>
            </li>
            <li class="nav-item {{ @request()->segments(2)[0] == 'register' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/register') }}">REGISTER</a>
            </li>
            @endguest
            @auth
            <li class="nav-item {{ @request()->segments(2)[0] == 'profile' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/profile') }}">PROFILE</a>
            </li>
                @if(Auth::user()->type == 'admin')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/admin') }}"><i class="fa fa-cog"></i> ADMIN</a>
                    </li>
                @endif
            <li class="nav-item">
                <a href="{{ route('logout') }}" class="nav-link btn btn-outline-danger" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                    LOGOUT
                </a>
                <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
            @endauth
        </ul>
    </div>
</nav>

{{--content section--}}
@yield('content')

{{--script asset--}}
<script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
@stack('js')
@stack('script')

</body>
</html>
