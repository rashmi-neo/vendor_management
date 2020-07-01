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

    /**
     * Get's all vendor.
     *
     * @Author Bharti <bharati.tadvi@neosofttech.com>
     * @return void
     */
    public function all();

    /**
     * Get's a vendor by it's ID
     *
     * @Author Bharti <bharati.tadvi@neosofttech.com>
     * @param $id
     */
    public function find($id);

    /**
     * Updates a vendor.
     *
     * @Author Bharti <bharati.tadvi@neosofttech.com>
     * @param $id,$data
     * @param array
     */
    public function update($id,$data);

}