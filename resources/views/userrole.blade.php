@extends('dashboard.layout') @section('header')
<h1>Role
    <small>user</small>
</h1>
<ol class="breadcrumb">
    <li>
        <a href="{{route('dashboard')}}">
            <i class="fa fa-dashboard"></i> Home</a>
    </li>
    <li class="active">Role User</li>
</ol>
@endsection() @section('content')
<div class="callout callout-info">
    <a href="javascript:history.go(-1)">
        <button class="btn btn-primary">
            <i class="fa fa-arrow-left"></i> Back</button>
    </a>
</div>
<div class="row">
    <div class="col-xs-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Aplication Modules</h3>
            </div>
            <div class="box-body" style="width: 100%; overflow: auto; white-space: nowrap;">
                <table id="layout" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>MENU</th>
                            <th>DESCRIPTION</th>
                            <th>ALLOW</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($res as $rows)
                        <tr style="font-weight: normal;">
                            <td>{{$rows->id}}</td>
                            <td>{{$rows->menu}}</td>
                            <td>{{$rows->description}}</td>
                            <td>
                                <a href="{{ route('addmodule',['email'=>$email,'id'=>$rows->id,'userid'=>$userid]) }}">
                                    @if($rows->ada !== NULL)
                                    <button class="btn btn-primary" disabled>Add</button>
                                    @else
                                    <button class="btn btn-primary">Add</button>
                                    @endif
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">User Role</h3>
            </div>
            <div class="box-body" style="width: 100%; overflow: auto; white-space: nowrap;">
                <table id="layout" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>MENU</th>
                            <th>DESCRIPTION</th>
                            <th>REMOVE</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($role as $roles)
                        <tr style="font-weight: normal;">
                            <td>{{$roles->id}}</td>
                            <td>{{$roles->menu}}</td>
                            <td>{{$roles->description}}</td>
                            <td>
                                <a href="{{ route('removemodule',['email'=>$email,'userid'=>$userid,'roleid'=>$roles->id]) }}">
                                    <button class="btn btn-danger">Remove</button>
                                </a>
                            </td>
                        </tr>
                        @endforeach
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