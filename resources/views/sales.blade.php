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

            {{--
            <div class="box-header with-border">
                <h3 class="box-title">Data Top 10</h3>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>Categories</th>
                        <th>Pcs Sold</th>
                    </tr>
                    @foreach($sold as $solds)
                    <tr>
                        <td style="padding:0px 0px 0px 10px;">
                            <h5>{{ $solds->namabarang }}</h5>
                        </td>
                        <td style="padding:0px 0px 0px 10px;">
                            <h5>{{ number_format($solds->qty,0) }}</h5>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div> --}}
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

            {{--
            <div class="box-header with-border">
                <h3 class="box-title">Data Top 10</h3>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>Categories</th>
                        <th>Revenue</th>
                    </tr>
                    @foreach($revenue as $revenues)
                    <tr>
                        <td style="padding:0px 0px 0px 10px;">
                            <h5>{{ $revenues->namabarang }}</h5>
                        </td>
                        <td style="padding:0px 0px 0px 10px;">
                            <h5>{{ number_format($revenues->harga,0) }}</h5>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div> --}}

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

            {{--
            <div class="box-header with-border">
                <h3 class="box-title">Data Top 10</h3>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>Categories</th>
                        <th>Revenue</th>
                    </tr>
                    @foreach($ukuran as $ukurans)
                    <tr>
                        <td style="padding:0px 0px 0px 10px;">
                            <h5>{{ $ukurans->ukuran }}</h5>
                        </td>
                        <td style="padding:0px 0px 0px 10px;">
                            <h5>{{ number_format($ukurans->total,0) }}</h5>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div> --}}

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

            {{--
            <div class="box-header with-border">
                <h3 class="box-title">Data Top 10</h3>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>Categories</th>
                        <th>Revenue</th>
                    </tr>
                    @foreach($warna as $warnas)
                    <tr>
                        <td style="padding:0px 0px 0px 10px;">
                            <h5>{{ $warnas->warna }}</h5>
                        </td>
                        <td style="padding:0px 0px 0px 10px;">
                            <h5>{{ number_format($warnas->total,0) }}</h5>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div> --}}

            <!-- /.box-body -->
        </div>
    </div>

</div>

@endsection()