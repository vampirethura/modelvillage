<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{$sidebar['profile']['image']}}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{$sidebar['profile']['display_name']}}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>

    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
        @foreach ($sidebar['menus'] as $menu)
          @if(count($menu['submenu']) > 0)
          <li class="treeview">
          <a href="#">
            <i class="fa {{$menu['icon']}}"></i> <span>{{$menu['name']}}</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            @foreach($menu['submenu'] as $submenu)
            <li class="{{$submenu['module']}}"><a href="{{$submenu['url']}}"><i class="fa {{$submenu['icon']}}"></i> {{$submenu['name']}}</a></li>
            @endforeach
          </ul>
          </li>
          @endif
        @endforeach
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
