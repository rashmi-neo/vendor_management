<?php
   $user = \Auth::user();
   $notifCount="";
   $notifList=[];
   if($user)
   {
      $notifCount = \App\Model\Notifications::where(['user_id'=>$user->id,'status'=>'unread'])->count();
      if($notifCount==0)
         $notifCount="";
   
      $notifList = \App\Model\Notifications::where(['user_id'=>$user->id,'status'=>'unread'])->get();
   }
   
   ?>
@if(Auth::check() && Auth::user()->role_id == 1)
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
      <li class="nav-item dropdown">
         <a class="nav-link" data-toggle="dropdown" href="#">
         <i class="far fa-bell"></i>
         <span class="badge badge-danger navbar-badge">{{$notifCount}}</span>
         </a>
         <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">Notifications</span>
            @if(count($notifList)>0)
            @foreach($notifList as $value)
            <div class="dropdown-divider"></div>
            <a id="{{$value->id}}" href="{{$value->type=='vendor_register'?route('vendors.index'):''}}" class="dropdown-item markRead" onclick='markAsRead("{{$value->id}}")'>
            <i class="fas fa-user mr-2"></i> {{$value->title}}
            <span class="float-right text-muted text-sm">{{\Carbon\Carbon::parse($value->created_at)->toFormattedDateString()}}</span>
            <br>
            <p style="font-size: 12px;">{{$value->text}}</p>
            </a>
            <div class="dropdown-divider"></div>
            @endforeach
            @else
            <div class="dropdown-divider"></div>
            <a>
               <center>No New Notifications</center>
            </a>
            <div class="dropdown-divider"></div>
            @endif
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
         </div>
      </li>
      <li class="dropdown user user-menu">
         <a href="#" class="dropdown-toggle" data-toggle="dropdown">
         <img src="{{asset('dist/img/dummy.jpeg')}}" class="user-image" alt="User Image">
         <span class="hidden-xs"></span>
         </a>
         <ul class="dropdown-menu">
            <!-- User image -->
            <li class="">
               <p class="text-center">{{ Auth::user()->username }}</p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
               <div class="float-right">
                  <a href="{{ route('logout') }}" class="btn btn-primary btn-md"
                     onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
                     Log out  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST">
                     {{ csrf_field() }}
                  </form>
               </div>
            </li>
            @endguest
         </ul>
      </li>
   </ul>
</nav>
@endif
@if(Auth::check() && Auth::user()->role_id == 2)
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
      <li class="nav-item dropdown">
         <a class="nav-link" data-toggle="dropdown" href="#">
         <i class="far fa-bell"></i>
         <span class="badge badge-danger navbar-badge">{{$notifCount}}</span>
         </a>
         <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">Notifications</span>
            @if(count($notifList)>0)
            @foreach($notifList as $value)
            <div class="dropdown-divider"></div>
            <a id="{{$value->id}}" href="{{$value->type=='vendor_register'?route('vendors.index'):''}}" class="dropdown-item markRead" onclick='markAsRead("{{$value->id}}")'>
            <i class="fas fa-user mr-2"></i> {{$value->title}}
            <span class="float-right text-muted text-sm">{{\Carbon\Carbon::parse($value->created_at)->toFormattedDateString()}}</span>
            <br>
            <small>{{$value->text}}</small>
            </a>
            <div class="dropdown-divider"></div>
            @endforeach
            @else
            <div class="dropdown-divider"></div>
            <a>
               <center>No New Notifications</center>
            </a>
            <div class="dropdown-divider"></div>
            @endif
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
         </div>
      </li>
      <li class="dropdown user user-menu">
         <a href="#" class="dropdown-toggle" data-toggle="dropdown">
         <img src="{{asset('dist/img/dummy.jpeg')}}" class="user-image" alt="User Image">
         <span class="hidden-xs"></span>
         </a>
         <ul class="dropdown-menu">
            <!-- Vendor name -->
            <li class="">
            <?php
            $user = \Auth::user();
            $vendor = App\Model\Vendor::where('user_id',$user->id)->first();
            echo '<p class="text-center">'. $vendor->first_name.' '.$vendor->last_name.'</p>';
            ?>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
               <div class="float-right">
                  <a href="{{ route('logout') }}" class="btn btn-primary btn-md"
                     onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
                     Log out  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST">
                     {{ csrf_field() }}
                  </form>
               </div>
            </li>
            @endguest
         </ul>
      </li>
   </ul>
</nav>
@endif
@section('scripts')
<script type="text/javascript">
   /*function markAsRead(id)
   {
     $.ajax({
             type: "GET",
             url:  "notification/markAsRead/"+id,
             data: {id:id},
             success: function(response)
             {
                 console.log("success");
             }
        });
     
   }*/
   
</script>
@endsection