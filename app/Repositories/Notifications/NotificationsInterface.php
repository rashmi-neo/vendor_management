<?php

namespace App\Repositories\Notifications;
use Illuminate\Http\Request;

interface NotificationsInterface{


	/**
     * Get's a requirement by it's ID
     *
     * @param int
     */
    public function get($id);


	/**
     * Get's all requirement.
     *
     *@Author Pooja <pooja.lavhat@neosofttech.com>
     * @return $requirement
     */
    public function all();


    /**
     * Save a requirement.
     *
     * @param array
     */
    public function save(array $data);

    /**
     * Updates a requirement.
     *
     * @param int
     * @param array
     */
    public function update($id,array $data);

    /**
     * Deletes a requirement.
     *
     * @param int
     */
    public function delete($id);
}