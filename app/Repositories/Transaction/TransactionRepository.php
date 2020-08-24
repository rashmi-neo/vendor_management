<?php

namespace App\Repositories\Transaction;
use App\Model\Payment;
use App\Model\Vendor;
use App\Repositories\Transaction\TransactionInterface;

class TransactionRepository implements TransactionInterface{

    public $payment;

    function __construct(Payment $payment) {
	$this->payment = $payment;
	}
      
    /**
     * Get's transactions as per login vendor.
     *
     *@Author Bharti <bharti.tadvi@neosofttech.com>
     *@param  $data
     *@return $payments
     */
    public function getVendorPayment($data)
    {
        $vendor = Vendor::where('user_id',$data)->first();

        $payments = Payment::where('vendor_id',$vendor->id)->get();
    	return $payments;
    }

    /**
     * Get's vendor transactions.
     *
     *@Author Bharti <bharti.tadvi@neosofttech.com>
     *@param  void
     *@return collection
     */
    public function all(){
        
        return Payment::orderBy('id', 'desc')->get();
    }

}