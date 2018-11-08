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
    <div class="col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Stock Available On Store</h3>
            </div>
            <div class="box-body">
                <table class="table">
                    <tr>
                        <th>STORE</th>
                        <th>STOCK</th>
                    </tr>
                    @foreach($posisi as $posisis)
                    <tr style="font-weight: normal;">
                        <td>{{ $posisis->namagudang }}</td>
                        <td>{{ number_format($posisis->stok,0) }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <th>TOTAL</th>
                        <td>{{ number_format($tpcs,0) }}</td>
                        </th>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection()