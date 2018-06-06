@extends('dashboard.layout') @section('header')
<h1>Dashboard
    <small>Control panel</small>
</h1>
<ol class="breadcrumb">
    <li>
        <a href="{{route('dashboard')}}">
            <i class="fa fa-dashboard"></i> Home</a>
    </li>
    <li class="active">Revenue</li>
</ol>
@endsection() @section('content')
<div class="row">
    <div class="col-xs-12">
        <!-- AREA CHART -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">REVENUE : Current Year vs last Year</h3>

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
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Data Transactions</h3>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>YEAR</th>
                        <th>MONTH</th>
                        <th>TRANSACTION</th>
                    </tr>
                    @foreach($revenueyear as $revenueyears)
                    <tr>
                        <td style="padding:0px 0px 0px 10px;">
                            <h5>{{ $revenueyears->tahun }}</h5>
                        </td>
                        <td style="padding:0px 0px 0px 10px;">
                            <h5>{{ $revenueyears->bulan }}</h5>
                        </td>
                        <td style="padding:0px 0px 0px 10px;">
                            <h5>{{ number_format($revenueyears->revenue,0) }}</h5>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Summery</h3>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>YEAR</th>
                        <th>QUANTITY</th>
                        <th>REVENUE</th>
                        <th>CAGR[Revenue]</th>
                    </tr>
                    @foreach($rekaprevenue as $key => $rekaprevenues)
                    <tr>
                        <td style="padding:0px 0px 0px 10px;">
                            <h5>{{ $rekaprevenues->tahun }}</h5>
                        </td>
                        <td style="padding:0px 0px 0px 10px;">
                            <h5>{{ number_format($rekaprevenues->pcs,0) }}</h5>
                        </td>
                        <td style="padding:0px 0px 0px 10px;">
                            <h5>{{ number_format($rekaprevenues->revenue,0) }}</h5>
                        </td>
                        <td style="padding:0px 0px 0px 10px;">
                            <h5> {{ $cagr[$key] }} </h5>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Store Ranking</h3>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>RANK</th>
                        <th>YEAR</th>
                        <th>QUANTITY</th>
                    </tr>
                    @foreach($storerank as $key => $storeranks)
                    <tr>
                        <td style="padding:0px 0px 0px 10px;">
                            <h5>{{ $key + 1 }}</h5>
                        </td>
                        <td style="padding:0px 0px 0px 10px;">
                            <h5>{{ $storeranks->store }}</h5>
                        </td>
                        <td style="padding:0px 0px 0px 10px;">
                            <h5>{{ number_format($storeranks->total,0) }}</h5>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection()