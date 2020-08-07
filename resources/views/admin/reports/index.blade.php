@extends('layouts.master')
@section('main-content')
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0 text-dark">Reports</h1>
         </div>
         <!-- /.col -->
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
   		 	   <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
               <li class="breadcrumb-item active">Reports</li>
            </ol>
         </div>
         <!-- /.col -->
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</div>
<div class="container-fluid">
<div class ="row">
   <div class="col-lg-6">
      <div class="card">
         <div class="card-header">
            <h3 class="card-title">Vendors</h3>
         </div>
         <div class="card-body ml-2">
            <div class="row">
               <div class="box box-success">
                  <div class="box-body ml-4">
                     <div class="chart ml-5">
                        {!! $chart->container() !!}
                     </div>
                  </div>
                  <!-- /.box-body -->
               </div>
               <!-- /.box -->
            </div>
            <!-- /.box-body -->
            <div class="d-flex flex-row justify-content-end">
               <span class="mr-2">
               <i class="fas fa-square text-primary"></i> All Vendors
               </span>
            </div>
         </div>
      </div>
   </div>
   <div class="col-lg-6">
      <div class="card">
         <div class="card-header">
            <h3 class="card-title">Completed/Assigned Requirement</h3>
         </div>
         <div class="card-body  ml-2">
            <div class="row">
               <div class="box box-success">
                  <div class="box-body ml-4">
                     <div class="chart ml-5">
                        {!! $completedRequirementChart->container() !!}
                     </div>
                  </div>
                  <!-- /.box-body -->
               </div>
               <!-- /.box -->
            </div>
            <!-- /.box-body -->
            <div class="d-flex flex-row justify-content-end">
               <span class="mr-2">
               <i class="fas fa-square text-success"></i> Completed Requirements
               </span>
               <span class="mr-2">
               <i class="fas fa-square text-pink"></i> Assigned Requirements
               </span>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="card">
   <div class="card-header">
      <h3 class="card-title">Date wise Requirements </h3>
   </div>
   <div class="card-body">
      <!-- /.box-body -->
      <div class="row">
         <div class="col-md-6">
            <div class="box box-success">
               <div class="box-header with-border">
                  <div class="box-tools pull-right">
                  </div>
               </div>
               <div class="box-body">
                  <div class="chart">
                     {!! $totalRequirementChart->container() !!}
                  </div>
               </div>
               <!-- /.box-body -->
            </div>
            <!-- /.box -->
         </div>
      </div>
      <!-- /.box-body -->
      <div class="d-flex flex-row justify-content-end">
         <span class="mr-2">
         <i class="fas fa-square text-faint-green"></i> Date wise Requirements
         </span>
      </div>
   </div>
</div>
@endsection
@section('scripts')
   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
   {!! $chart->script() !!}
   {!! $totalRequirementChart->script() !!}
   {!! $completedRequirementChart->script() !!}
@endsection