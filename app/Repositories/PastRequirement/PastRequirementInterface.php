<?php 

namespace App\Repositories\PastRequirement;
use Illuminate\Http\Request;

interface PastRequirementInterface{ 
	
    /**
     * Get's all Past requirement.
     *
     * @Author Bharti <bharati.tadvi@neosofttech.com>
     * 
     */
    public function all();

    /**
     * Get's a Past requirement by it's ID
     *
     * @Author Bharti <bharati.tadvi@neosofttech.com>
     * @param $id
     */
    public function find($id);

}