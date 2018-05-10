@extends('dashboard.layout') @section('header')
<h1>User
  <small>profile</small>
</h1>
<ol class="breadcrumb">
  <li>
    <a href="{{route('dashboard')}}">
      <i class="fa fa-dashboard"></i> Home</a>
  </li>
  <li class="active">Profile</li>
</ol>
@endsection() @section('content')
<div class="row">
  <div class="col-md-3">

    <!-- Profile Image -->
    <div class="box box-primary">
      <div class="box-body box-profile">
        <img class="profile-user-img img-responsive img-circle" src="/uploads/avatars/{{ Auth::user()->image }}" alt="User profile picture">
        <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>
        <p class="text-muted text-center">Software Engineer</p>
        <form enctype="multipart/form-data" action="/updateavatar" method="POST">
          <input type="submit" class="btn btn-primary btn-block" value="Change Avatar">
          <br>
          <input type="file" name="avatar">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </form>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
  <div class="col-md-9">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active">
          <a href="#profile" data-toggle="tab">Profile</a>
        </li>
        <li>
          <a href="#edit-profile" data-toggle="tab">Edit Profile</a>
        </li>
      </ul>
      <div class="tab-content">
        <div class="active tab-pane" id="profile">
          <div class="post">

            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Basic informations</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body no-padding">
                <table class="table table-condensed">
                  <tr>
                    <td style="width: 100px">
                      <span class="label label-primary">Name</span>
                    </td>
                    <td>{{ Auth::user()->name }}</td>
                  </tr>
                  <tr>
                    <td style="width: 100px">
                      <span class="label label-primary">Email</span>
                    </td>
                    <td>{{ Auth::user()->email }}</td>
                  </tr>
                  <tr>
                    <td style="width: 100px">
                      <span class="label label-primary">Skills</span>
                    </td>
                    <td>{{ Auth::user()->skill }}</td>
                  </tr>
                  <tr>
                    <td style="width: 100px">
                      <span class="label label-primary">More info</span>
                    </td>
                    <td>{{ Auth::user()->info }}</td>
                  </tr>
                </table>
              </div>
              <!-- /.box-body -->
            </div>

          </div>
        </div>
        <div class="tab-pane" id="edit-profile">
          <form class="form-horizontal" enctype="multipart/form-data" action="/updateprofile" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
              <label for="inputName" class="col-sm-2 control-label">Name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="inputName" value="{{ Auth::user()->name }}">
              </div>
            </div>
            {{--  <div class="form-group">
              <label for="inputEmail" class="col-sm-2 control-label">Email</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" name="inputEmail" placeholder="{{ Auth::user()->email }}">
              </div>
            </div>  --}}
            <div class="form-group">
              <label for="inputSkill" class="col-sm-2 control-label">Skill</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="inputSkill" value="{{ Auth::user()->skill }}">
              </div>
            </div>
            <div class="form-group">
              <label for="inputInfo" class="col-sm-2 control-label">More info</label>
              <div class="col-sm-10">
                <textarea class="form-control" name="inputInfo">{{ Auth::user()->info }}</textarea>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-danger">Submit</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- /.nav-tabs-custom -->
  </div>
  <!-- /.col -->
</div>
@endsection()