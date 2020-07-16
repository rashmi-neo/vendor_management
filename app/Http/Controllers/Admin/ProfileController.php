<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DataTables;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use App\Repositories\Profile\ProfileInterface as ProfileInterface;

class ProfileController extends Controller
{
    /**
    * Initialize Repository
    *@Author Bharti <bharati.tadvi@neosofttech.com>
    *
    * @return \App\Repositories\ProfileRepository
    */ 
    private $profileRepository;

    public function __construct(ProfileInterface $profileRepository){
        $this->profileRepository = $profileRepository;
    }

    /**
    * Show the form for editing the specified User.
    *@Author Bharti <bharati.tadvi@neosofttech.com>
    *  
    * @return $user
    */
    public function index(){
        
        try {
            $user = $this->profileRepository->findUser();
            
            if($user){
                    return view('admin.profile.edit',compact('user'));
                }else{
                return redirect()->route('profiles.index')->with('error', 'User not found');
            }
        }catch(\Throwable $th){
            return redirect()->route('profiles.index')->with('error', 'Something went wrong!');
        }
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return void
    */
    public function update(ProfileRequest $request, $id)
    {
        
        try{
            $user = $this->profileRepository->update($id,$request);
            
            if($user){
                return redirect()->route('profiles.index')->with('success', 'Profile is successfully updated');
            }
                return redirect()->route('profiles.index')->with('error','User profile not found');
        }catch(\Exception $ex){
            return redirect()->route('profiles.index')->with('error','Something went wrong!');
        }
    }
}