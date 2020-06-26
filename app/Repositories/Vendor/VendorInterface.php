<?php 

namespace App\Repositories\Vendor;
use Illuminate\Http\Request;

interface VendorInterface{ 
	
	/**
     * Save vendor details.
     *
     * @Author Bharti <bharati.tadvi@neosofttech.com>
     * @param $requestData
     */
    public function save($requestData);

}