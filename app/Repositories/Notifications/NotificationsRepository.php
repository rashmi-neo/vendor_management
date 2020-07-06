<?php

namespace App\Repositories\Notifications;
use App\Model\Notifications;
use App\Repositories\Notifications\NotificationsInterface;

class NotificationsRepository implements NotificationsInterface{


	/**
     * Get's a Notifications by it's ID
     *
     * @param int
     * @return collection
     */
    public function get($id)
    {
        return Notifications::find($id);
    }


    /**
     * Get's all requirement.
     *
     *@Author Sukanya 
     *@param  void
     *@return $requirement
     */
    public function all()
    {
    	$requirement = Notifications::all();
    	return $requirement;
    }


    /**
     * Save a requirement.
     *
     * @Author Sukanya 
     * @param  $data
     * @return $requirement
     */
    public function save(array $data)
    {
    	Notifications::create($data);
    }


    /**
     * Updates a Requirement.
     *
     * @param int
     * @param $array
     */
    public function update($id,array $data)
    {
        Notifications::find($id)->update($data);
    }

    /**
     * Deletes a Requirement.
     *
     * @Author Sukanya 
     * @param int
     */
    public function delete($id)
    {
        Notifications::destroy($id);
    }
}