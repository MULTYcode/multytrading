{{-- < !-- Left side column. contains the logo and sidebar --> --}}
    <aside class="main-sidebar">
{{--         < !-- sidebar: style can be found in sidebar.less --> --}}
            <section class="sidebar">
{{--                 < !-- Sidebar user panel --> --}}
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="/uploads/avatars/{{ Auth::user()->image }}" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p>{{ Auth::user()->name }}</p>
                            <a href="#">
                                <i class="fa fa-circle text-success"></i>Online</a>
                        </div>
                    </div>
                    {{-- < !-- sidebar menu:: style can be found in sidebar.less --> --}}
                        <ul class="sidebar-menu" data-widget="tree">
                            @foreach($daftarmenu as $menu) 
                                @if($menu->sub_order > 0) 
                                    @break 
                                @endif 
                                @if($menu->sub == '-')
                                    <li class="header">{{ $menu->main }}</li>
                                @else 
                                    @if($menu->sub_order <= -1) 
                                        <li><a href={{ $menu->route }}><i class="{{$menu->icon}}"></i> {{ $menu->main }}</a></li>
                                    @else 
                                        @foreach($daftarmenu as $level1) 
                                            @if($level1->sub_order == "0")
                                                <li class="treeview">
                                                    <a href="#">
                                                        <i class="{{$level1->icon}}"></i>
                                                        <span> {{ $level1->main }} </span>
                                                        <span class="pull-right-container">
                                                            <i class="fa fa-angle-left pull-right"></i>
                                                        </span>
                                                    </a>
                                                    <ul class="treeview-menu">
                                                        @foreach($daftarmenu as $level2) 
                                                            @if($level1->main == $level2->sub and $level2->sub_order !== 0)
                                                                <li>
                                                                    <a href={{ $level2->route }} >
                                                                    <i class="{{$level2->icon}}"></i> {{ $level2->main }}
                                                                    </a>
                                                                </li>
                                                            @endif 
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @endif 
                                        @endforeach 
                                    @endif 
                                @endif
                            @endforeach
                        </ul>
            </section>
           {{--  < !-- /.sidebar --> --}}
    </aside>