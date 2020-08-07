@extends('layouts.master')
@section('main-content')
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0 text-dark">Reports</h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Reports</li>
         </ol>
         </div><!-- /.col -->
      </div><!-- /.row -->
   </div><!-- /.container-fluid -->
</div>
<div class="card">
   <div class="card-header">
      <h3 class="card-title">Report Charts</h3>
   </div>
   <div class="card-body">
      <div class="row">
         <div class="col-md-4">
            <div class="box box-success">
               <div class="box-header with-border">
                  <h5 class="box-title text-center">Vendors</h5>
                  <div class="box-tools pull-right">
                  </div>
               </div>
               <div class="box-body">
                  <div class="chart">
                     {!! $chart->container() !!}
                  </div>
               </div>
               <!-- /.box-body -->
            </div>
            <!-- /.box -->
         </div>
         <div class="col-md-2">
         </div>
         <div class="col-4 mt-1 ml-5">
            <div class="box box-info">
               <div class="box-header with-border">
                  <h5 class="box-title">Completed/Assigned Requirement</h5>
                  <div class="box-tools pull-right">
                  </div>
               </div>
               <div class="box-body">
                  <div class="chart">
                     {!! $completedRequirementChart->container() !!}
                  </div>
               </div>
               <!-- /.box-body -->
            </div>
            <!-- /.box -->
         </div>
      </div>
      <!-- /.box-body -->
      <div class="row mt-5">
         <div class="col-md-6">
            <div class="box box-success">
               <div class="box-header with-border">
                  <h5 class="box-title text-center">Date wise Requirements </h5>
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
   </div>
</div>
@endsection
@section('scripts')
   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
   {!! $chart->script() !!}
   {!! $totalRequirementChart->script() !!}
   {!! $completedRequirementChart->script() !!}
@endsection