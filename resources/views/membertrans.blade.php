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
<div class="callout callout-info">
    <h4>Information!</h4>
    <i class="fa fa-hand-o-right"></i> Transaksi Member
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <title class="box-title" style="font-weight:normal;">Search Member Transaction By Periode</title>
            </div>
            <div class="box-body">
                <form action="{{ url('membertransview') }}" method="POST" style="font-weight:normal;" autocomplete="off">
                    <div class="form-group">
                        <label>From Date :</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input data-date-format="yyyy-mm-dd" type="text" class="form-control pull-right" id="datefrom" name="datefrom">
                        </div>
                        <label>To Date :</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input data-date-format="yyyy-mm-dd" type="text" class="form-control pull-right" id="dateto" name="dateto">
                        </div>
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button class="btn btn-primary">Search</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('#datefrom').datepicker()
        $('#dateto').datepicker()
    })
</script>
@endsection()