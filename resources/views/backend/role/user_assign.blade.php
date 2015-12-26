@extends('layouts.master')

@section('title')
    Role | Assign User
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
      <li class="active">Assign User</li>
      @endif
    </ol>
  </section>
  <section class="content">
    <div class="row">
      {!! Form::open(['url'=>'/crm/' . $module . '/' . $role->id . '/user_assign', 'method'=>'POST']) !!}
        <div class="col-lg-12 col-md-12 col-sm-12">
          <!-- Horizontal Form -->
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Please Select a User to Assign</h3>
              </div><!-- /.box-header -->
              <!-- form start -->
                <div class="box-body">
                  <div class="form-horizontal">
                    <div class="form-group">
                      <label for="user_id" class="col-sm-2 control-label">User</label>
                      <div class="col-sm-10">
                        <select name="user_id" id="user_id" class="form-control select2" style="width: 100%;" required>
                          @foreach($not_assigned_users as $user)
                              @if(old('user_id') == $user->id)
                              <option value='{{$user->id}}'selected>{{$user->username}} - {{$user->email}}</option>
                              @else
                              <option value='{{$user->id}}'>{{$user->username}} - {{$user->email}}</option>
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
