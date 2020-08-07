<!DOCTYPE html>
<html>
   <head>
      @include('layouts.main_metaheader')
      @include('layouts.include_css')
   </head>
   <body class="hold-transition sidebar-mini layout-fixed">
      <div class="wrapper">
         <!-- Navbar -->
         @include('layouts.header')
         <!-- /.navbar -->
         <!-- Main Sidebar Container -->
         @include('layouts.sidebar')
         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <!-- /.content-header -->
            <!-- Main content -->
            <section class="content">
               <div class="container-fluid">
                  <!-- Main row -->
                  <div class="row">
                     <section class="col-lg-12 connectedSortable">
                        @yield('main-content')
                     </section>
                  </div>
                  <!-- /.row (main row) -->
               </div>
               <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
         </div>
         <!-- /.-wrapper -->
         <!-- begin:: Footer -->
         @include('layouts.footer')
         <!-- end:: Footer -->
      </div>
      <!-- ./wrapper -->
      @include('layouts.include_js')
      @yield('scripts')
   </body>
</html>