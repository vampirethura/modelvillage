@extends('layouts.master')

@section('title')
    Feature Details | Show
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
      <li><a href="/crm/{{$module}}">Features</a></li>
      <li class="active">Feature Details</li>
      @endif
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="box box-success">
          <div class="box-body">
            {{ Render::panelButtons('panel-default', Session::get('permissions')[$module], $actions['panel-default'], ['[FID]'=>$feature->id]) }}
            {{ Render::panelButtons('panel-with-modal-delete',Session::get('permissions')[$module], $actions['panel-with-modal-delete'], ['[FID]'=>$feature->id]) }}
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">{{$feature->name}} Feature's Details</h3>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tr>
                <td>Feature's Name</td>
                <td>{{$feature->name}}</td>
              </tr>
              <tr>
                <td>Group's Name</td>
                <td>{{$feature->group}}</td>
              </tr>
              <tr>
                <td>Group's Icon</td>
                <td>{{$feature->group_icon}} [ <i class="fa {{$feature->group_icon}}"></i> ]</td>
              </tr>
              <tr>
                <td>URL Path</td>
                <td>{{$feature->url}}</td>
              </tr>
              <tr>
                <td>Feature's Icon</td>
                <td>{{$feature->icon}} [ <i class="fa {{$feature->icon}}"></i> ]</td>
              </tr>
              <tr>
                <td>Descriptions</td>
                <td>{{$feature->descr}}</td>
              </tr>
              <tr>
                <td>Display</td>
                <td>{{$feature->display}}</td>
              </tr>
              <tr>
                <td>CRUD</td>
                <td>{{$feature->crud}}</td>
              </tr>
              <tr>
                <td>Admin</td>
                <td>{{$feature->admin}}</td>
              </tr>
              <tr>
                <td>Module's Name</td>
                <td>{{$feature->module}}</td>
              </tr>
              <tr>
                <td>Created at</td>
                <td>{{$feature->created_at}}</td>
              </tr>
              <tr>
                <td>Last Updated at</td>
                <td>{{$feature->updated_at}}</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">{{$feature->name}} Feature's Permissions</h3>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <thead>
                  <tr>
                      <th>Name</th>
                      <th>Page</th>
                      <th>View</th>
                      <th>Actions</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach($permissions as $permission)
                      <tr>
                          <td>{{$permission->name}}</td>
                          <td>{{$permission->page}}</td>
                          <td>
                            <a href="/crm/permission/{{$permission->id}}" data-toggle="tooltip" data-placement="bottom" title="" class="btn btn-icon btn-circle btn-lg btn-success btn-success btn-permission-details" data-original-title="View Details" pdata-descr="{{$permission->descr}}" pdata-module="{{$permission->module}}" pdata-position="{{$permission->position}}" pdata-url="{{$permission->url}}" pdata-icon="{{$permission->icon}}" pdata-icon-bg="{{$permission->icon_bg}}" pdata-prompt-type="{{$permission->prompt_type}}" pdata-prompt-title="{{$permission->prompt_title}}" pdata-prompt-content="{{$permission->prompt_content}}">
                						    <i class="fa fa-eye"></i>
                						</a>
                          </td>
                          <td>
                          @if(isset(Session::get('permissions')[$module]))
                              {{ Render::tableButtons(Session::get('permissions')[$module], $actions['table'] ,array("[FID]" => $feature->id, "[PID]"=>$permission->id) ) }}
                          @endif
                          </td>
                      </tr>
                  @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div id="permissionDetailsModal" class="modal modal-success">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Permission Details</h4>
            </div>
            <div class="modal-body">
              <table class="table">
                <tr>
                  <td><strong>Descriptions:</strong></td>
                  <td id="modal-per-descr"></td>
                </tr>
                <tr>
                  <td><strong>Module:</strong></td>
                  <td id="modal-per-module"></td>
                </tr>
                <tr>
                  <td><strong>Position:</strong></td>
                  <td id="modal-per-pos"></td>
                </tr>
                <tr>
                  <td><strong>URL:</strong></td>
                  <td id="modal-per-url"></td>
                </tr>
                <tr>
                  <td><strong>Icon:</strong></td>
                  <td id="modal-per-icon"></td>
                </tr>
                <tr>
                  <td><strong>Icon BG:</strong></td>
                  <td id="modal-per-icon-bg"></td>
                </tr>
                <tr>
                  <td><strong>Prompt Type:</strong></td>
                  <td id="modal-per-prompt-type"></td>
                </tr>
                <tr>
                  <td><strong>Prompt Title:</strong></td>
                  <td id="modal-per-prompt-title"></td>
                </tr>
                <tr>
                  <td><strong>Prompt Content:</strong></td>
                  <td id="modal-per-prompt-content"></td>
                </tr>
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
    </div>
  </section>
</div>
@stop

@section('javascript') @parent
    <!-- ================== BEGIN PAGE LEVEL JS ================== -->
    <script src="/js/modal_notification.js"></script>
    <script>
    $(function () {
      checkNotification();
      $('.btn-permission-details').on('click', function(e){
        e.preventDefault();
        $('#modal-per-descr').text($(this).attr('pdata-descr'));
        $('#modal-per-module').text($(this).attr('pdata-module'));
        $('#modal-per-pos').text($(this).attr('pdata-position'));
        $('#modal-per-url').text($(this).attr('pdata-url'));
        $('#modal-per-icon').text($(this).attr('pdata-icon'));
        $('#modal-per-icon-bg').text($(this).attr('pdata-icon-bg'));
        $('#modal-per-prompt-type').text($(this).attr('pdata-prompt-type'));
        $('#modal-per-prompt-title').text($(this).attr('pdata-prompt-title'));
        $('#modal-per-prompt-content').text($(this).attr('pdata-prompt-content'));
        $('#permissionDetailsModal').modal({show:true});
      });
    });
    </script>
    <!-- ================== END PAGE LEVEL JS ================== -->
@stop
