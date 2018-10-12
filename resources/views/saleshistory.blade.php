@extends('dashboard.layout') @section('header')
<h1>Sales
    <small>Trace Good Recieve Note To Sales</small>
</h1>
<ol class="breadcrumb">
    <li>
        <a href="{{route('dashboard')}}">
            <i class="fa fa-dashboard"></i> Home</a>
    </li>
    <li class="active">GRN Periode</li>
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
                <h3 class="box-title">History For Sales</h3>
            </div>
            <div class="box-body" style="width: 100%; overflow: auto; white-space: nowrap;">
                <table id="layout" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>NO.TRANSACTION</th>
                            <th>DATE</th>
                            <th>TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($res as $rows)
                        <tr style="font-weight: normal;">   
                            <td>{{ $rows->id_trans }}</td>
                            <td>{{ \Carbon\Carbon::parse($rows->tanggal)->format('Y-m-d') }}</td>
                            <td>{{ number_format($rows->pcs,0) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <th>TOTAL</th>
                        <th></th>
                        <td>{{ number_format($tsls,0) }}</td>
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