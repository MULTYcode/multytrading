@extends('dashboard.layout') @section('header')
<h1>Sales
    <small>Sales by brand</small>
</h1>
<ol class="breadcrumb">
    <li>
        <a href="{{route('dashboard')}}">
            <i class="fa fa-dashboard"></i> Home</a>
    </li>
    <li class="active">Sales by brand</li>
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
                <h3 class="box-title">Sales "{{$store}}" from "{{$datefrom}}" to "{{$dateto}}"</h3>
            </div>
            <div class="box-body" style="width: 100%; overflow: auto; white-space: nowrap;">
                <table id="layout" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>BRAND</th>
                            <th>QTTY</th>
                            <th>TOTAL</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($res as $rows)
                        <tr style="font-weight: normal;">
                            <td>
                                <a href="{{ route('getstore',['brand'=>$rows->brand,'datefrom'=>$datefrom,'dateto'=>$dateto]) }}">{{ $rows->brand }}</a>
                            </td>
                            <td>{{ number_format($rows->pcs,0) }}</td>
                            <td>{{ number_format($rows->total_jual,0) }}</td>
                            <td>
                                @if($store=="")
                                <a href="{{ route('getsalesitems',['store'=>'ALL','brand'=>$rows->brand,'datefrom'=>$datefrom,'dateto'=>$dateto]) }}">
                                    <button class="btn btn-primary">View items</button>
                                </a>
                                @else
                                <a href="{{ route('getsalesitems',['store'=>$store,'brand'=>$rows->brand,'datefrom'=>$datefrom,'dateto'=>$dateto]) }}">
                                    <button class="btn btn-primary">View items</button>
                                </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <th>TOTAL</th>
                        <th>{{number_format($tpcs,0)}}</th>
                        <th>{{number_format($tjual,0)}}</th>
                        <th></th>
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