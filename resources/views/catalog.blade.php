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
    <h4>Information!</h4>
    <i class="fa fa-hand-o-right"></i> Find catalog items
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <title class="box-title" style="font-weight:normal;">Search items</title>
            </div>
            <div class="box-body">
                <form action="{{ url('catalogview') }}" method="POST" style="font-weight:normal;">
                    <div class="form-group">
                        <input type="text" class="form-control" name="item" placeholder="Description">
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button class="btn btn-primary">Find</button>
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