@extends('dashboard.layout') @section('header')
<h1>Dashboard
    <small>Control panel</small>
</h1>
<ol class="breadcrumb">
    <li>
        <a href="{{route('dashboard')}}">
            <i class="fa fa-dashboard"></i> Home</a>
    </li>
    <li class="active">Transaction</li>
</ol>
@endsection() @section('content')
<div class="row">
    <div class="col-xs-12">
        <!-- AREA CHART -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Transaction : Current Year vs last Year</h3>

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
                <h3 class="box-title">Data Transactions</h3>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>YEAR</th>
                        <th>MONTH</th>
                        <th>TRANSACTION</th>
                    </tr>
                    @foreach($cryear as $cryears)
                    <tr>
                        <td style="padding:0px 0px 0px 10px;">
                            <h5>{{ $cryears->tahun }}</h5>
                        </td>
                        <td style="padding:0px 0px 0px 10px;">
                            <h5>{{ $cryears->namabulan }}</h5>
                        </td>
                        <td style="padding:0px 0px 0px 10px;">
                            <h5>{{ number_format($cryears->cr,0) }}</h5>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection()