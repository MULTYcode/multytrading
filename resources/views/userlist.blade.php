@extends('dashboard.layout') @section('header')
<h1>USER
    <small>List</small>
</h1>
<ol class="breadcrumb">
    <li>
        <a href="{{route('dashboard')}}">
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
                        @foreach($res as $rows)
                        <tr style="font-weight: normal;">
                            <td>{{ $rows->name }}</td>
                            <td>{{ $rows->email }}</td>
                            <td>{{ $rows->info }}</td>
                            <td>
                                @if($rows->activated == 'PENDING')
                                <p style="color: #ff0000">{{ $rows->activated }}</p>
                                @else
                                {{ $rows->activated }}
                                @endif
                            </td>
                            <td>
                                @if($rows->verified == 'NO')
                                <p style="color: #ff0000">{{ $rows->verified }}</p>
                                @else
                                {{ $rows->verified }}
                                @endif
                            </td>
                            <td>
                                @if($rows->activated == 'ACTIVE')
                                <a href="{{ route('deactivateuser',['email'=>$rows->email,'jenis'=>0]) }}">
                                    <button class="btn btn-danger">Deactivate</button>
                                </a>
                                @else
                                <a href="{{ route('deactivateuser',['email'=>$rows->email,'jenis'=>1]) }}">
                                    <button class="btn btn-info">Activate</button>
                                </a>
                                @endif
                            <td>
                                <a href="{{ route('userrole',['email'=>$rows->email,'userid'=>$rows->id]) }}">
                                    <button class="btn btn-primary">View Role</button>
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