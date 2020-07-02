<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
   <!-- Brand Logo -->
   <a href="#" class="brand-link">
   <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
      style="opacity: .8">
   <span class="brand-text font-weight-light">Vendor management</span>
   </a>
   <!-- Sidebar -->
   <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
         <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         @if(Auth::check() && Auth::user()->role_id == 1)
            <li class="nav-item">
               <a href="{{url('admin/dashboard')}}" class="nav-link {{ (request()->is('admin/dashboard')) ? 'active' : '' }}">
                  <i class="nav-icon far fa-image"></i>
                  <p>
                     Dashboard
                  </p>
               </a>
            </li>
            <li class="nav-item">
               <a href="{{route('categories.index')}}" class="nav-link {{ (request()->is('admin/categories*')) ? 'active' : '' }}">
                  <i class="nav-icon far fa-image"></i>
                  <p>
                     Vendor Category
                  </p>
               </a>
            </li>
            <li class="nav-item">
                <a href="{{route('vendors.index')}}" class="nav-link {{ (request()->is('admin/vendors*')) ? 'active' : '' }}">
                  <i class="nav-icon far fa-image"></i>
                  <p>
                     Vendors
                  </p>
               </a>
            </li>
            <li class="nav-item">
               <a href="#" class="nav-link  {{ (request()->is('admin/requirements*')) ? 'active' : '' }}">
                  <i class="nav-icon far fa-image"></i>
                  <p>
                     Requirements
                  </p>
               </a>
            </li>
         @endif
         @if(Auth::check() && Auth::user()->role_id == 2)  
         @endif
         </ul>
      </nav>
      <!-- /.sidebar-menu -->
   </div>
   <!-- /.sidebar -->
</aside>