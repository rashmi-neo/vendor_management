<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DataTables;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use App\Model\User;
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
    * Index page of User Profile.
    *@Author Bharti <bharati.tadvi@neosofttech.com>
    * 
    * @param Illuminate\Http\Request
    * @return void
    */
    public function index(Request $request){
        
        if($request->ajax()){
            $data = $this->profileRepository->all();
            
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('verification_status', function($data){
                
                if($data->is_verified == "pending"){
                    return "Pending";
                }elseif($data->is_verified == "approved"){
                    return "Approved";
                }
                return "Rejected";
            })
            ->addColumn('action', function($row){
                return view('admin.profile.actions', compact('row'));
            })
            ->rawColumns(['action'])
            ->make(true);
        }
    	return view('admin.profile.index');
    }
    
    /**
    * Show the form for editing the specified User.
    *@Author Bharti <bharati.tadvi@neosofttech.com>
    *  
    * @param  $id
    * @return $user
    */
    public function edit($id)
    {   
        $userId = $id;
            
        try {
            $user = $this->profileRepository->find($userId);
            
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