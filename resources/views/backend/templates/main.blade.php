<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">

    <title>@stack('title') | Pondokan Tjiburial </title>
    <link rel="icon" href="{{ asset('assets') }}/images/logo.png">

    {{--style asset--}}
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/simple-line-icons/simple-line-icons.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/select2/select2.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/plugins/select2/select2-bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">

    <link href="{{ asset('assets') }}/plugins/bootstrap-material-design/bootstrap-md.min.css" rel="stylesheet" />
    <link href="{{ asset('backend') }}/assets/css/dashboard.css" rel="stylesheet" />
    <link href="{{ asset('backend') }}/assets/css/custom.css" rel="stylesheet" />

    @stack('css')
    @stack('style')
</head>
<body>
<div class="page">
    <div class="page-main">
        {{--header section--}}
        <div class="header py-4">
            <div class="container">
                <div class="d-flex">
                    <img src="{{ asset('assets') }}/images/logo.png" class="logo" alt="Logo Choral Society" width="30" height="30">
                    <a class="header-brand" href="#">
                        @yield('heading', 'Pondokan Tjiburial')
                    </a>
                    <div class="d-flex order-lg-2 ml-auto">
                        <div class="dropdown">
                            <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                                {{--@if(!empty(app('userRegister', ['event' => 1])->pic) && empty(app('userRegister', ['event' => 1])->pic->photo))--}}
                                    {{--<span class="avatar" style="background-image: url('{{ (app('userRegister', ['event' => 1])->pic->title == 'Mr.') ? asset('assets/images/user/male.png') : asset('assets/images/user/female.png') }}')"></span>--}}
                                {{--@elseif(!empty(app('userRegister', ['event' => 1])->pic) && !empty(app('userRegister', ['event' => 1])->pic->photo))--}}
                                    {{--<span class="avatar" style="background-image: url('{{ asset('uploads/users/'.app('userRegister', ['event' => 1])->pic->photo) }}')"></span>--}}
                                {{--@else--}}
                                    <span class="avatar" style="background-image: url('{{ asset('assets/images/user/male.png') }}')"></span>
                                {{--@endif--}}
                                <span class="ml-2 d-none d-lg-block">
                                  <span class="text-default">{{ @\Auth::user()->name }}</span>
                                  {{--<small class="text-muted d-block mt-1">--}}
                                      {{--@if(!empty(app('userRegister', ['event' => 1])->choir))--}}
                                          {{--PIC of {{ app('userRegister', ['event' => 1])->choir->full_name }}--}}
                                      {{--@else--}}
                                          {{--PIC of (Insert your choir data)--}}
                                      {{--@endif--}}
                                  {{--</small>--}}
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="#">
                                    <i class="dropdown-icon fe fe-user"></i> Profile
                                </a>
                                {{--<a class="dropdown-item" href="#">--}}
                                {{--<i class="dropdown-icon fe fe-settings"></i> Settings--}}
                                {{--</a>--}}
                                {{--<a class="dropdown-item" href="#">--}}
                                {{--<span class="float-right"><span class="badge badge-primary">6</span></span>--}}
                                {{--<i class="dropdown-icon fe fe-mail"></i> Inbox--}}
                                {{--</a>--}}
                                {{--<a class="dropdown-item" href="#">--}}
                                {{--<i class="dropdown-icon fe fe-send"></i> Message--}}
                                {{--</a>--}}
                                {{--<div class="dropdown-divider"></div>--}}
                                {{--<a class="dropdown-item" href="#">--}}
                                {{--<i class="dropdown-icon fe fe-help-circle"></i> Need help?--}}
                                {{--</a>--}}
                                <a class="dropdown-item btnLogout" href="#">
                                    <i class="dropdown-icon fe fe-log-out"></i> Sign out
                                </a>
                                <form class="hidden" id="formLogout" action="{{ url('logout') }}" method="post">
                                    {!! csrf_field() !!}
                                </form>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
                        <span class="header-toggler-icon"></span>
                    </a>
                </div>
            </div>
        </div>
        @include('backend.templates.header')
        {{--end header section--}}

        {{--content section--}}
        <div class="my-3 my-md-5">
            @yield('content')
        </div>

    </div>
    <footer class="footer">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
                    Copyright © {{ date('Y') }} <a href=".">Pondokan Tjiburial</a>. All rights reserved.
                </div>
            </div>
        </div>
    </footer>
</div>

{{--script asset--}}
<script src="{{ asset('assets') }}/plugins/jquery/jquery-3.1.0.min.js"></script>
<script src="{{ asset('backend') }}/assets/js/vendors/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets') }}/plugins/bootstrap-material-design/popper.js"></script>
<script src="{{ asset('assets') }}/plugins/bootstrap-material-design/bootstrap-md.js"></script>
{{--<script src="{{ asset('assets') }}/plugins/bootstrap/js/bootstrap.min.js"></script>--}}
<script src="{{ asset('backend') }}/assets/js/core.js"></script>
<script src="{{ asset('assets') }}/plugins/select2/select2.full.min.js"></script>
<script src="{{ asset('assets') }}/plugins/sweetalert/sweetalert.min.js"></script>

@stack('js')
@stack('script')
<script>
    $(document).ready(function(){
        $('body').bootstrapMaterialDesign();

        $('.btnLogout').on('click', function(e){
            e.preventDefault();

            $('#formLogout').submit();
        })
    });
</script>
</body>
</html>
