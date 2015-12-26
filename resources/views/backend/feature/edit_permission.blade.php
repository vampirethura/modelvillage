@extends('layouts.master')

@section('title')
    Permission | Edit
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
      <li class="active">Edit Permission</li>
      @endif
    </ol>
  </section>
  <section class="content">
    <div class="row">
      {!! Form::open(['url'=>'/crm/feature/'.$feature->id.'/permission/'.$permission->id, 'method'=>'PUT', 'class'=>'form-horizontal']) !!}
      <div class="col-lg-12 col-md-12 col-sm-12">
        <!-- Horizontal Form -->
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Edit Feature's Permission</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="form-horizontal">
              <input type="hidden" name="feature_id" value="{{$feature->id}}">
              <input type="hidden" name="module" value="{{$feature->module}}">
              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                  <input type="text" id="name" class="form-control" placeholder="Permission name should be lower case without space (eg: get_data)" name="name" value="{{$permission->name}}" required>
                </div>
              </div>
              <div class="form-group">
                <label for="label" class="col-sm-2 control-label">Label</label>
                <div class="col-sm-10">
                  <input type="text" id="label" class="form-control" placeholder="Label of permission" name="descr" value="{{$permission->descr}}">
                </div>
              </div>
              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Position</label>
                <div class="col-sm-10">
                  <input type="text" id="position" class="form-control" placeholder="Position to appear" name="position" value="{{$permission->position}}" autocomplete="off" required>
                </div>
              </div>
              <div class="form-group">
                <label for="url" class="col-sm-2 control-label">URL</label>
                <div class="col-sm-10">
                  <input type="text" id="url" class="form-control" placeholder="URL (eg: /crm/customer/get_data)" name="url" value="{{$permission->url}}" required>
                </div>
              </div>
              <div class="form-group">
                <label for="icon" class="col-sm-2 control-label">Icon&nbsp <i id="icon_preview"></i></label>
                <div class="col-sm-10">
                  <select name="icon" id="icon" class="form-control select2" style="width: 100%;">
                    <option>None</option>
                    @foreach($icons as $icon)
                        @if($icon->key == $permission->icon)
                        <option value='{{$icon->key}}'selected>{{$icon->value}}</option>
                        @else
                        <option value='{{$icon->key}}'>{{$icon->value}}</option>
                        @endif
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="icon_bg" class="col-sm-2 control-label">Icon Background&nbsp <i id="icon_bg_preview">&nbsp;&nbsp;&nbsp;&nbsp;</i></label>
                <div class="col-sm-10">
                  <select name="icon_bg" id="icon_bg" class="form-control select2" style="width: 100%;">
                    <option>None</option>
                    @foreach($icon_bgs as $icon_bg)
                        @if($icon_bg->key == $permission->icon_bg)
                        <option value='{{$icon_bg->key}}'selected>{{$icon_bg->value}}</option>
                        @else
                        <option value='{{$icon_bg->key}}'>{{$icon_bg->value}}</option>
                        @endif
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="page" class="col-sm-2 control-label">Render's Page</label>
                <div class="col-sm-10">
                  <input type="text" id="page" class="form-control" placeholder="Render's Page" name="page" value="{{$permission->page}}" autocomplete="off" required>
                </div>
              </div>
              <div class="form-group">
                <label for="prompt_type" class="col-sm-2 control-label">Prompt's Type</label>
                <div class="col-sm-10">
                  <input type="text" id="prompt_type" class="form-control" placeholder="Prompt Type" name="prompt_type" value="{{$permission->prompt_type}}" autocomplete="off" required>
                </div>
              </div>
              <div class="form-group">
                <label for="prompt_title" class="col-sm-2 control-label">Prompt's Title</label>
                <div class="col-sm-10">
                  <input type="text" id="prompt_title" class="form-control" placeholder="Leave blank if prompt type is none." name="prompt_title" value="{{$permission->prompt_title}}">
                </div>
              </div>
              <div class="form-group">
                <label for="prompt_content" class="col-sm-2 control-label">Prompt's Content</label>
                <div class="col-sm-10">
                  <input type="text" id="prompt_content" class="form-control" placeholder="Leave blank if prompt type is none." name="prompt_content" value="{{$permission->prompt_content}}">
                </div>
              </div>
            </div>
          </div><!-- /.box-body -->
          <div class="box-footer">
            <a href="/crm/{{$module}}/{{$feature->id}}" class="btn btn-warning">Cancel</a>
            <button type="submit" class="btn btn-info pull-right">Update</button>
          </div><!-- /.box-footer -->
        </div>
      </div>
      {!! Form::close() !!}
    </div>
  </section>
</div>
@stop

@section('javascript') @parent
    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <!-- iCheck 1.0.1 -->
    <script src="/plugins/typeahead/bootstrap3-typeahead.min.js"></script>

    <script>
    $(function () {
      checkNotification();
      //create an auto complete for access control
      var autocomplete_permission_position = [
          @foreach($all_positions as $curr_pos)
              "{{$curr_pos->position}}",
          @endforeach
      ];
      $('#position').typeahead({
          source: autocomplete_permission_position
      });

      //create autocomplete for page
      var autocomplete_page = [
          @foreach($all_pages as $page)
              "{{$page->page}}",
          @endforeach
      ];
      $('#page').typeahead({
          source: autocomplete_page
      });

      //prompt type autocomplete
      var autocomplete_prompt_type = [
          @foreach($all_prompt_types as $ptype)
              "{{$ptype->prompt_type}}",
          @endforeach
      ];
      $('#prompt_type').typeahead({
          source: autocomplete_prompt_type
      });

      reloadIconPreview();
      reloadIconBgPreview();
      $('#icon').on('change', function(){
        reloadIconPreview();
      });
      $('#icon_bg').on('change', function(){
        reloadIconBgPreview();
      });
    });

    function reloadIconPreview(){
      $('#icon_preview').removeClass($("#icon_preview").attr('class'));
      $('#icon_preview').addClass('fa ' + $("#icon").val());
    }

    function reloadIconBgPreview(){
      $('#icon_bg_preview').removeClass($("#icon_bg_preview").attr('class'));
      $('#icon_bg_preview').addClass($("#icon_bg").val());
    }
    </script>
    <!-- ================== END PAGE LEVEL JS ================== -->
@stop
