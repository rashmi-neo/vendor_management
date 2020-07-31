@extends('layouts.master')

@section('main-content')
<div class="card">
   <div class="card-header">
      <h3 class="card-title">Reports</h3>
   </div>
   <div class="card-body">
      <div class="row">
         <div class="col-md-6">
            <div class="box box-success">
               <div class="box-header with-border">
                  <h3 class="box-title text-center">Vendors Chart</h3>
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
         <div class="col-md-6">
            <div class="box box-info">
               <div class="box-header with-border">
                  <h3 class="box-title">Completed/Assigned Requirement Chart</h3>
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
                  <h3 class="box-title text-center">Requirements Chart</h3>
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
</div>
@endsection
@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
        {!! $chart->script() !!}
        {!! $totalRequirementChart->script() !!}
        {!! $completedRequirementChart->script() !!}

        <script type="text/javascript">
        </script>
@endsection