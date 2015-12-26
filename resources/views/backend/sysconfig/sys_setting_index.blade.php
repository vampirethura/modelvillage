@extends('layouts.master')

@section('title')
    System Settings | Index
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
      <li class="active">System Settings</li>
      @endif
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">System Settings Summary</h3>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tr>
                <td>Company Logo (Login Screen)</td>
                <td>{{$settings['crm-company-logo']}}</td>
              </tr>
              <tr>
                <td>Company Logo (Header Nav)</td>
                <td>{{$settings['crm-company-logo-sm']}}</td>
              </tr>
              <tr>
                <td>Company Name</td>
                <td>{{$settings['crm-company-name']}}</td>
              </tr>
              <tr>
                <td>Login Background Image</td>
                <td>{{$settings['crm-login-bg-image']}}</td>
              </tr>
              <tr>
                <td>Home URL</td>
                <td>{{$settings['crm-home-url']}}</td>
              </tr>
              <tr>
                <td>Login Title</td>
                <td>{{$settings['crm-login-title']}}</td>
              </tr>
            </table>
          </div>
          <div class="box-footer">

          </div><!-- /.box-footer -->
        </div>
      </div>
      {!! Form::open(['url'=>'/crm/system_setting/1', 'method'=>'PUT', 'files' => true]) !!}
      <div class="col-lg-12 col-md-12 col-sm-12" id="edit_system_settings">
        <div class="box box-success collapsed-box">
          <div class="box-header with-border">
            <h3 class="box-title">Edit System Settings</h3>
            <div class="box-tools pull-right">
              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
            </div><!-- /.box-tools -->
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="form-horizontal">
              <div class="form-group">
                <label for="crm-company-logo_preview" class="col-sm-2 control-label">Company Logo (Login Screen) Preview</label>
                <div class="col-sm-10">
                  <img id="crm-company-logo_preview" src={{$settings['crm-company-logo']}} alt="Company Logo (Login Screen) Preview" class="media-object img-responsive text-center">
                </div>
              </div>
              <div class="form-group">
                <label for="crm-company-logo" class="col-sm-2 control-label">Change Company Logo (Login Screen)</label>
                <div class="col-sm-10">
                  <input type="file" name="crm-company-logo" class="form-control" id="crm-company-logo" onchange="imageUploadPreview(this, '#crm-company-logo_preview');">
                </div>
              </div>
              <div class="form-group">
                <label for="crm-company-logo-sm_preview" class="col-sm-2 control-label">Company Logo (Header Nav) Preview</label>
                <div class="col-sm-10">
                  <img id="crm-company-logo-sm_preview" src={{$settings['crm-company-logo']}} alt="Company Logo (Header Nav) Preview" class="media-object img-responsive text-center">
                </div>
              </div>
              <div class="form-group">
                <label for="crm-company-logo-sm" class="col-sm-2 control-label">Company Logo (Header Nav) (Small)</label>
                <div class="col-sm-10">
                  <input type="file" name="crm-company-logo-sm" class="form-control" id="crm-company-logo-sm" onchange="imageUploadPreview(this, '#crm-company-logo-sm_preview');">
                </div>
              </div>
              <div class="form-group">
                <label for="crm-company-name" class="col-sm-2 control-label">Company Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="crm-company-name" id="crm-company-name" placeholder="Company Name" value="{{$settings['crm-company-name']}}">
                </div>
              </div>
              <div class="form-group">
                <label for="crm-login-bg-image_preview" class="col-sm-2 control-label">Login Background Image Preview</label>
                <div class="col-sm-10">
                  <img id="crm-login-bg-image_preview" src={{$settings['crm-login-bg-image']}} alt="Login Background Image" class="media-object img-responsive text-center">
                </div>
              </div>
              <div class="form-group">
                <label for="crm-login-bg-image" class="col-sm-2 control-label">Company Login Background Image</label>
                <div class="col-sm-10">
                  <input type="file" name="crm-login-bg-image" class="form-control" id="crm-login-bg-image" onchange="imageUploadPreview(this, '#crm-login-bg-image_preview');">
                </div>
              </div>
              <div class="form-group">
                <label for="crm-home-url" class="col-sm-2 control-label">Home URL</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="crm-home-url" id="crm-home-url" placeholder="Home URL" value="{{$settings['crm-home-url']}}">
                </div>
              </div>
              <div class="form-group">
                <label for="crm-login-title" class="col-sm-2 control-label">Login Title</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="crm-login-title" id="crm-login-title" placeholder="Login Title" value="{{$settings['crm-login-title']}}">
                </div>
              </div>
            </div>
          </div><!-- /.box-body -->
          <div class="box-footer">
            <button type="reset" class="btn btn-danger">Reset</button>
            <button type="submit" class="btn btn-info pull-right">Update</button>
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
    <script>
    $(function () {
      checkNotification();
    });
    </script>
    <!-- ================== END PAGE LEVEL JS ================== -->
@stop
