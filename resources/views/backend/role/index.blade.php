@extends('layouts.master')

@section('title')
    Roles | Index
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
      <li class="active">Roles</li>
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
            <h3 class="box-title">Roles</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
            @foreach($roles as $role)
            <a href="/crm/{{$module}}/{{$role->id}}" class="col-md-3">
              <div class="callout callout-success">
                <h4>{{$role->descr}}</h4>
                <p>{{$role->name}}</p>
              </div>
            </a>
            @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
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
