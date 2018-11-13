<header class="main-header">

    <!-- Logo -->
    <a href="{{route('home')}}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">WSM</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">We Smart Module</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        @if(Auth::user())
                        <img src="/uploads/avatars/{{ Auth::user()->image }}" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{ Auth::user()->name }}</span>
                        @else
                        <img src="{{URL::asset('/images/images.png')}}" class="user-image" alt="User Image">
                        <span class="hidden-xs">Guest </span>
                        @endif </a>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
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
                        <!-- Menu Body -->
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
                                <a href="{{ route('login') }}" class="btn btn-default btn-flat">{{Auth::check()}} Login</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('register') }}" class="btn btn-default btn-flat">Register</a>
                            </div>
                            @endif
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>