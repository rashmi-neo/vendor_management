<?php 

namespace App\Repositories\Transaction;
use Illuminate\Http\Request;

interface TransactionInterface{ 
	
    /**
     * Get's vendor transactions.
     *
     * @Author Bharti <bharati.tadvi@neosofttech.com>
     * @return void
     */
    public function getVendorPayment($data);


    /**
     * Get's all transactions.
     *
     * @Author Bharti <bharati.tadvi@neosofttech.com>
     * @return void
     */
    public function all();

}