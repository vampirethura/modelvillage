@extends('layouts.master')

@section('title')
    System Icons | Index
@stop

@section('css')
    @parent
    <style>
       /* FROM HTTP://WWW.GETBOOTSTRAP.COM
        * Glyphicons
        *
        * Special styles for displaying the icons and their classes in the docs.
        */

      .bs-glyphicons {
        padding-left: 0;
        padding-bottom: 1px;
        margin-bottom: 20px;
        list-style: none;
        overflow: hidden;
      }
      .bs-glyphicons li {
        float: left;
        width: 25%;
        height: 115px;
        padding: 10px;
        margin: 0 -1px -1px 0;
        font-size: 12px;
        line-height: 1.4;
        text-align: center;
        border: 1px solid #ddd;
      }
      .bs-glyphicons .glyphicon {
        margin-top: 5px;
        margin-bottom: 10px;
        font-size: 24px;
      }
      .bs-glyphicons .glyphicon-class {
        display: block;
        text-align: center;
        word-wrap: break-word; /* Help out IE10+ with class names */
      }
      .bs-glyphicons li:hover {
        background-color: rgba(86,61,124,.1);
      }

      @media (min-width: 768px) {
        .bs-glyphicons li {
          width: 12.5%;
        }
      }
    </style>
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
      <li class="active">System Icons</li>
      @endif
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">System Icons</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <ul class="bs-glyphicons">
              @foreach($sys_icons as $icon)
              <li>
                <h3><span class="fa {{$icon->key}}"></span></h3>
                <span class="glyphicon-class">fa {{$icon->key}}</span>
              </li>
              @endforeach
            </ul>
          </div>
          <div class="box-footer">

          </div><!-- /.box-footer -->
        </div>
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
