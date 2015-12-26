@extends('layouts.master')

@section('title')
    Feature | Edit
@stop

@section('css')
    @parent
    <!-- Customs CSS here ... -->
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="/plugins/iCheck/all.css">
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
      <li><a href="/crm/{{$module}}">Feature</a></li>
      <li class="active">Edit Feature</li>
      @endif
    </ol>
  </section>
  <section class="content">
    <div class="row">
      {!! Form::open(['url'=>'/crm/' . $module . '/' . $feature->id, 'method'=>'PUT']) !!}
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
                      <label for="group" class="col-sm-2 control-label">Feature Group</label>
                      <div class="col-sm-10">
                        <input type="text" id="group" class="form-control" placeholder="Feature Group (Optional)" name="group" value="{{ $feature->group }}">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="group_icon" class="col-sm-2 control-label">Group Icon&nbsp <i id="group_icon_preview">&nbsp;&nbsp;&nbsp;&nbsp;</i></label>
                      <div class="col-sm-10">
                        <select name="group_icon" id="group_icon" class="form-control select2" style="width: 100%;">
                          @foreach($icons as $icon)
                              @if($feature->group_icon == $icon->key)
                              <option value='{{$icon->key}}'selected>{{$icon->value}}</option>
                              @else
                              <option value='{{$icon->key}}'>{{$icon->value}}</option>
                              @endif
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="name" class="col-sm-2 control-label">Feature Name</label>
                      <div class="col-sm-10">
                        <input type="text" id="name" class="form-control" placeholder="Feature Name" name="name" value="{{ $feature->name }}" >
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="module" class="col-sm-2 control-label">Module Name</label>
                      <div class="col-sm-10">
                        <input type="text" id="module" class="form-control" placeholder="Module Name (Must be unique)" name="module" value="{{ $feature->module }}">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="descr" class="col-sm-2 control-label">Label</label>
                      <div class="col-sm-10">
                        <input type="text" id="descr" class="form-control" placeholder="Description" name="descr" value="{{ $feature->descr }}" >
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="icon" class="col-sm-2 control-label">Feature's Icon&nbsp <i id="feature_icon_preview">&nbsp;&nbsp;&nbsp;&nbsp;</i></label>
                      <div class="col-sm-10">
                        <select name="icon" id="icon" class="form-control select2" style="width: 100%;">
                          @foreach($icons as $icon)
                              @if($feature->icon == $icon->key)
                              <option value='{{$icon->key}}'selected>{{$icon->value}}</option>
                              @else
                              <option value='{{$icon->key}}'>{{$icon->value}}</option>
                              @endif
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="url" class="col-sm-2 control-label">URL</label>
                      <div class="col-sm-10">
                        <input type="text" id="url" class="form-control" placeholder="Module URL" name="url" value="{{ $feature->url }}">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="url" class="col-sm-2 control-label">Others</label>
                      <div class="col-sm-10 ui-sortable">
                          <label class="checkbox-inline">
                            <input name="display" type="hidden" value="0">
                            <input type="checkbox" name="display" value="1" class="minimal" {{$feature->display == '1' ? "checked" : ""}}>
                            Show
                          </label>
                          <label class="checkbox-inline">
                            <input name="admin" type="hidden" value="0">
                            <input type="checkbox" name="admin" value="1" class="minimal" {{$feature->admin == '1' ? "checked" : ""}}>
                            Admin
                          </label>
                          <label class="checkbox-inline">
                            <input name="crud" type="hidden" value="{{$feature->crud}}">
                            <input type="checkbox" name="crud" value="1" class="minimal" {{$feature->crud == '1' ? "checked" : ""}} disabled>
                            CRUD
                          </label>
                      </div>
                    </div>
                  </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                  <a href="/crm/{{$module}}" class="btn btn-warning">Cancel</a>
                  <a href="/crm/{{$module}}/{{$feature->id}}/edit" class="btn btn-danger">Reset</a>
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
    <!-- Select2 -->
    <script src="/plugins/select2/select2.full.min.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="/plugins/iCheck/icheck.min.js"></script>
    <script>
    $(function () {
      checkNotification();
      //Initialize Select2 Elemen
      $(".select2").select2();

      //iCheck for checkbox and radio inputs
      $('input[type="checkbox"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-red'
      });

      reloadGroupIconPreview();
      reloadFeatureIconPreview();
      $('#group_icon').on('change', function(){
        reloadGroupIconPreview();
      });
      $('#icon').on('change', function(){
        reloadFeatureIconPreview();
      });

    });

    function reloadGroupIconPreview(){
      $('#group_icon_preview').removeClass($("#group_icon_preview").attr('class'));
      $('#group_icon_preview').addClass('fa ' + $("#group_icon").val());
    }

    function reloadFeatureIconPreview(){
      $('#feature_icon_preview').removeClass($("#feature_icon_preview").attr('class'));
      $('#feature_icon_preview').addClass('fa ' + $("#icon").val());
    }
    </script>
    <!-- ================== END PAGE LEVEL JS ================== -->
@stop
