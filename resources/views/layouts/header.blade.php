<!-- Header Navbar: style can be found in header.less -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
   <ul class="navbar-nav">
      <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link"></a>
      </li>
   </ul>
   <!-- Sidebar toggle button-->
   <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
   <span class="sr-only">Toggle navigation</span>
   </a>
   @guest
   <li><a href="{{ route('login') }}">Login</a></li>
   @else
      <ul class="navbar-nav ml-auto">
         <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="{{asset('dist/img/dummy.jpeg')}}" class="user-image" alt="User Image">
            <span class="hidden-xs"></span>
            </a>
            <ul class="dropdown-menu">
               <li class="user-footer">
                  <p>
                     {{ Auth::user()->username }}
                  </p>
                  <div class="pull-right">
                     <a href="{{ route('logout') }}" 
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                     Logout</a>
                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                     </form>
                  </div>
               </li>
               @endguest
            </ul>
         </li>
      </ul>
</nav>