<?php 

namespace App\Repositories\NewRequirement;
use Illuminate\Http\Request;

interface NewRequirementInterface{ 
	
    /**
     * Get's all New requirement.
     *
     * @Author Bharti <bharati.tadvi@neosofttech.com>
     * 
     */
    public function all();

    /**
     * Get's a New requirement by it's ID
     *
     * @Author Bharti <bharati.tadvi@neosofttech.com>
     * @param $id
     */
    public function find($id);


    /**
     * Get's a Quotation  by it's ID
     *
     * @Author Bharti <bharati.tadvi@neosofttech.com>
     * @param $id
     */
    public function findQuotation($id);


    /**
     * Updates a New requirement.
     *
     * @Author Bharti <bharati.tadvi@neosofttech.com>
     * @param $id,$data
     */
    public function update($id,$data);

}