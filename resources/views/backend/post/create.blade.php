@extends('layouts.master')

@section('title')
    Post | Create
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
      <li><a href="/crm/{{$module}}">Posts</a></li>
      <li class="active">Create Post</li>
      @endif
    </ol>
  </section>
  <section class="content">
    <div class="row">
      {!! Form::open(['url'=>'/crm/' . $module, 'method'=>'POST', 'files' => true]) !!}
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
                      <label for="description" class="col-sm-2 control-label">Post Description</label>
                      <div class="col-sm-10">
                        <input type="text" id="description" class="form-control" placeholder="Post Description" name="description" value="{{ old('description') }}" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="photo" class="col-sm-2 control-label">Post Photo</label>
                      <div class="col-sm-10">
                        <div style="height:0px;overflow:hidden;"><input type="file" id="photo" name="photo" class="image_input" accept="image/*" required/></div>
                        <img class="img-editable img-responsive" src="/assets/images/generals/image_user_dp_default.png" alt="Post Photo">
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
    <script>
    $(function () {
      checkNotification();
    });
    </script>
    <!-- ================== END PAGE LEVEL JS ================== -->
@stop
