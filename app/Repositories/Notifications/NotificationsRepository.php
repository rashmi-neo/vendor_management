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
     * Get's all notification.
     *
     *@Author Sukanya 
     *@param  void
     *@return $notification
     */
    public function all()
    {
    	$notification = Notifications::all();
    	return $notification;
    }

    /**
     * Save a notification.
     *
     * @Author Sukanya 
     * @param  $data
     * @return $notification
     */
    public function save(array $data)
    {
    	Notifications::create($data);
    }

    /**
     * Updates a notification.
     *
     * @param int
     * @param $array
     */
    public function update($id,array $data)
    {
        Notifications::find($id)->update($data);
    }

    /**
     * Deletes a notification.
     *
     * @Author Sukanya 
     * @param int
     */
    public function delete($id)
    {
        Notifications::destroy($id);
    }

    /**
     * Get the notification data with condition
     *
     * @Author Sukanya 
     * @param int
     */
    public function getWhereData($data)
    {
        $notification = Notifications::where($data)->latest()->get();
        return $notification;
    }
}