@extends('dashboard.layout') @section('header')
<h1>Dashboard
    <small>Control panel</small>
</h1>
<ol class="breadcrumb">
    <li>
        <a href="{{route('dashboard')}}">
            <i class="fa fa-dashboard"></i> Home</a>
    </li>
    <li class="active">Member</li>
</ol>
@endsection() @section('content')
<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Additional per Store In {{$_tahun}}</h3>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>STORE</th>
                        <th>NEW MEMBER</th>
                    </tr>
                    @foreach($memberstore as $memberstore)
                    <tr>
                        <td style="padding:0px 0px 0px 10px;">
                            <h5>{{ $memberstore->store }}</h5>
                        </td>
                        <td style="padding:0px 0px 0px 10px;">
                            <h5>{{ number_format($memberstore->jmlmember,0) }}</h5>
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <th>TOTAL</th>
                        <th>{{number_format($total,0)}}</th>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-xs-6">
        <!-- AREA CHART -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Additional per Month In {{$_tahun}}</h3>
            </div>
            <div class="box-body">
                <div class="chart">
                    <div style="height:auto;">
                        {!! $chartarea->render() !!}
                    </div>
                </div>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>MONTH</th>
                        <th>NEW MEMBER</th>
                    </tr>
                    @foreach($membermonth as $membermonth)
                    <tr>
                        <td style="padding:0px 0px 0px 10px;">
                            <a href="{{ route('membertrans',['bulan'=>$membermonth->namabulan]) }}">
                                <h5>{{ $membermonth->namabulan }}</h5>
                            </a>
                        </td>
                        <td style="padding:0px 0px 0px 10px;">
                            <h5>{{ number_format($membermonth->jmlmember,0) }}</h5>
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <th>TOTAL</th>
                        <th>{{number_format($total,0)}}</th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection()