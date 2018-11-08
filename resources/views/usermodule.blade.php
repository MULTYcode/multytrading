@extends('dashboard.layout') @section('header')
<h1>Module
    <small>user</small>
</h1>
<ol class="breadcrumb">
    <li>
        <a href="{{route('dashboard')}}">
            <i class="fa fa-dashboard"></i> Home</a>
    </li>
    <li class="active">Module User</li>
</ol>
@endsection() @section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Module of application</h3>
            </div>
            <div class="box-body" style="width: 100%; overflow: auto; white-space: nowrap;">
                <table id="layout" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>MAIN</th>
                            <th>SUB</th>
                            <th>SUB TYPE</th>
                            <th>SUB ORDER</th>
                            <th>ROUTE</th>
                            <th>ROUTE ACTION</th>
                            <th>ICON</th>
                            <th>DESCRIPTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($res as $rows)
                            <tr style="font-weight: normal;">
                                <td>{{$rows->id}}</td>
                                <td>{{$rows->main}}</td>
                                <td>{{$rows->sub}}</td>
                                <td>{{$rows->sub_type}}</td>
                                <td>{{$rows->sub_order}}</td>
                                <td>{{$rows->route}}</td>
                                <td>{{$rows->route_action}}</td>
                                <td>{{$rows->icon}}</td>
                                <td>{{$rows->description}}</td>
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