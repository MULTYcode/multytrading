@extends('dashboard.layout') @section('header')
<h1>Sales
    <small>Sales report</small>
</h1>
<ol class="breadcrumb">
    <li>
        <a href="{{route('dashboard')}}">
            <i class="fa fa-dashboard"></i> Home</a>
    </li>
    <li class="active">Sales</li>
</ol>
@endsection() @section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Sales Channel - Year to Month {{Date("Y")}}</h3>
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
                        {!! $channelchartarea->render() !!}
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
    </div>

    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Sales Channel {{Date("Y")}}</h3>
            </div>
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Month to Date</a></li>
                    <li><a href="#tab_2" data-toggle="tab">Last Month</a></li>
                    <li class="pull-right"><a href="{{ route('salesbychannel') }}" class="text-muted"><i class="fa fa-calendar"></i></a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th>DATE</th>
                                    <th>OFFLINE</th>
                                    <th>ONLINE</th>
                                    <th>KONSINASI</th>
                                    <th>BAZAR</th>
                                    <th>TOTAL</th>
                                </tr>
                                @foreach($saleschannelm2d as $row)
                                <tr>
                                    <td style="padding:0px 0px 0px 10px;">
                                        <h5>{{ $row->tanggal }}</h5>
                                    </td>
                                    <td style="padding:0px 0px 0px 10px;">
                                        <h5>{{ number_format($row->offline,0) }}</h5>
                                    </td>
                                    <td style="padding:0px 0px 0px 10px;">
                                        <h5>{{ number_format($row->online,0) }}</h5>
                                    </td>
                                    <td style="padding:0px 0px 0px 10px;">
                                        <h5>{{ number_format($row->konsinasi,0) }}</h5>
                                    </td>
                                    <td style="padding:0px 0px 0px 10px;">
                                        <h5>{{ number_format($row->bazar,0) }}</h5>
                                    </td>
                                    <td style="padding:0px 0px 0px 10px;">
                                        <h5>{{ number_format($row->total,0) }}</h5>
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <th>TOTAL</th>
                                    <th>{{ number_format($toffline,0) }}</th>
                                    <th>{{ number_format($tonline,0) }}</th>
                                    <th>{{ number_format($tkonsinasi,0) }}</th>
                                    <th>{{ number_format($tbazar,0) }}</th>
                                    <th>{{ number_format($ttotal,0) }}</th>
                                </tr>
                            </table>
                        </div>

                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_2">
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th>DATE</th>
                                    <th>OFFLINE</th>
                                    <th>ONLINE</th>
                                    <th>KONSINASI</th>
                                    <th>BAZAR</th>
                                    <th>TOTAL</th>
                                </tr>
                                @foreach($saleschannelm2d1 as $row)
                                <tr>
                                    <td style="padding:0px 0px 0px 10px;">
                                        <h5>{{ $row->tanggal }}</h5>
                                    </td>
                                    <td style="padding:0px 0px 0px 10px;">
                                        <h5>{{ number_format($row->offline,0) }}</h5>
                                    </td>
                                    <td style="padding:0px 0px 0px 10px;">
                                        <h5>{{ number_format($row->online,0) }}</h5>
                                    </td>
                                    <td style="padding:0px 0px 0px 10px;">
                                        <h5>{{ number_format($row->konsinasi,0) }}</h5>
                                    </td>
                                    <td style="padding:0px 0px 0px 10px;">
                                        <h5>{{ number_format($row->bazar,0) }}</h5>
                                    </td>
                                    <td style="padding:0px 0px 0px 10px;">
                                        <h5>{{ number_format($row->total,0) }}</h5>
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <th>TOTAL</th>
                                    <th>{{ number_format($toffline1,0) }}</th>
                                    <th>{{ number_format($tonline1,0) }}</th>
                                    <th>{{ number_format($tkonsinasi1,0) }}</th>
                                    <th>{{ number_format($tbazar1,0) }}</th>
                                    <th>{{ number_format($ttotal1,0) }}</th>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
        </div>
    </div>
</div>

{{-- <div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Top 10 Sales By Sold Items</h3>
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
                        {!! $chartsold->render() !!}
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
    </div>

    <div class="col-md-6">
        <!-- AREA CHART -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Top 10 Sales By Revenue</h3>

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
                        {!! $chartrevenue->render() !!}
                    </div>
                </div>
            </div>

            <!-- /.box-body -->
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-6">
        <!-- AREA CHART -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Top Sales By Size</h3>

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
                        {!! $barChartUkuran->render() !!}
                    </div>
                </div>
            </div>

            <!-- /.box-body -->
        </div>
    </div>


    <div class="col-md-6">
        <!-- AREA CHART -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Top Sales By Colour</h3>

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
                        {!! $barChartWarna->render() !!}
                    </div>
                </div>
            </div>

            <!-- /.box-body -->
        </div>
    </div> --}}

</div>

@endsection()