<header class="main-header">
  <!-- Logo -->
  <a href="{{$navtop['home_url']}}" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini">{{$navtop['company_name']}}</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><img src="{{$navtop['company_logo']}}" />{{$navtop['company_name']}}</span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </a>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">        
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="{{$navtop['user_image']}}" class="user-image" alt="User Image">
            <span class="hidden-xs">{{$navtop['user_name']}}</span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="{{$navtop['user_image']}}" class="img-circle" alt="User Image">
              <p>
                {{$navtop['user_name']}}
                <small>Member since {{$navtop['member_since']}}</small>
              </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="{{$navtop['profile_functions']}}" class="btn btn-default btn-flat">Profile</a>
              </div>
              <div class="pull-right">
                <a href="/crm/logout" class="btn btn-default btn-flat">Sign out</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>
