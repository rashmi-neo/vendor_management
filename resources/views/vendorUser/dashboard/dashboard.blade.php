@extends('layouts.master')
@section('main-content')

<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
<!-- Main content -->
<section class="content">
   <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
         <!-- ./col -->
         <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
               <div class="inner">
                  <h3>{{$completeRequirementCount}}</h3>
                  <p>Completed Requirements</p>
               </div>
               <div class="icon">
               <i class="ion ion-checkmark"></i>
               </div>
               <a href="#" class="small-box-footer"></i></a>
            </div>
         </div>
         <!-- ./col -->
         <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
               <div class="inner">
                  <h3>{{$newRequirementCount}}</h3>
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
         <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
               <div class="inner">
                  <h3>{{$cancelRequirementCount}}</h3>
                  <p>Cancelled Requirements</p>
               </div>
               <div class="icon">
                  <i class="ion ion-close-circled"></i>
               </div>
               <a href="#" class="small-box-footer"></i></a>
            </div>
         </div>
   </div>
   <!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection