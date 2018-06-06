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
                <h3 class="box-title">Additional Store Member</h3>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>STORE</th>
                        <th>NEW MEMBER</th>
                    </tr>
                    @foreach($memberstore as $memberstores)
                    <tr>
                        <td style="padding:0px 0px 0px 10px;">
                            <h5>{{ $memberstores->store }}</h5>
                        </td>
                        <td style="padding:0px 0px 0px 10px;">
                            <h5>{{ number_format($memberstores->jmlmember,0) }}</h5>
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
                <h3 class="box-title">Additional Member Per Month</h3>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>MONTH</th>
                        <th>NEW MEMBER</th>
                    </tr>
                    @foreach($membermonth as $membermonths)
                    <tr>
                        <td style="padding:0px 0px 0px 10px;">
                            <a href="{{ route('membertrans',['bulan'=>$membermonths->bulan]) }}">
                                <h5>{{ $membermonths->bulan }}</h5>
                            </a>
                        </td>
                        <td style="padding:0px 0px 0px 10px;">
                            <h5>{{ number_format($membermonths->jmlmember,0) }}</h5>
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
</div>
@endsection()