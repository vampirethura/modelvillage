@extends('layouts.master')

@section('title')
    Home | Index
@stop

@section('css')
    @parent
    <!-- Customs CSS here ... -->
@stop

@section('content')
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
