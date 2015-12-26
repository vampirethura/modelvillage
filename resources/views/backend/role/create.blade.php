@extends('layouts.master')

@section('title')
    Role | Create
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
      <li class="active">Create Role</li>
      @endif
    </ol>
  </section>
  <section class="content">
    <div class="row">
      {!! Form::open(['url'=>'/crm/' . $module, 'method'=>'POST']) !!}
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
                      <label for="name" class="col-sm-2 control-label">Role Name</label>
                      <div class="col-sm-10">
                        <input type="text" id="name" class="form-control" placeholder="Role Name" name="name" value="{{ old('name') }}" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="descr" class="col-sm-2 control-label">Role Description</label>
                      <div class="col-sm-10">
                        <input type="text" id="descr" class="form-control" placeholder="Role Description" name="descr" value="{{ old('descr') }}" required>
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
