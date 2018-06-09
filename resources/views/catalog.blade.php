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
<div class="row">
    <div class="col-md-3">
        <div class="box">
            <div class="box-header">
                <form action="{{ url('catalog') }}" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" name="item" placeholder="Description">
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection()