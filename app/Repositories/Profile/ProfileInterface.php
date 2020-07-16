<?php 

namespace App\Repositories\Profile;
use Illuminate\Http\Request;

interface ProfileInterface{ 
	
    /**
     * Get's all User profile.
     *
     * @Author Bharti <bharati.tadvi@neosofttech.com>
     * 
     */
    public function all();

    /**
     * Get's a User profile by it's ID
     *
     * @Author Bharti <bharati.tadvi@neosofttech.com>
     * @param $id
     */
    public function findUser();

    /**
     * Updates a User.
     *
     * @Author Bharti <bharati.tadvi@neosofttech.com>
     * @param $id,$data
     */
    public function update($id,$data);
}