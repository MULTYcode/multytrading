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
                <h3 class="box-title">GRN items "{{$item}}" from "{{$datefrom}}" to "{{$dateto}}"</h3>
            </div>
            <div class="box-body" style="width: 100%; overflow: auto; white-space: nowrap;">
                <table id="layout" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>CODE</th>
                            <th>DESCRIPTION</th>
                            <th>BRAND</th>
                            <th>CLASS</th>
                            <th>SIZE</th>
                            <th>COLOR</th>
                            <th>GRN</th>
                            <th>MUTASI</th>
                            <th>SALES</th>
                            <th>ACTUAL STOCK</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($res as $rows)
                        <tr style="font-weight: normal;">
                            <td>{{ $rows->kode }}</td>
                            <td>{{ $rows->nama }}</td>
                            <td>{{ $rows->brand }}</td>
                            <td>{{ $rows->class }}</td>
                            <td>{{ $rows->ukuran }}</td>
                            <td>{{ $rows->warna }}</td>
                            <td><a style="text-decoration:underline;" href="{{ route('grn2slsviewgrn',['barcode'=>$rows->kode]) }}">{{
                                    number_format($rows->grn,0) }}</a></td>
                            <td><a style="text-decoration:underline;" href="{{ route('grn2slsviewmutasi',['barcode'=>$rows->kode]) }}">{{
                                    number_format($rows->mutasi,0) }}</a></td>
                            <td><a style="text-decoration:underline;" href="{{ route('grn2slsviewsales',['barcode'=>$rows->kode]) }}">{{
                                    number_format($rows->sls,0) }}</a></td>
                            <td>{{ number_format($rows->sisa,0) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <th>TOTAL</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <td>{{ number_format($tgrn,0) }}</td>
                        <td>{{ number_format($tmutasi,0) }}</td>
                        <td>{{ number_format($tsales,0) }}</td>
                        <td>{{ number_format($tstock,0) }}</td>
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