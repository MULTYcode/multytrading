@extends('dashboard.layout') @section('header')
<h1>Catalog
    <small>Mutasi Periode</small>
</h1>
<ol class="breadcrumb">
    <li>
        <a href="{{route('dashboard')}}">
            <i class="fa fa-dashboard"></i> Home</a>
    </li>
    <li class="active">Mutasi</li>
</ol>
@endsection() 
@section('content')
<div class="row">
    <div class="col-xs-12">
        <a href="javascript:history.go(-1)">
            <button class="btn btn-primary">
                <i class="fa fa-arrow-left"></i> Back</button>
        </a>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Mutasi Items</h3>
            </div>
            <div class="box-body" style="width: 100%; overflow: auto; white-space: nowrap;">
                <table id="layout" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>DATE</th>
                            <th>CODE</th>
                            <th>DESCRIPTION</th>
                            <th>BRAND</th>
                            <th>CLASS</th>
                            <th>SUBCLASS</th>
                            <th>COLOUR</th>
                            <th>SIZE</th>
                            <th>STORE FROM</th>
                            <th>STORE TO</th>
                            <th>VALUE</th>
                            <th>QTTY</th>
                        </tr>    
                    </thead>
                    <tbody>
                         @foreach($res as $rows)
                        <tr style="font-weight: normal;">
                            <td>{{ $rows->tanggal }}</td>
                            <td>{{ $rows->kode }}</td>
                            <td>{{ $rows->nama }}</td>
                            <td>{{ $rows->brand }}</td>
                            <td>{{ $rows->class }}</td>
                            <td>{{ $rows->subclass }}</td>
                            <td>{{ $rows->warna }}</td>
                            <td>{{ $rows->ukuran }}</td>
                            <td>{{ $rows->asal }}</td>
                            <td>{{ $rows->tujuan }}</td>
                            <td>{{ number_format($rows->totaljual,0) }}</td>
                            <td>{{ number_format($rows->totalkirim,0) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tr>
                        <th>TOTAL</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>{{number_format($total,0)}}</th>
                        <th>{{number_format($totalpcs,0)}}</th>
                    </tr>
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
