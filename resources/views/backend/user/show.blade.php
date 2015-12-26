@extends('layouts.master')

@section('title')
    User Info | View
@stop

@section('css')
    @parent
    <!-- Customs CSS here ... -->
@stop

@section('content')
<div class="content" name="{{$module}}">
  <section class="content-header">
    <h1>
      {{$content_title}}
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li class="active"><a href="/crm/home"><i class="fa fa-home"></i> Home</a></li>
      @if($module != 'home')
      <li><a href="/crm/user">Users</a></li>
      <li class="active">User Information</li>
      @endif
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-3">
        <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="{{$user->display_image}}" alt="User profile picture">
              <h3 class="profile-username text-center">{{$user->display_name}}</h3>
              <p class="text-muted text-center">{{$user->role ? $user->role->name : ""}}</p>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
      </div>
      <div class="col-lg-9 col-md-9 col-sm-9">
        <!-- Horizontal Form -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Details</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
            </div><!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">
                <div class="form-horizontal">
                  <div class="form-group">
                    <label for="username" class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-10">
                      <input type="text" id="username" class="form-control" placeholder="Username" value="{{$user->username}}" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                      <input type="text" id="email" class="form-control" placeholder="Email" value="{{$user->email}}" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="fullname" class="col-sm-2 control-label">Full Name</label>
                    <div class="col-sm-10">
                      <input type="text" id="fullname" class="form-control" placeholder="Full Name" value="{{$user->display_name}}" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="country" class="col-sm-2 control-label">Country</label>
                    <div class="col-sm-10">
                      <input type="text" id="country" class="form-control" placeholder="Country" value="{{App\Country::where('code', $user->country)->first()->name}}" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">About User</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" rows="5" id="description"  readonly>{{$user->about_me}}</textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="activation_status" class="col-sm-2 control-label">Activation Status</label>
                    <div class="col-sm-10">
                      <input type="text" id="activation_status" class="form-control" placeholder="Activation Status" value="{{($user->activation_status == 'A') ? 'Activated' : 'Not Activated'}}" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="last_access" class="col-sm-2 control-label">Last Access</label>
                    <div class="col-sm-10">
                      <input type="text" id="last_access" class="form-control" placeholder="Last Access" value="{{$user->last_access}}" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="created_by" class="col-sm-2 control-label">Created By</label>
                    <div class="col-sm-10">
                      <input type="text" id="created_by" class="form-control" placeholder="Created By" value="{{App\User::find($user->created_by)->username}}" readonly>
                    </div>
                  </div>
                </div>
              </div><!-- /.box-body -->
              <div class="box-footer">
                <a href="/crm/{{$module}}/{{$user->id}}/edit" class="btn btn-warning pull-right">Edit</a>
              </div><!-- /.box-footer -->
          </div><!-- /.box -->
      </div>
    </div>
  </section>
</div>
@stop

@section('javascript') @parent
    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script>
    $(function () {
      checkNotification();
    });
    </script>
    <!-- ================== END PAGE LEVEL JS ================== -->
@stop
