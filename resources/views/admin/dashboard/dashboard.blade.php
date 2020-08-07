@extends('layouts.master')
@section('main-content')

<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active">Dashboard</li>
         </ol>
         </div><!-- /.col -->
      </div><!-- /.row -->
   </div><!-- /.container-fluid -->
</div>

<!-- Main content -->
<section class="content">
   <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
         <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
               <div class="inner">
                  <h3>{{$countRequirement}}</h3>
                  <p>Total Requirements</p>
               </div>
               <div class="icon">
                  <i class="ion ion-star"></i>
               </div>
               <a href="#" class="small-box-footer"></i></a>
            </div>
         </div>
         <!-- ./col -->
         <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
               <div class="inner">
                  <h3>{{$countCompletedRequirement}}</h3>
                  <p>Completed Requirements</p>
               </div>
               <div class="icon">
               <i class="ion ion-checkmark"></i>
               </div>
               <a href="#" class="small-box-footer"></i></a>
            </div>
         </div>
         <!-- ./col -->
         <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
               <div class="inner">
                  <h3>{{$countNewRequirement}}</h3>
                  <p>New Requirements</p>
               </div>
               <div class="icon">
               <!-- <span class="iconify" data-icon="ion-construct-outline" data-inline="false"></span> -->
                  <i class="ion ion-briefcase"></i>
               </div>
               <a href="#" class="small-box-footer"></i></a>
            </div>
         </div>
         <!-- ./col -->
         <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
               <div class="inner">
                  <h3>{{$countPendingVerification}}</h3>
                  <p>Pending Verifications</p>
               </div>
               <div class="icon">
                  <i class="ion ion-pie-graph"></i>
               </div>
               <a href="#" class="small-box-footer"></i></a>
            </div>
         </div>
         <!-- ./col -->
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection