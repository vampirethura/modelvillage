@extends('layouts.master')

@section('title')
    Home | Index
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
      <li class="active">Dashboard</li>
      @endif
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="box">
          <div class="box-body">
            
          </div>
        </div>
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Table of Users</h3>
          </div><!-- /.box-header -->
          <div class="box-body">

          </div><!-- /.box-body -->
          <div class="box-footer">

          </div><!-- /.box-footer -->
        </div><!-- /.box -->
      </div>
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
