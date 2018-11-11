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
                                                <a href={{ $level1->route }} >
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