<?php

namespace App\Repositories\Requirement;
use Illuminate\Http\Request;

interface RequirementInterface{


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
     * @param $data
     */
    public function save($data);

    /**
     * Updates a requirement.
     *
     * @param int
     * @param array
     */
    public function update($id,$data);

    /**
     * Deletes a requirement.
     *
     * @param int
     */
    public function delete($id);

    public function getVendorDetails($id);

    public function getAllCategories();

    public function getAssignVendors($id);

    public function getVendorDetailsAsPerRequirement($id);
}
