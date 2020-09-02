<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Repositories\Transaction\TransactionInterface as  TransactionInterface;


class TransactionController extends Controller
{
    
	/**
    * Initialize Repository
    *@Author Bharti <bharati.tadvi@neosofttech.com>
    *
    * @return \App\Repositories\Transaction\TransactionRepository
    */
    private $transactionRepository;

    public function __construct( TransactionInterface $transactionRepository){
        $this->transactionRepository = $transactionRepository;
    }
    
    /**
    * Index page of payments.
    *@Author Bharti <bharati.tadvi@neosofttech.com>
    *
    *@param  Illuminate\Http\Request;
    * @return Datatables
    */
    public function index(Request $request){

        if($request->ajax()){
            
            $data = $this->transactionRepository->all();
            
            return Datatables::of($data)

            ->addIndexColumn()
            ->addColumn('requirement_id', function($data){
                return $data->requirement->code;
            })
            ->addColumn('requirement_title', function($data){
                return $data->requirement->title;
            })
            ->addColumn('category', function($data){
                return $data->requirement->category->name;
            })
            ->addColumn('vendor_name', function($data){
                return $data->vendor->first_name. ' '.$data->vendor->last_name;
            })
            ->addColumn('payment_date', function($data){
                return date("jS-F-Y", strtotime($data->payment_date));
            })
            ->addColumn('action', function($row){
                return view('admin.transactions.action', compact('row'));
            })
            ->rawColumns(['action'])
            ->make(true);
        }
    	return view('admin.transactions.index');
    }
}
