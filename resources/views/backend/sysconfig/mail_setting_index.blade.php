@extends('layouts.master')

@section('title')
    Mail Settings | Index
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
      <li class="active">Mail Settings</li>
      @endif
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Mail Settings Summary</h3>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              @foreach($mail_settings as $mail_setting)
              <tr>
                <td>{{$mail_setting->label}}</td>
                <td>{{$mail_setting->value}}</td>
              </tr>
              @endforeach
            </table>
          </div>
          <div class="box-footer">

          </div><!-- /.box-footer -->
        </div>
      </div>
      {!! Form::open(['url'=>'/crm/mail_setting/1', 'method'=>'PUT', 'files' => true]) !!}
      <div class="col-lg-12 col-md-12 col-sm-12" id="edit_mail_settings">
        <div class="box box-success collapsed-box">
          <div class="box-header with-border">
            <h3 class="box-title">Edit Mail Settings</h3>
            <div class="box-tools pull-right">
              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
            </div><!-- /.box-tools -->
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="form-horizontal">
              @foreach($mail_settings as $mail_setting)
              <div class="form-group">
                <label for="{{$mail_setting->key}}" class="col-sm-2 control-label">{{$mail_setting->label}}</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="{{$mail_setting->key}}" id="{{$mail_setting->key}}" placeholder="{{$mail_setting->label}}" value="{{$mail_setting->value}}">
                </div>
              </div>
              @endforeach
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
