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
     * Get's vendor transactions.
     *
     *@Author Bharti <bharti.tadvi@neosofttech.com>
     *@param  void
     *@return $users
     */
    public function getVendorPayment($data)
    {
        $vendor = Vendor::where('user_id',$data)->first();

        $payments = Payment::where('vendor_id',$vendor->id)->get();
    	return $payments;
    }

    public function all(){
        
        return Payment::get();
    }

}