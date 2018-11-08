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
        <i class="fa fa-hand-o-right"></i> Find item base on their descriptions, descriptions can be contains word or leave it empty
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <title class="box-title" style="font-weight:normal;">Filter and Find Product Items</title>
            </div>
            <div class="box-body">
                <form action="{{ url('catalog') }}" method="POST" style="font-weight:normal;">
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

@endsection()