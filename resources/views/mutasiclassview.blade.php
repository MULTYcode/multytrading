@extends('dashboard.layout') @section('header')
<h1>Sales
    <small>Mutasi Classify</small>
</h1>
<ol class="breadcrumb">
    <li>
        <a href="{{route('dashboard')}}">
            <i class="fa fa-dashboard"></i> Home</a>
    </li>
    <li class="active">Summary Classify</li>
</ol>
@endsection() @section('content')
<div class="callout callout-info">
    <a href="javascript:history.go(-1)">
        <button class="btn btn-primary">
            <i class="fa fa-arrow-left"></i> Back</button>
    </a>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Summary classify from "{{$datefrom}}" to "{{$dateto}}"</h3>
            </div>
            <div class="box-body" style="width: 100%; overflow: auto; white-space: nowrap;">
                <table id="layout" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>CLASSIFY</th>
                            <th>TOTAL QTTY</th>
                            <th>TOTAL PRICE</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($res as $rows)
                        <tr style="font-weight: normal;">
                            <td>{{ $rows->class }}</td>
                            <td>{{ number_format($rows->tpcs,0) }}</td>
                            <td>{{ number_format($rows->tjual,0) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <th>TOTAL</th>
                        <th>{{number_format($totpcs,0)}}</th>
                        <th>{{number_format($totvalue,0)}}</th>
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