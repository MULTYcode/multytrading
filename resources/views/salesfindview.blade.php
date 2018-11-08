@extends('dashboard.layout') @section('header')
<h1>Catalog
    <small>Find Sales</small>
</h1>
<ol class="breadcrumb">
    <li>
        <a href="{{route('dashboard')}}">
            <i class="fa fa-dashboard"></i> Home</a>
    </li>
    <li class="active">Sales</li>
</ol>
@endsection()
@section('content')
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
                <h3 class="box-title">Sales Items</h3>
            </div>
            <div class="box-body">
                <table id="layout" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>STORE</th>
                            <th>ITEM</th>
                            <th>COLOR</th>
                            <th>SIZE</th>
                            <th>DATE</th>
                            <th>QTY</th>
                            <th>TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($res as $rows)
                        <tr style="font-weight: normal;">
                            <td>{{ $rows->store }}</td>
                            <td>{{ $rows->namabarang }}</td>
                            <td>{{ $rows->warna }}</td>
                            <td>{{ $rows->ukuran }}</td>
                            <td>{{ $rows->sitgl }}</td>
                            <td>{{ number_format($rows->pcs,0) }}</td>
                            <td>{{ number_format($rows->rupiah,0) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>TOTAL</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>{{ number_format($tpcs,0) }}</th>
                            <th>{{ number_format($ttotal,0) }}</th>
                        </tr>
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