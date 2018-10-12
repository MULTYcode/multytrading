@extends('dashboard.layout') @section('header')
<h1>Sales
    <small>Sales By Classify</small>
</h1>
<ol class="breadcrumb">
    <li>
        <a href="{{route('dashboard')}}">
            <i class="fa fa-dashboard"></i> Home</a>
    </li>
    <li class="active">Sales Classify</li>
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
                <h3 class="box-title">Sales items "{{$class}}" from "{{$datefrom}}" to "{{$dateto}}"</h3>
            </div>
            @if($rekap == 1)
            <div class="box-body" style="width: 100%; overflow: auto; white-space: nowrap;">
                <table id="layout" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>CLASS</th>
                            <th>QTTY</th>
                            <th>TOTAL</th>
                            <th>ACTUAL STOCK</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($res as $rows)
                        <tr style="font-weight: normal;">
                            <td>{{ $rows->class }}</td>
                            <td>{{ number_format($rows->pcs,0) }}</td>
                            <td>{{ number_format($rows->total_jual,0) }}</td>
                            <td>{{ number_format($rows->stock,0) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <th>TOTAL</th>
                        <th>{{number_format($tpcs,0)}}</th>
                        <th>{{number_format($tjual,0)}}</th>
                        <th>{{number_format($tstock,0)}}</th>
                    </tfoot>
                </table>
            </div>
            @else
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
                            <th>SIZE</th>
                            <th>COLOUR</th>
                            <th>STORE</th>
                            <th>@PRICE</th>
                            <th>QTTY</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($res as $rows)
                        <tr style="font-weight: normal;">
                            <td>{{ \Carbon\Carbon::parse($rows->tanggal)->format('Y-m-d') }}</td>
                            <td>{{ $rows->kode }}</td>
                            <td>{{ $rows->nama }}</td>
                            <td>{{ $rows->brand }}</td>
                            <td>{{ $rows->class }}</td>
                            <td>{{ $rows->subclass }}</td>
                            <td>{{ $rows->size }}</td>
                            <td>{{ $rows->warna }}</td>
                            <td>{{ $rows->store }}</td>
                            <td>{{ number_format($rows->hjual,0) }}</td>
                            <td>{{ number_format($rows->pcs,0) }}</td>
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
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>{{number_format($tpcs,0)}}</th>
                    </tfoot>
                </table>
            </div>
            @endif
        </div>
    </div>
</div>
<script>
    $(function () {
        $('#layout').DataTable()
    })
</script>
@endsection()