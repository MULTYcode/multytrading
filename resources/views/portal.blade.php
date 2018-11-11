@extends('dashboard.layout') @section('header')
<h1>USER
    <small>List</small>
</h1>
<ol class="breadcrumb">
    <li>
        <a href="{{route('home')}}">
            <i class="fa fa-dashboard"></i> Home</a>
    </li>
    <li class="active">User List</li>
</ol>
@endsection() @section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">List of User</h3>
            </div>
            <div class="box-body" style="width: 100%; overflow: auto; white-space: nowrap;">
                <table id="layout" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>NAME</th>
                            <th>EMAIL</th>
                            <th>INFO</th>
                            <th>ACTIVATED</th>
                            <th>EMAIL VERIFIED</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
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