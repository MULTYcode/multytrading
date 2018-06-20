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
@endsection() @section('content')
<div class="row">
    <div class="col-md-6">
        <a href="javascript:history.go(-1)">
            <button class="btn btn-primary">
                <i class="fa fa-arrow-left"></i> Back</button>
        </a>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Sales Items</h3>
            </div>
            <div class="box-body">
                <table class="table">
                    <tr>
                        <th>STORE</th>
                        <th>DATE</th>
                        <th>QTY</th>
                        <th>TOTAL</th>
                    </tr>
                    @foreach($res as $rows)
                    <tr style="font-weight: normal;">
                        <td>{{ $rows->store }}</td>
                        <td>{{ $rows->sitgl }}</td>
                        <td>{{ number_format($rows->pcs,0) }}</td>
                        <td>{{ number_format($rows->rupiah,0) }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <th>TOTAL</th>
                        <th></th>
                        <th>{{ number_format($tpcs,0) }}</th>
                        <th>{{ number_format($ttotal,0) }}</th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection()