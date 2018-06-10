@extends('dashboard.layout') @section('header')
<h1>Dashboard
    <small>Control panel</small>
</h1>
<ol class="breadcrumb">
    <li>
        <a href="{{route('dashboard')}}">
            <i class="fa fa-dashboard"></i> Home</a>
    </li>
    <li class="active">Dashboard</li>
</ol>
@endsection() @section('content')
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                @foreach($sls as $_sls)
                <h3>{{number_format($_sls->cr,0)}}
                    <sup style="font-size: 18px">CR</sup>
                </h3>
                @endforeach
                <p>New Orders</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="{{ route('cryear') }}" class="small-box-footer">More info
                <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                @foreach($sls as $_sls)
                <h3>{{number_format($_sls->pcs,0)}}
                    <sup style="font-size: 20px">PCS</sup>
                </h3>
                @endforeach
                <p>Among of year</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{ route('pcsyear') }}" class="small-box-footer">More info
                <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                @foreach($sls as $_sls)
                <p style="font-size: 29px">
                    {{number_format($_sls->rupiah,0)}}
                    <sup style="font-size: 15px">Rp</sup>
                </p>
                @endforeach
                <p>Sales Revenue</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ route('revenueyear') }}" class="small-box-footer">More info
                <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                @foreach($member as $jmlmember)
                <h3>{{number_format($jmlmember->jmlmember,0)}}</h3>
                @endforeach
                <p>User Registrations</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ route('member') }}" class="small-box-footer">More info
                <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <!-- ./col -->

    {{-- GRAFIK & TABLE --}}

    <div class="col-xs-6">
        <!-- AREA CHART -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Sales Targeted by Area</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">
                <div class="chart">
                    <div style="height:auto;">
                        {!! $chartarea->render() !!}
                    </div>
                </div>
            </div>
            <div class="box-header with-border">
                <h3 class="box-title">Data List</h3>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>AREA</th>
                        <th>REVENUE</th>
                        <th>TARGETED</th>
                        <th>GOAL</th>
                    </tr>
                    @foreach($area as $areas)
                    <tr>
                        <td style="padding:0px 0px 0px 10px;">
                            <a href="#">
                                <h5>{{ $areas->area }}</h5>
                            </a>
                        </td>
                        <td style="padding:0px 0px 0px 10px;">
                            <h5>{{ number_format($areas->rupiah,0) }}</h5>
                        </td>
                        <td style="padding:0px 0px 0px 10px;">
                            <h5>{{ number_format($areas->target,0) }}</h5>
                        </td>
                        <td style="padding:0px 0px 0px 10px;">
                            <span class="badge bg-red">{{ $areas->goal }} %</span>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

    <div class="col-xs-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Sales By Category</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">
                <div class="chart">
                    <div style="height:auto;">
                        {!! $chartcategory->render() !!}
                    </div>
                </div>
            </div>
            <div class="box-header with-border">
                <h3 class="box-title">Data List</h3>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>CATEGORY</th>
                        <th>REVENUE</th>
                    </tr>
                    @foreach($category as $categorys)
                    <tr>
                        <td style="padding:0px 0px 0px 10px;">
                            <h5>{{ $categorys->cat }}</h5>
                        </td>
                        <td style="padding:0px 0px 0px 10px;">
                            <h5>{{ number_format($categorys->total,0) }}</h5>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

</div>
@endsection()