@extends('layouts.master')

@section('title')
    Notification | Index
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
      <li class="active">Notifications</li>
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
            <h3 class="box-title">Table of Notifications</h3>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive">
            <table id="data-table" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Subject</th>
                  <th>Body</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($notifications as $notification)
                   <tr>
                       <td>{{$notification->id}}</td>
                       <td>{{$notification->subject}}</td>
                       <td>{{$notification->body}}</td>
                       <td>
                           @if(isset(Session::get('permissions')[$module]))
                               {{ Render::tableButtons(Session::get('permissions')[$module], $actions['table'] ,array("[UID]" => $notification->id) ) }}
                           @endif
                       </td>
                   </tr>
               @endforeach
              </tbody>
            </table>
          </div>
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
    });
    </script>
    <!-- ================== END PAGE LEVEL JS ================== -->
@stop
