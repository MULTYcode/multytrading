@extends('dashboard.layout') @section('header')
<h1>Catalog
    <small>View Product Catalog</small>
</h1>
<ol class="breadcrumb">
    <li>
        <a href="{{route('dashboard')}}">
            <i class="fa fa-dashboard"></i> Home</a>
    </li>
    <li class="active">Catalog</li>
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
                <h3 class="box-title">Product Items</h3>
            </div>
            <div class="box-body">
                <table id="layout" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>BARCODE</th>
                            <th>DESCRIPTION</th>
                            <th>BRAND</th>
                            <th>CLASS</th>
                            <th>SUBCLASS</th>
                            <th>SIZE</th>
                            <th>COLOUR</th>
                            <th>PRICE</th>
                            <th>STOCK</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($item as $items)
                        <tr style="font-weight: normal;">
                            <td>
                                <a href="{{ route('catalogstore',['kode'=>$items->kode]) }}">{{ $items->kode }}</a>
                            </td>
                            <td>{{ $items->nama }}</td>
                            <td>{{ $items->brand }}</td>
                            <td>{{ $items->class }}</td>
                            <td>{{ $items->subclass }}</td>
                            <td>{{ $items->size }}</td>
                            <td>{{ $items->warna }}</td>
                            <td>{{ number_format($items->hjual,0) }}</td>
                            <td>{{ number_format($items->stock,0) }}</td>
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
                        <th>
                        <td>{{ number_format($tstock,0) }}</td>
                        </th>
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