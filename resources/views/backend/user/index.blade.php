@extends('layouts.master')

@section('title')
    User | Index
@stop

@section('css')
    @parent
    <!-- Customs CSS here ... -->
    <!-- DataTables -->
    <link rel="stylesheet" href="/plugins/datatables/dataTables.bootstrap.css">
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
      <li class="active">User</li>
      @endif
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="box">
          <div class="box-body">
            {{ Render::panelButtons('panel-default', Session::get('permissions')[$module], $actions['panel-default']) }}
          </div>
        </div>
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Table of Users</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-horizontal">
                  <div class="form-group">
                    <div class="col-sm-6">
                      <input type="text" id="txt_search_name" class="form-control" placeholder="Search By Name" >
                    </div>
                    <div class="col-sm-6">
                      <input type="text" id="txt_search_email" class="form-control" placeholder="Search By Email" >
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="box-body table-responsive no-padding">
              <table id="data-table" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Username</th>
                    <th>Fullname</th>
                    <th>Email</th>
                    <th>Activation</th>
                    <th>Role</th>
                    <th>Last Access</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($users as $user)
                     <tr>
                         <td>{{$user->username}}</td>
                         <td>{{$user->display_name}}</td>
                         <td>{{$user->email}}</td>
                         <td>{{($user->activation_status == 'A')? 'Activated' : 'Not Activated'}}</td>
                         <td>{{App\Role::find($user->role_id)['name']}}</td>
                         <td>{{$user->last_access}}</td>
                         <td>
                             @if(isset(Session::get('permissions')[$module]))
                                 {{ Render::tableButtons(Session::get('permissions')[$module], $actions['table'] ,array("[UID]" => $user->id) ) }}
                             @endif
                         </td>
                     </tr>
                 @endforeach
                </tbody>
              </table>
            </div>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div>
    </div>
  </section>
</div>
@stop

@section('javascript') @parent
    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="/js/modal_notification.js"></script>
    <script>
    $(function () {
      checkNotification();
      var table = $("#data-table").DataTable();
      $('#txt_search_name').on( 'keyup', function () {
          console.log(this.value);
          table.columns(1).search(this.value).draw();
      });
      $('#txt_search_email').on( 'keyup', function () {
          console.log(this.value);
          table.columns(2).search(this.value).draw();
      });
    });
    </script>
    <!-- ================== END PAGE LEVEL JS ================== -->
@stop
