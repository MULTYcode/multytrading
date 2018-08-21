@extends('dashboard.layout') @section('header')
<h1>Sales
    <small>Find Sales</small>
</h1>
<ol class="breadcrumb">
    <li>
        <a href="{{route('dashboard')}}">
            <i class="fa fa-dashboard"></i> Home</a>
    </li>
    <li class="active">Sales Search</li>
</ol>

@endsection() @section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <title class="box-title" style="font-weight:normal;">Search Sales Items</title>
            </div>
            <div class="box-body">
                <form action="{{ url('salesfindview') }}" method="POST" style="font-weight:normal;">
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