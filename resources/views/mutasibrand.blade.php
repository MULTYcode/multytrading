@extends('dashboard.layout') @section('header')
<h1>Mutasi
    <small>Summery Mutasi</small>
</h1>
<ol class="breadcrumb">
    <li>
        <a href="{{route('dashboard')}}">
            <i class="fa fa-dashboard"></i> Home</a>
    </li>
    <li class="active">Mutasi Brand</li>
</ol>
@endsection() @section('content')
<div class="callout callout-info">
    <h4>Information!</h4>
    <i class="fa fa-hand-o-right"></i> Summery mutasi by brand
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <title class="box-title" style="font-weight:normal;">Summery Mutasi By Brand By Periode</title>
            </div>
            <div class="box-body">
                <form action="{{ url('mutasibrandview') }}" method="POST" style="font-weight:normal;">
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
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    })
</script>
@endsection()