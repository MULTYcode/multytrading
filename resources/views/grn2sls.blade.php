@extends('dashboard.layout') @section('header')
<h1>Sales
    <small>Trace Good Recieve Note To Sales</small>
</h1>
<ol class="breadcrumb">
    <li>
        <a href="{{route('dashboard')}}">
            <i class="fa fa-dashboard"></i> Home</a>
    </li>
    <li class="active">GRN Periode</li>
</ol>
@endsection() @section('content')
<div class="callout callout-info">
    <h4>Information!</h4>
    <i class="fa fa-hand-o-right"></i> Mencari items berdasarkan keterangan nama, bisa menggunakan kalimat yang mengandung keterangan nama atau biarkan kosong
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <title class="box-title" style="font-weight:normal;">Search GRN By Periode</title>
            </div>
            <div class="box-body">
                <form action="{{ url('grn2slsview') }}" method="POST" style="font-weight:normal;" autocomplete="off">
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
                    <div class="form-group">
                        <input type="text" class="form-control" name="item" placeholder="Description">
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
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    })
</script>
@endsection()