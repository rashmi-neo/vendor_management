<?php

namespace App\Repositories\Profile;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Profile\Profilenterface;

class ProfileRepository implements ProfileInterface{

    public $user;

    function __construct(User $user) {
	$this->user = $user;
	}
      
    /**
     * Get's all User profile.
     *
     *@Author Bharti <bharti.tadvi@neosofttech.com>
     *@param  void
     *@return collection
     */
    public function all()
    {
    	return  User::where('role_id',1)->get();
    }

    /**
     * Get's a User profile by it's ID
     *
     * @Author Bharti <bharati.tadvi@neosofttech.com>
     * @param void
     * @return collection
     */
    public function findUser()
    {
       $userId = \Auth::user()->id; 
       return User::where('id',$userId)->first();
    }

    /**
     * Updates a profile
     *
     * @Author Bharti <bharati.tadvi@neosofttech.com>
     * @param $id,$data
     * @return $user
    */
    public function update($id,$data)
    {   
        
        $user = User::where('role_id',1)->find($id);
        $user->username = $data->username;
        $user->email = $data->email;
        $user->password = Hash::make($data->new_password);
        $user->save();
        
        return $user;
    }
}