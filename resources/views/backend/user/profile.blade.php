@extends('layouts.master')

@section('title')
    Profile | Index
@stop

@section('css')
    @parent
    <!-- Customs CSS here ... -->
@stop

@section('content')
  <section class="content-header">
    <h1>
      {{$content_title}}
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="/crm/home"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Profile</li>
    </ol>
  </section>

  <!-- Horizontal Form -->
  <section class="content">
    <div class="row">
      <div class="col-md-8">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Edit Profile</h3>
          </div><!-- /.box-header -->
          <!-- form start -->
          <form action="/crm/profile/update" method="post" enctype="multipart/form-data" class="form-horizontal" id="profile_image_upload_form" autocomplete="off">
            <div class="box-body">
              <div class="form-group">
                <label for="profile_preview" class="col-sm-2 control-label">Preview</label>
                <div class="col-sm-10">
                  <img id="profile_preview" src={{$user_info['display_image']}} alt="display image" class="media-object img-responsive text-center">
                  <input type="hidden" name="id" value="{{$user_info['id']}}">
                  <input type="hidden" name="orignal_image" value="{{$user_info['display_image']}}">
                </div>
              </div>
              <div class="form-group">
                <label for="display_image" class="col-sm-2 control-label">Change Photo</label>
                <div class="col-sm-10">
                  <input type="file" name="display_image" class="form-control" id="display_image">
                </div>
              </div>
              <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" id="email" placeholder="Email" value="{{$user_info['email']}}">
                </div>
              </div>
              <div class="form-group">
                <label for="display_name" class="col-sm-2 control-label">Display Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="display_name" id="display_name" placeholder="Display Name" value="{{$user_info['display_name']}}">
                </div>
              </div>
              <div class="form-group">
                <label for="country" class="col-sm-2 control-label">User Country</label>
                <div class="col-sm-10">
                  <select name="country" id="country" class="form-control select2" style="width: 100%;">
                    @foreach($countries as $country)
                        @if($country->code == $user_info['country'])
                        <option value='{{$country->code}}' selected>{{$country->name}}</option>
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
                        @if($language->language_code == $user_info['language'])
                        <option value='{{$language->language_code}}' selected>{{$language->language_name}}</option>
                        @else
                        <option value='{{$language->language_code}}'>{{$language->language_name}}</option>
                        @endif
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="about_me" class="col-sm-2 control-label">Profile Description</label>
                <div class="col-sm-10">
                  <textarea rows="5" placeholder="About User" name="about_me" class="form-control" id="about_me" placeholder="About User">{{$user_info['about_me']}}</textarea>
                </div>
              </div>
            </div><!-- /.box-body -->
            <div class="box-footer">
              <a href="/crm/home" class="btn btn-warning">Cancel</a>
              <a href="#" id="btn_change_psw" class="btn btn-success">Change Password</a>
              <button type="submit" class="btn btn-info pull-right">Update</button>
            </div><!-- /.box-footer -->
          </form>
        </div><!-- /.box -->
        <div id="changePasswordModal" class="modal modal-success">
          <div class="modal-dialog">
            <div class="modal-content">
              <form action="/crm/user/change_password" method="post">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Change Password</h4>
                </div>
                <div class="modal-body">
                  <input type="hidden" name="user_id" value="{{$user_info['id']}}">
                  <input class="form-control m-b-10" type="password" id="current_password" name="current_password" placeholder="Enter the current password" required />

                  <input class="form-control m-b-10" type="password" id="new_password" name="new_password" placeholder="Enter the new password" required />

                  <input class="form-control m-b-10" type="password" id="new_password_retype" name="new_password_retype" placeholder="Re-enter the new Password" required />
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-outline">Change</button>
                </div>
            </form>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
      </div>
    </div>
  </section>
@stop

@section('javascript') @parent
    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <!-- Select2 -->
    <script src="/plugins/select2/select2.full.min.js"></script>

    <script>
    $(function () {
      //Initialize Select2 Elements
      $(".select2").select2();
      checkNotification();
      $('#btn_change_psw').on('click', function(e){
        e.preventDefault();
        $('#changePasswordModal').modal({show:true});
      });
    });
    </script>
    <!-- ================== END PAGE LEVEL JS ================== -->
@stop
