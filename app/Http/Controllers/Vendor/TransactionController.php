<?php

namespace App\Http\Controllers\Vendor;

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
    * @return \App\Repositories\TransactionRepository
    */
    private $transactionRepository;

    public function __construct( TransactionInterface $transactionRepository){
        $this->transactionRepository = $transactionRepository;
    }
    

    /* Index page of payments.
    *@Author Bharti <bharati.tadvi@neosofttech.com>
    *
    *@param  Illuminate\Http\Request;
    * @return void
    */
    public function index(Request $request){

        if($request->ajax()){
            
            $currentUser = \Auth::user();
            $whereData = ['user_id'=>$currentUser->id];
            $data = $this->transactionRepository->getVendorPayment($whereData);
            
            return Datatables::of($data)

            ->addIndexColumn()
            ->addColumn('download_file', function($data){
                return view('vendorUser.transactions.download_payment_file', compact('data'));
            })
            ->make(true);
        }
    	return view('vendorUser.transactions.index');
    }

    /**
     * download Payment receipt file.
     *@Author Bharti <bharati.tadvi@neosofttech.com>
     * @param   $filename
     * @return $newFileName
     */
    public function getPaymentFIleDownload($filename){
        
        $file = public_path(). "/uploads/".$filename;
        
        $newFileName = 'Payment-receipt'.time();

        return response()->download($file,$newFileName);

    }
}
