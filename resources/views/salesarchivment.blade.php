@extends('dashboard.layout') @section('header')
<h1>Sales
    <small>Sales  Achievement</small>
</h1>
<ol class="breadcrumb">
    <li>
        <a href="{{route('dashboard')}}">
            <i class="fa fa-dashboard"></i> Home</a>
    </li>
    <li class="active">Sales  Achievement</li>
</ol>
@endsection() @section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">SALES  Achievement</h3>
            </div>
            <div class="box-body">
                <div class="chart">
                    <div style="height:auto;">
                        {!! $chartarea->render() !!}
                    </div>
                </div>
            </div>
            <div class="box-body" style="width: 100%; overflow: auto; white-space: nowrap;">
                <table id="layout" class="table table-bordered table-hover">
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
</div>
<script>
    $(function () {
        $('#layout').DataTable()
    })
</script>
@endsection()