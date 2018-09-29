@extends('dashboard.layout') @section('header')
<h1>Sales
    <small>Sales By Category</small>
</h1>
<ol class="breadcrumb">
    <li>
        <a href="{{route('dashboard')}}">
            <i class="fa fa-dashboard"></i> Home</a>
    </li>
    <li class="active">Sales Category</li>
</ol>
@endsection() @section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">SALES BY CATEGORY</h3>
            </div>
            <div class="box-body">
                <div class="chart">
                    <div style="height:auto;">
                        {!! $chartcategory->render() !!}
                    </div>
                </div>
            </div>
            <div class="box-body" style="width: 100%; overflow: auto; white-space: nowrap;">
                <table id="layout" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>CATEGORY</th>
                            <th>TOTAL PCS</th>
                            <th>TOTAL PRICE</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($category as $rows)
                        <tr style="font-weight: normal;">
                            <td><a href="{{ route('subcategory',['category'=>$rows->categori]) }}">{{ $rows->categori }}</a></td>
                            <td>{{ number_format($rows->pcs,0) }}</td>
                            <td>{{ number_format($rows->total,0) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <th>TOTAL</th>
                        <th>{{number_format($tpcs,0)}}</th>
                        <th>{{number_format($tjual,0)}}</th>
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