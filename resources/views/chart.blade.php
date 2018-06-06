@extends('dashboard.layout') 
@section('header')
<h1>Dashboard
    <small>Control panel</small>
</h1>
<ol class="breadcrumb">
    <li>
        <a href="{{route('dashboard')}}">
            <i class="fa fa-dashboard"></i> Home</a>
    </li>
    <li class="active">Dashboard</li>
</ol>
@endsection() 
@section('content')
<div class="row">
    <div style="width:75%;">
            {!! $chartjs->render() !!}
    </div>
</div>
@endsection()