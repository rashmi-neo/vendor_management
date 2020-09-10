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
    * Show  Reports .
    *@author Bharti<bharti.tadvi@neosofttech.com>
    *
    *@param  void
    *@return $totalRequirementChart, $chart, $completedRequirementChart
    */
    public function index(){
        
        $countData = [];
        $dateWiseData = [];
        $fillColors = [];

        $vendors = Vendor::count();
        
        $completedRequirement = Requirement::where('status',['completed'])->count();
        
        $totalRequirement = DB::table('vms_requirements')
        ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
        ->where('deleted_at', NULL)
        ->groupBy('date')
        ->pluck('count');

        $totalRequirementdate = DB::table('vms_requirements')
        ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
        ->where('deleted_at', NULL)
        ->groupBy('date')
        ->pluck('date');
        
        foreach($totalRequirementdate as $date){
            
            $dateWiseData[] = date("j-M-y", strtotime($date));
            $fillColors[] = $this->random_color();
        }
       
        $assignRequirement = AssignVendor::count();

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
            ->backgroundcolor(['#e83e8c','#28a745']);
    
        $totalRequirementChart  = new ReportChart;
        $totalRequirementChart->minimalist(false);
        $totalRequirementChart->labels($dateWiseData);
        $totalRequirementChart->dataset('Requirements', 'bar',$totalRequirement)
            ->backgroundcolor($fillColors);

        return view('admin.reports.index',compact('chart','completedRequirementChart','totalRequirementChart'));
        
    }

    /**
    * Create random colors.
    *@author Bharti<bharti.tadvi@neosofttech.com>
    *
    *@param  void
    *@return $colors
    */
    public function random_color() {
        $colors = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
        return $colors;
    }
    
}