@extends('layouts.master')

@section('title')
    Role | Assign Feature
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
      <li><a href="/crm/{{$module}}">Roles</a></li>
      <li class="active">Assign Feature</li>
      @endif
    </ol>
  </section>
  <section class="content">
    <div class="row">
      {!! Form::open(['url'=>'/crm/' . $module . '/' . $role->id . '/feature_assign', 'method'=>'POST']) !!}
        <div class="col-lg-12 col-md-12 col-sm-12">
          <!-- Horizontal Form -->
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Please Select a Feature to Assign</h3>
              </div><!-- /.box-header -->
              <!-- form start -->
                <div class="box-body">
                  <div class="form-horizontal">
                    <div class="form-group">
                      <label for="feature_id" class="col-sm-2 control-label">Feature Name</label>
                      <div class="col-sm-10">
                        <select name="feature_id" id="feature_id" class="form-control select2" style="width: 100%;">
                          @foreach($features_not_in_role as $feature)
                              @if(old('feature_id') == $feature->id)
                              <option value='{{$feature->id}}'selected>{{$feature->name}}</option>
                              @else
                              <option value='{{$feature->id}}'>{{$feature->name}}</option>
                              @endif
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                  <a href="/crm/{{$module}}/{{$role->id}}" class="btn btn-warning">Cancel</a>
                  <button type="submit" class="btn btn-info pull-right">Assign</button>
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
