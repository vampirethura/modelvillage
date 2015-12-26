@extends('layouts.master')

@section('title')
    User | Create
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
      <li class="active">Create User</li>
      @endif
    </ol>
  </section>
  <section class="content">
    <div class="row">
      {!! Form::open(['url'=>'/crm/user', 'method'=>'POST', 'files' => true]) !!}
        <div class="col-lg-12 col-md-12 col-sm-12">
          <!-- Horizontal Form -->
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Please Fill the Form</h3>
              </div><!-- /.box-header -->
              <!-- form start -->
                <div class="box-body">
                  <div class="form-horizontal">
                    <div class="form-group">
                      <label for="display_image" class="col-sm-2 control-label">User Photo</label>
                      <div class="col-sm-10">
                        <div style="height:0px;overflow:hidden;"><input type="file" id="display_image" name="display_image" class="image_input" accept="image/*" /></div>
                        <img class="profile-user-img img-circle img-editable" src="/assets/images/generals/image_user_dp_default.png" alt="User profile picture">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="username" class="col-sm-2 control-label">Username</label>
                      <div class="col-sm-10">
                        <input type="text" id="username" class="form-control" placeholder="Username" name="username" value="{{ old('username') }}">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="email" class="col-sm-2 control-label">Email</label>
                      <div class="col-sm-10">
                        <input type="email" id="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="fullname" class="col-sm-2 control-label">Full Name</label>
                      <div class="col-sm-10">
                        <input type="text" id="fullname" class="form-control" placeholder="Full Name" name="display_name" value="{{ old('display_name') }}" >
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="password" class="col-sm-2 control-label">Password</label>
                      <div class="col-sm-10">
                        <input type="password" id="password" class="form-control" placeholder="Password" name="password" >
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="password_confirm" class="col-sm-2 control-label">Retype Password</label>
                      <div class="col-sm-10">
                        <input type="password" id="password_confirm" class="form-control" placeholder="Retype Password" name="password_confirm" >
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="country" class="col-sm-2 control-label">User Country</label>
                      <div class="col-sm-10">
                        <select name="country" id="country" class="form-control select2" style="width: 100%;">
                          @foreach($countries as $country)
                              @if(old('country') == $country->code)
                              <option value='{{$country->code}}'selected>{{$country->name}}</option>
                              @else
                              <option value='{{$country->code}}'>{{$country->name}}</option>
                              @endif
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="language" class="col-sm-2 control-label">User Language</label>
                      <div class="col-sm-10">
                        <select name="language" id="language" class="form-control select2" style="width: 100%;">
                          @foreach($languages as $language)
                              @if(old('language') == $language->language_code)
                              <option value='{{$language->language_code}}' selected>{{$language->language_name}}</option>
                              @else
                              <option value='{{$language->language_code}}'>{{$language->language_name}}</option>
                              @endif
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="activation_status" class="col-sm-2 control-label">Activation Status</label>
                      <div class="col-sm-10">
                        <select name="activation_status" id="activation_status" class="form-control select2" style="width: 100%;">
                          @foreach($activation_status as $status)
                              @if(old('activation_status') == $status->key)
                              <option value='{{$status->key}}' selected>{{$status->value}}</option>
                              @else
                              <option value='{{$status->key}}'>{{$status->value}}</option>
                              @endif
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="role_id" class="col-sm-2 control-label">User Role</label>
                      <div class="col-sm-10">
                        <select name="role_id" id="role_id" class="form-control select2" style="width: 100%;">
                          <option value="0">Not Assigned</option>
                          @foreach($roles as $role)
                              @if(old('role_id') == $role->id)
                              <option value='{{$role->id}}' selected>{{$role->name}}</option>
                              @else
                              <option value='{{$role->id}}'>{{$role->name}}</option>
                              @endif
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="about_me" class="col-sm-2 control-label">About User</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" rows="5" id="about_me" name="about_me" >{{old('about_me')}}</textarea>
                      </div>
                    </div>
                  </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                  <a href="/crm/{{$module}}" class="btn btn-warning">Cancel</a>
                  <a href="/crm/{{$module}}/create" class="btn btn-danger">Reset</a>
                  <button type="submit" class="btn btn-info pull-right">Create</button>
                </div><!-- /.box-footer -->

            </div><!-- /.box -->
        </div>
      {!! Form::close() !!}
    </div>
  </section>
</div>
@stop

@section('javascript') @parent
    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <!-- Select2 -->
    <script src="/plugins/select2/select2.full.min.js"></script>
    <script>
    $(function () {
      checkNotification();
      //Initialize Select2 Elemen
      $(".select2").select2();


    });
    </script>
    <!-- ================== END PAGE LEVEL JS ================== -->
@stop
