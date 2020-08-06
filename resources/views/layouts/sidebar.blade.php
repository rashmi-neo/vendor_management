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
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                     Dashboard
                  </p>
               </a>
            </li>
            <li class="nav-item">
               <a href="{{route('categories.index')}}" class="nav-link {{ (request()->is('admin/categories*')) ? 'active' : '' }}">
                  <i class="nav-icon fas fa-copy"></i>
                  <p>
                     Vendor Categories
                  </p>
               </a>
            </li>
            <li class="nav-item">
                <a href="{{route('vendors.index')}}" class="nav-link {{ (request()->is('admin/vendors*')) ? 'active' : '' }}">
                  <i class="nav-icon far fa-user"></i>
                  <p>
                     Vendors
                  </p>
               </a>
            </li>
            <li class="nav-item">
               <a href="{{route('requirements.index')}}" class="nav-link  {{ (request()->is('admin/requirements*')) ? 'active' : '' }}">
                  <i class="nav-icon fas fa-briefcase"></i>
                  <p>
                     Requirements
                  </p>
               </a>
            </li>
            <li class="nav-item">
               <a href="{{route('notification.index')}}" class="nav-link  {{ (request()->is('admin/notification*')) ? 'active' : '' }}">
                  <i class="nav-icon far fa-bell"></i>
                  <p>
                     Notifications
                  </p>
               </a>
            </li>
            <li class="nav-item">
               <a href="{{route('admin.transaction.index')}}" class="nav-link  {{ (request()->is('admin/transaction*')) ? 'active' : '' }}">
                  <i class="nav-icon fas fa-rupee-sign"></i>
                  <p>
                     Transaction Details
                  </p>
               </a>
            </li>
            <li class="nav-item">
               <a href="{{route('reviews.index')}}" class="nav-link  {{ (request()->is('admin/reviews*')) ? 'active' : '' }}">
                  <i class="nav-icon far fa-star"></i>
                  <p>
                     Reviews and Ratings 
                  </p>
               </a>
            </li>
            <li class="nav-item">
               <a href="{{route('reports.index')}}" class="nav-link {{ (request()->is('admin/reports*')) ? 'active' : '' }}">
                  <i class="nav-icon fas fa-chart-pie"></i>
                  <p>
                     Reports
                  </p>
               </a>
            </li>
            <li class="nav-item">
               <a href="{{route('profiles.index')}}" class="nav-link {{ (request()->is('admin/profiles*')) ? 'active' : '' }}">
                  <i class="nav-icon far fa-user"></i>
                  <p>
                     My Account
                  </p>
               </a>
            </li>
         @endif
         @if(Auth::check() && Auth::user()->role_id == 2)
         <li class="nav-item">
            <a href="{{url('vendor/dashboard')}}" class="nav-link {{ (request()->is('vendor/dashboard')) ? 'active' : '' }}">
               <i class="nav-icon fas fa-tachometer-alt"></i>
               <p>
                  Dashboard
               </p>
            </a>
         </li>
         <li class="nav-item">
            <a href="{{route('accounts.index')}}" class="nav-link  {{ (request()->is('vendor/accounts*')) ? 'active' : '' }}">
               <i class="nav-icon far  fa-user"></i>
               <p>
                  My Account
               </p>
            </a>
         </li>
         <li class="nav-item">
            <a href="{{route('past.requirement.index')}}" class="nav-link  {{ (request()->is('vendor/past/requirements*')) ? 'active' : '' }}">
               <i class="nav-icon fas fa-briefcase"></i>
               <p>
                  Past Requirements
               </p>
            </a>
         </li>
         <li class="nav-item">
            <a href="{{route('new.requirement.index')}}" class="nav-link  {{ (request()->is('vendor/new/requirements*')) ? 'active' : '' }}">
               <i class="nav-icon  fas fa-briefcase"></i>
               <p>
                  New Requirements
               </p>
            </a>
         </li>
         <li class="nav-item">
               <a href="{{route('notifications.index')}}" class="nav-link  {{ (request()->is('vendor/notification*')) ? 'active' : '' }}">
                  <i class="nav-icon far fa-bell"></i>
                  <p>
                     Notifications
                  </p>
               </a>
         </li>
         <li class="nav-item">
               <a href="{{route('transaction.index')}}" class="nav-link  {{ (request()->is('vendor/transaction*')) ? 'active' : '' }}">
                  <i class="nav-icon fas fa-rupee-sign"></i>
                  <p>
                     Transaction Details 
                  </p>
               </a>
         </li>
         <li class="nav-item">
            <a href="{{route('vendor.reviews.index')}}" class="nav-link  {{ (request()->is('vendor/reviews*')) ? 'active' : '' }}">
               <i class="nav-icon far fa-star"></i>
               <p>
                  Reviews and Ratings
               </p>
            </a>
         </li>
         @endif
         </ul>
      </nav>
      <!-- /.sidebar-menu -->
   </div>
   <!-- /.sidebar -->
</aside>
