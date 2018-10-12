@extends('dashboard.layout') @section('header')
<h1>Sales
    <small>Sales By Channel</small>
</h1>
<ol class="breadcrumb">
    <li>
        <a href="{{route('dashboard')}}">
            <i class="fa fa-dashboard"></i> Home</a>
    </li>
    <li class="active">Sales Channel</li>
</ol>
@endsection() @section('content')
<div class="row">
    <div class="col-xs-12">
        <a href="javascript:history.go(-1)">
            <button class="btn btn-primary">
                <i class="fa fa-arrow-left"></i> Back</button>
        </a>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Sales channel from "{{$datefrom}}" to "{{$dateto}}"</h3>
            </div>
            <div class="box-body" style="width: 100%; overflow: auto; white-space: nowrap;">
                <table id="layout" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>DATE</th>
                            <th>OFFLINE</th>
                            <th>ONLINE</th>
                            <th>KONSINASI</th>
                            <th>BAZAR</th>
                            <th>TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($res as $row)
                        <tr>
                            <td style="padding:0px 0px 0px 10px;">
                                <h5>{{ $row->tanggal }}</h5>
                            </td>
                            <td style="padding:0px 0px 0px 10px;">
                                <h5><a style="text-decoration:underline;" href="{{ route('getstore',['channel'=>'channel', 'brand'=>'offline','tglfrom'=>\Carbon\Carbon::parse($row->tanggal)->format('Y-m-d'),'tglto'=>\Carbon\Carbon::parse($row->tanggal)->format('Y-m-d')]) }}">{{ number_format($row->offline,0) }}</a></h5>
                            </td>
                            <td style="padding:0px 0px 0px 10px;">
                                <h5><a style="text-decoration:underline;" href="{{ route('getstore',['channel'=>'channel', 'brand'=>'online','tglfrom'=>\Carbon\Carbon::parse($row->tanggal)->format('Y-m-d'),'tglto'=>\Carbon\Carbon::parse($row->tanggal)->format('Y-m-d')]) }}">{{ number_format($row->online,0) }}</a></h5>
                            </td>
                            <td style="padding:0px 0px 0px 10px;">
                                <h5><a style="text-decoration:underline;" href="{{ route('getstore',['channel'=>'channel', 'brand'=>'konsinasi','tglfrom'=>\Carbon\Carbon::parse($row->tanggal)->format('Y-m-d'),'tglto'=>\Carbon\Carbon::parse($row->tanggal)->format('Y-m-d')]) }}">{{ number_format($row->konsinasi,0) }}</a></h5>
                            </td>
                            <td style="padding:0px 0px 0px 10px;">
                                <h5><a style="text-decoration:underline;" href="{{ route('getstore',['channel'=>'channel', 'brand'=>'bazar','tglfrom'=>\Carbon\Carbon::parse($row->tanggal)->format('Y-m-d'),'tglto'=>\Carbon\Carbon::parse($row->tanggal)->format('Y-m-d')]) }}">{{ number_format($row->bazar,0) }}</a></h5>
                            </td>
                            <td style="padding:0px 0px 0px 10px;">
                                <h5>{{ number_format($row->total,0) }}</h5>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <th>TOTAL</th>
                        <th>{{ number_format($toffline,0) }}</th>
                        <th>{{ number_format($tonline,0) }}</th>
                        <th>{{ number_format($tkonsinasi,0) }}</th>
                        <th>{{ number_format($tbazar,0) }}</th>
                        <th>{{ number_format($ttotal,0) }}</th>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('#layout').DataTable()
    })
</script>
@endsection()