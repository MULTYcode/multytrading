@extends('dashboard.layout') @section('header')
<h1>Dashboard
    <small>Control panel</small>
</h1>
<ol class="breadcrumb">
    <li>
        <a href="{{route('dashboard')}}">
            <i class="fa fa-dashboard"></i> Home</a>
    </li>
    <li>
        <a href="{{route('member')}}">
            <i class="fa fa-dashboard"></i> Member</a>
    </li>
    <li class="active">Transaction Member</li>
</ol>
@endsection() @section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Transaction Of New Member</h3>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>STORE</th>
                        <th>MEMBER</th>
                        <th>JANUARY</th>
                        <th>FEBRUARY</th>
                        <th>MARCH</th>
                        <th>APRIL</th>
                        <th>MAY</th>
                        <th>JUNE</th>
                        <th>JULY</th>
                        <th>AGUSTUS</th>
                        <th>SEPTEMBER</th>
                        <th>OCTOBER</th>
                        <th>NOVEMBER</th>
                        <th>DECEMBER</th>
                    </tr>
                    @foreach($trans as $rows)
                    <tr>
                        <td style="padding:0px 0px 0px 10px;">
                            <h5>{{ $rows->store }}</h5>
                        </td>
                        <td style="padding:0px 0px 0px 10px;">
                            <h5>{{ $rows->member }}</h5>
                        </td>
                        <td style="padding:0px 0px 0px 10px;">
                            <h5>{{ number_format($rows->revJAN,0) }}</h5>
                        </td>
                        <td style="padding:0px 0px 0px 10px;">
                            <h5>{{ number_format($rows->revFEB,0) }}</h5>
                        </td>
                        <td style="padding:0px 0px 0px 10px;">
                            <h5>{{ number_format($rows->revMAR,0) }}</h5>
                        </td>
                        <td style="padding:0px 0px 0px 10px;">
                            <h5>{{ number_format($rows->revAPR,0) }}</h5>
                        </td>
                        <td style="padding:0px 0px 0px 10px;">
                            <h5>{{ number_format($rows->revMEI,0) }}</h5>
                        </td>
                        <td style="padding:0px 0px 0px 10px;">
                            <h5>{{ number_format($rows->revJUN,0) }}</h5>
                        </td>
                        <td style="padding:0px 0px 0px 10px;">
                            <h5>{{ number_format($rows->revJUL,0) }}</h5>
                        </td>
                        <td style="padding:0px 0px 0px 10px;">
                            <h5>{{ number_format($rows->revAGU,0) }}</h5>
                        </td>
                        <td style="padding:0px 0px 0px 10px;">
                            <h5>{{ number_format($rows->revSEP,0) }}</h5>
                        </td>
                        <td style="padding:0px 0px 0px 10px;">
                            <h5>{{ number_format($rows->revOKT,0) }}</h5>
                        </td>
                        <td style="padding:0px 0px 0px 10px;">
                            <h5>{{ number_format($rows->revNOV,0) }}</h5>
                        </td>
                        <td style="padding:0px 0px 0px 10px;">
                            <h5>{{ number_format($rows->revDES,0) }}</h5>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection()