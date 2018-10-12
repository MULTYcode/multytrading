@extends('dashboard.layout') @section('header')
<h1>Member
    <small>Transaction</small>
</h1>
<ol class="breadcrumb">
    <li>
        <a href="{{route('dashboard')}}">
            <i class="fa fa-dashboard"></i> Home</a>
    </li>
    <li class="active">Member</li>
</ol>
@endsection() @section('content')
<a href="javascript:history.go(-1)">
    <button class="btn btn-primary">
        <i class="fa fa-arrow-left"></i> Back</button>
</a>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Member Transaction</h3>
            </div>
            <div class="box-body" style="width: 100%; overflow: auto; white-space: nowrap;">
                <table id="layout" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>MEMBER CODE</th>
                            <th>MEMBER NAME</th>
                            <th>TOTAL TRANSACTION</th>
                            <th>TOTAL PCS</th>
                            <th>TOTAL REVENUE</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach($res as $rows)
                        <tr style="font-weight: normal;">
                            <td><a style="text-decoration:underline;" href="{{ route('membertransdetail',['custcode'=>$rows->custcode]) }}">{{
                                    $rows->custcode }}</a></td>
                            <td>{{ $rows->custnama }}</td>
                            <td>{{ number_format($rows->ttrans,0) }}</td>
                            <td>{{ number_format($rows->tpcs,0) }}</td>
                            <td>{{ number_format($rows->tjual,0) }}</td>
                        </tr>
                        @endforeach --}}
                    </tbody>
                    <tfoot>
                        <th>TOTAL</th>
                        <th></th>
                        <th>0</th>
                        <th>0</th>
                        <th>0</th>
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