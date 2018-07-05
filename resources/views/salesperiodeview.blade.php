@extends('dashboard.layout') @section('header')
<h1>Catalog
    <small>Sales Periode</small>
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
<div class="row">
    <div class="col-xs-12">
        <a href="javascript:history.go(-1)">
            <button class="btn btn-primary">
                <i class="fa fa-arrow-left"></i> Back</button>
        </a>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Sales Items</h3>
            </div>
            <div class="box-body" style="width: 100%; overflow: auto; white-space: nowrap;">
                <table id="layout" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>YEAR</th>
                            <th>MONTH</th>
                            <th>CODE</th>
                            <th>DESCRIPTION</th>
                            <th>ARTICLE</th>
                            <th>BRAND</th>
                            <th>CLASS</th>
                            <th>SUBCLASS</th>
                            <th>SIZE</th>
                            <th>COLOUR</th>
                            <th>STORE</th>
                            <th>@COST</th>
                            <th>@PRICE</th>
                            <th>QTTY</th>
                            <th>TOTAL</th>
                            <th>STOCK</th>
                        </tr>    
                    </thead>
                    <tbody>
                         @foreach($res as $rows)
                        <tr style="font-weight: normal;">
                            <td>{{ $rows->tahun }}</td>
                            <td>{{ $rows->bulan }}</td>
                            <td>{{ $rows->bkode }}</td>
                            <td>{{ $rows->bnama }}</td>
                            <td>{{ $rows->artikel }}</td>
                            <td>{{ $rows->brand }}</td>
                            <td>{{ $rows->class }}</td>
                            <td>{{ $rows->subclass }}</td>
                            <td>{{ $rows->size }}</td>
                            <td>{{ $rows->warna }}</td>
                            <td>{{ $rows->store }}</td>
                            <td>{{ number_format($rows->hbeli,0) }}</td>
                            <td>{{ number_format($rows->hjual,0) }}</td>
                            <td>{{ number_format($rows->qty,0) }}</td>
                            <td>{{ number_format($rows->rupiah,0) }}</td>
                            <td>{{ number_format($rows->stok,0) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
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
