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
    /**
    * Show  report .
    *@author Bharti<bharti.tadvi@neosofttech.com>
    *
    *@param  void
    *@return $totalRequirementChart, $chart, $completedRequirementChart
    */
    public function index(){
        
        $countData=[];
        $dateWiseData =[];

        $vendors = Vendor::select(\DB::raw("COUNT(*) as count"))
        ->pluck('count');
        
        $completedRequirement = Requirement::where('status',['completed'])->count();
        
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
            "rgb(92, 219, 148)",
            "rgb(255, 99, 132)",
            "rgb(43, 79, 213)",
            "rgb(255, 205, 86)",
            "rgb(51,105,232)",
            "rgb(244,67,54)",
            "rgb(34,198,246)",
            "rgb(153, 102, 255)",
            "rgb(255, 159, 64)",
            "rgb(233,30,99)",
            "rgb(205,220,57)",
        ];

        $chart = new ReportChart;
        $chart->minimalist(true);
        $chart->labels(['Vendors']);
        $chart->dataset('Vendors', 'doughnut', [$vendors])
            ->color(['#007bff'])
            ->backgroundcolor(['#007bff','#28a745']);
        
        $completedRequirementChart = new ReportChart;
        $completedRequirementChart->minimalist(true);
        $completedRequirementChart->labels(['Assigned Requirements','Completed Requirements']);
        $completedRequirementChart->dataset('Vendors', 'doughnut', [$assignRequirement,$completedRequirement])
            ->color($borderColors)
            ->backgroundcolor(['#e83e8c','#28a745']);
    
        $totalRequirementChart  = new ReportChart;
        $totalRequirementChart->minimalist(false);
        $totalRequirementChart->labels($dateWiseData);
        $totalRequirementChart->dataset('Requirements', 'bar',$countData)
            ->backgroundcolor($fillColors);

        return view('admin.reports.index',compact('chart','completedRequirementChart','totalRequirementChart'));
        
    }
}
