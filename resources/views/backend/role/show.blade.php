@extends('layouts.master')

@section('title')
    Role | Detail
@stop

@section('css')
    @parent
    <!-- Customs CSS here ... -->
    <link href="/plugins/switchery/switchery.min.css" rel="stylesheet" />
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
      <li class="active">Role Details</li>
      @endif
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="box box-success">
          <div class="box-body">
            {{ Render::panelButtons('panel-default', Session::get('permissions')[$module], $actions['panel-default'], ['[RID]'=>$role->id]) }}
            {{ Render::panelButtons('panel-with-modal-delete',Session::get('permissions')[$module], $actions['panel-with-modal-delete'], ['[RID]'=>$role->id]) }}
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Role's Details</h3>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tr>
                <th>Name</th>
                <td>{{$role->name}}</td>
              </tr>
              <tr>
                <th>Description</th>
                <td>{{$role->descr}}</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Role's Assigned Users</h3>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Username</th>
                  <th>Full name</th>
                  <th>Email</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($role->users as $user)
                <tr>
                  <td>{{$user->username}}</td>
                  <td>{{$user->display_name}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{ Render::tableButtons(Session::get('permissions')['role'], $actions['user_table'], array( "[UID]" => $user->id, "[RID]"=>$role->id )) }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Assigned Features</h3>
          </div><!-- /.box-header -->
          {!! Form::open(['url'=>'/crm/role/'.$role->id.'/permission_assign', 'method'=>'POST', 'class'=>'form-horizontal', 'data-parsley-validate'=>"true"]) !!}
          <div class="box-body">
            @foreach($role->features as $feature)
            <div class="row">
              <div class="col-md-12">
                <div class="box box-warning collapsed-box">
                  <div class="box-header with-border">
                    <h3 class="box-title">{{$feature->name}}</h3>
                    <div class="box-tools pull-right">
                      <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <a href="/crm/role/{{$role->id}}/feature/{{$feature->id}}/remove" class="btn btn-danger removal-modal" title="Delete Feature" data-title="Delete Feature" data-content="Are you sure you want to delete this feature from this role?" onClick="return false;">Remove</a>
                          <button class="btn btn-success" data-widget="collapse"><i class="fa fa-plus"></i></button>&nbsp
                        </div>
                      </div>
                    </div><!-- /.box-tools -->
                  </div><!-- /.box-header -->
                  <div class="box-body">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Description</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($feature->permissions as $permission)
                        <tr>
                          <td>{{$permission->name}}</td>
                          <td>{{$permission->descr}}</td>
                          <td>
                            <input type="hidden" name="permissions[]" value="{{$permission->id}}">
                            <input type="hidden" name="permission_status_{{$permission->id}}" value="off">
                            <input type="checkbox" name="permission_status_{{$permission->id}}" data-render="switchery" data-theme="blue"  data-switchery="true" {{in_array($permission->id, $permission_ids) ? "checked" : ""}}/>
                          </td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                  </div><!-- /.box-body -->
                </div><!-- /.box -->
              </div><!-- /.col -->
            </div><!-- /.row -->
            @endforeach
          </div>
          @if(count($role->features) > 0)
          <div class="box-footer">
            <button type="submit" class="btn btn-info pull-right">Apply</button>
          </div><!-- /.box-footer -->
          @endif
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </section>
</div>
@stop

@section('javascript') @parent
    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="/js/modal_notification.js"></script>
    <script src="/plugins/switchery/switchery.min.js"></script>
    <script src="/js/switchery_function.js"></script>
    <script>
    $(function () {
      checkNotification();
      renderSwitcher();
    });
    </script>
    <!-- ================== END PAGE LEVEL JS ================== -->
@stop
