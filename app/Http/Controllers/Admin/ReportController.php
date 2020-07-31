<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Vendor;
use App\User;
use App\Model\AssignVendor;
use App\Model\Requirement;
use App\Charts\ReportChart;


use DB;


class ReportController extends Controller
{
   
    public function index(){
        
        $countData=[];
        $dateWiseData =[];

        $vendors = Vendor::select(\DB::raw("COUNT(*) as count"))
        ->groupBy(\DB::raw("Month(created_at)"))
        ->pluck('count');
        $completedRequirement = Requirement::where('status',['completed'])->count();
        
        //$totalRequirement = Requirement::where('created_at',['completed'])->get();
        $totalRequirement = DB::table('vms_requirements')
        ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
        ->groupBy('date')
        ->pluck('count');

        $totalRequirementdate = DB::table('vms_requirements')
        ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
        ->groupBy('date')
        ->pluck('date');
        
        
        foreach($totalRequirementdate as $date){
            
            $dateWiseData[] = $date ;
        }

        foreach($totalRequirement as $count){
            
            $countData[] = $count ;
        }
        
        $assignRequirement = AssignVendor::count();

        $borderColors = [
            "rgba(255, 99, 132, 1.0)",
            "rgba(22,160,133, 1.0)",
            "rgba(255, 205, 86, 1.0)",
            "rgba(51,105,232, 1.0)",
            "rgba(244,67,54, 1.0)",
            "rgba(34,198,246, 1.0)",
            "rgba(153, 102, 255, 1.0)",
            "rgba(255, 159, 64, 1.0)",
            "rgba(233,30,99, 1.0)",
            "rgba(205,220,57, 1.0)"
        ];
        $fillColors = [
            "rgb(255, 99, 132, 0.2)",
            "rgb(22,160,133, 0.2)",
            "rgb(255, 205, 86, 0.2)",
            "rgb(51,105,232, 0.2)",
            "rgb(244,67,54, 0.2)",
            "rgb(34,198,246, 0.2)",
            "rgb(153, 102, 255, 0.2)",
            "rgb(255, 159, 64, 0.2)",
            "rgb(233,30,99, 0.2)",
            "rgb(205,220,57, 0.2)"

        ];
        $chart = new ReportChart;
        $chart->minimalist(true);
        $chart->labels(['Vendors']);
        $chart->dataset('Vendors', 'doughnut', [$vendors])
            ->color(['#007bff'])
            ->backgroundcolor(['#007bff']);
        
        $completedRequirementChart = new ReportChart;
        $completedRequirementChart->minimalist(true);
        $completedRequirementChart->labels(['Assigned Requirements','Completed Requirements']);
        $completedRequirementChart->dataset('Vendors', 'doughnut', [$assignRequirement,$completedRequirement])
            ->color($borderColors)
            ->backgroundcolor(['#e83e8c','#28a745']);
    

        $totalRequirementChart  = new ReportChart;
        $totalRequirementChart->minimalist(true);
        $totalRequirementChart->labels($dateWiseData);
        $totalRequirementChart->dataset('Requirements', 'bar',$countData)
            ->backgroundcolor(['#7158e2','#3ae374', '#ff3838']);
    
        return view('admin.reports.index',compact('chart','completedRequirementChart','totalRequirementChart'));
        
    }
}
