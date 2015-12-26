@extends('layouts.master')

@section('title')
    403 | Index
@stop

@section('css')
    @parent
    <!-- Customs CSS here ... -->
@stop

@section('content')
<section class="content-header">
  <h1>
    403 - Forbidden
  </h1>
</section>
<section class="content">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
      <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title">Unauthorized Access</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <div class="callout callout-warning">
                <p>You are not permitted to view the requested page or perform the requested operation.</p>
                <p>You may <a href="{{Session::get('navtop')['home_url']}}">return to the dashboard</a> or <a href="{{URL::previous()}}">previous page</a>.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
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
