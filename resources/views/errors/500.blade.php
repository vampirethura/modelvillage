@extends('layouts.master')

@section('title')
    500 | Index
@stop

@section('css')
    @parent
    <!-- Customs CSS here ... -->
@stop

@section('content')
<section class="content-header">
  <h1>
    500 - Internal Server Error
  </h1>
</section>
<section class="content">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Oops! Something went wrong.</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <div class="callout callout-danger">
                <p>We will work on fixing that right away.</p>
                <p>The server encountered an unexpected condition which prevented it from fulfilling the request.</p>
                <p>You may <a href="{{Session::get('navtop')['home_url']}}">return to the dashboard</a> or <a href="{{URL::previous()}}">previous page.</a></p>
              </div>
              @if($debug)
              <div class="panel box box-danger">
                <div class="box-header with-border">
                  <h4 class="box-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                      Error Details
                    </a>
                  </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse">
                  <div class="box-body">
                    <div class="callout callout-danger">
                      <h4>General Error</h4>
                      <p><strong>Message:</strong> {{$exception->getMessage()}}</p>
                      <p><strong>File:</strong> {{$exception->getFile()}}</p>
                      <p><strong>Line:</strong> {{$exception->getLine()}}</p>
                    </div>
                    <h4>Stack Trace</h4>
                    @foreach($exception->getTrace() as $error)
                      <div class="box-header with-border">
                        @foreach($error as $key => $error_detail)
                          @if(!is_array($error_detail))
                          <p>{{$key}}: {{$error_detail}}</p>
                          @endif
                        @endforeach
                      </div>
                    @endforeach
                  </div>
                </div>
              </div><!-- /.panel .box .box-danger -->
              @endif
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
