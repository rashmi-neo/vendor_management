<?php 

namespace App\Repositories\Account;
use Illuminate\Http\Request;

interface AccountInterface{ 
	
	/**
     * Save vendor document .
     *
     * @Author Bharti <bharati.tadvi@neosofttech.com>
     * @param $requestData
     */
    public function documentSave($requestData);


	/**
     * Save Support contact detail  .
     *
     * @Author Bharti <bharati.tadvi@neosofttech.com>
     * @param $requestData
     */
    public function supportContactSave($requestData);


	/**
     * Save Bank detail .
     *
     * @Author Bharti <bharati.tadvi@neosofttech.com>
     * @param $requestData
     */
    public function bankDetailSave($requestData);
    
    /**
     * Updates a vendor.
     *
     * @Author Bharti <bharati.tadvi@neosofttech.com>
     * @param $id,$data
     */
    public function updateVendor($id,$data);

    /**
     * Updates a company detail.
     *
     * @Author Bharti <bharati.tadvi@neosofttech.com>
     * @param $id,$data
     */
    public function updateCompany($id,$data);
}