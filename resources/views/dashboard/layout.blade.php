<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'WSM') }} | We Smart Module</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.min.css')}}">

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">        

</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
            <!-- Logo -->
            <a href="{{route('home')}}" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini">
                    <b>WSM</b>
                </span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg">
                    <b>We Smart Module</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                @if(Auth::user())
                                <img src="/uploads/avatars/{{ Auth::user()->image }}" class="user-image" alt="User Image">
                                <span class="hidden-xs">{{ Auth::user()->name }}</span>
                                @else
                                <img src="{{URL::asset('/images/images.png')}}" class="user-image" alt="User Image">
                                <span class="hidden-xs">Guest </span>
                                @endif
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    @if(Auth::user())
                                    <img src="/uploads/avatars/{{ Auth::user()->image }}" class="img-circle" alt="User Image">
                                    <p>
                                        {{ Auth::user()->name }} - {{ Auth::user()->skill }}
                                        <small>{{ Auth::user()->info }}</small>
                                    </p>
                                    @else
                                    <img src="{{URL::asset('/images/images.png')}}" class="img-circle" alt="User Image">
                                    <span class="hidden-xs">Guest</span>
                                    @endif
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    @if(Auth::user())
                                    <div class="pull-left">
                                        <a href="{{ route('profile') }}" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="{{ route('logout') }}" class="btn btn-default btn-flat" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">Sign
                                            out</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </div>
                                    @else
                                    <div class="pull-left">
                                        <a href="{{ route('login') }}" class="btn btn-default btn-flat">{{Auth::check()}}
                                            Login</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="{{ route('register') }}" class="btn btn-default btn-flat">Register</a>
                                    </div>
                                    @endif
                                </li>
                            </ul>
                        </li>
                        <!-- Control Sidebar Toggle Button -->
                    </ul>
                </div>
            </nav>
        </header>
    </div>
    <aside class="main-sidebar">
        <section class="sidebar">
            <div class="user-panel">
                <div class="pull-left image">
                    @if(Auth::user())
                    <img src="/uploads/avatars/{{ Auth::user()->image }}" class="img-circle" alt="User Image">
                    @else
                    <img src="{{URL::asset('/images/images.png')}}" class="img-circle" alt="User Image">
                    @endif
                </div>
                <div class="pull-left info">
                    @if(Auth::user())
                    <p>{{ Auth::user()->name }}</p>
                    @else
                    <p>Guest</p>
                    @endif
                    <a href="#">
                        <i class="fa fa-circle text-success"></i>Online</a>
                </div>
            </div>

            <ul class="sidebar-menu" data-widget="tree">
                @foreach($daftarmenu as $menu)
                @if($menu->sub == '-')
                <li class="header">{{ $menu->main }}</li>
                @else
                @if($menu->sub_type == -1)
                <li><a href={{ $menu->route }}><i class="{{$menu->icon}}"></i> <span>{{ $menu->main }}</span></a></li>
                @else
                @if($menu->sub_type == "0")
                <li class="treeview">
                    <a href="#">
                        <i class="{{$menu->icon}}"></i>
                        <span> {{ $menu->main }} </span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @foreach($daftarmenu as $level1)
                        @if($menu->main == $level1->sub and $level1->sub_type !== 0)
                        <li>
                            <a href={{ $level1->route }}>
                                <i class="{{$level1->icon}}"></i> {{ $level1->main }}
                            </a>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </li>
                @endif
                @endif
                @endif
                @endforeach
            </ul>
        </section>
    </aside>

    <div class="content-wrapper">
        @yield('content-header')
        @yield('content')
    </div>

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            Anything you want
        </div>
        <strong>Copyright &copy; 2016 <a href="#">Company</a>.</strong> All rights reserved.
    </footer>

    <!-- jQuery 3 -->
    <script src="{{URL::asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{URL::asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- Slimscroll -->
    <script src="{{URL::asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{URL::asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{URL::asset('dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{URL::asset('dist/js/demo.js')}}"></script>

</body>

</html>