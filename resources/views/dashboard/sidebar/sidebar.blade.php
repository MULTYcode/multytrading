<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <a href="#">
                    <i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        {{-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form> --}}
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li>
                <a href="{{route('dashboard')}}">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Store List</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>Sales</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="pages/charts/chartjs.html">
                            <i class="fa fa-circle-o"></i> By Store</a>
                    </li>
                    <li>
                        <a href="pages/charts/morris.html">
                            <i class="fa fa-circle-o"></i> By Article</a>
                    </li>
                    <li>
                        <a href="pages/charts/flot.html">
                            <i class="fa fa-circle-o"></i> By Adviser</a>
                    </li>
                    <li>
                        <a href="pages/charts/inline.html">
                            <i class="fa fa-circle-o"></i> By Class</a>
                    </li>
                    <li>
                        <a href="pages/charts/inline.html">
                            <i class="fa fa-circle-o"></i> By Colour</a>
                    </li>
                    <li>
                        <a href="pages/charts/inline.html">
                            <i class="fa fa-circle-o"></i> By Size</a>
                    </li>
                </ul>
            </li>
            <li class="header">INVENTORY</li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-laptop"></i>
                    <span>Master Barang</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="pages/UI/general.html">
                            <i class="fa fa-circle-o"></i> General</a>
                    </li>
                    <li>
                        <a href="pages/UI/icons.html">
                            <i class="fa fa-circle-o"></i> Icons</a>
                    </li>
                    <li>
                        <a href="pages/UI/buttons.html">
                            <i class="fa fa-circle-o"></i> Buttons</a>
                    </li>
                    <li>
                        <a href="pages/UI/sliders.html">
                            <i class="fa fa-circle-o"></i> Sliders</a>
                    </li>
                    <li>
                        <a href="pages/UI/timeline.html">
                            <i class="fa fa-circle-o"></i> Timeline</a>
                    </li>
                    <li>
                        <a href="pages/UI/modals.html">
                            <i class="fa fa-circle-o"></i> Modals</a>
                    </li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>