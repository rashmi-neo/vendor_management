<?php

namespace App\Repositories\Category;
use App\Model\Requirement;
use App\Repositories\Requirement\RequirementInterface;

class RequirementRepository implements RequirementInterface{


	/**
     * Get's a requirement by it's ID
     *
     * @param int
     * @return collection
     */
    public function get($id)
    {
        return Requirement::find($id);
    }


    /**
     * Get's all requirement.
     *
     *@Author Pooja <pooja.lavhat@neosofttech.com>
     *@param  void
     *@return $requirement
     */
    public function all()
    {
    	$requirement = Requirement::all();
    	return $requirement;
    }


    /**
     * Save a requirement.
     *
     * @Author Pooja <pooja.lavhat@neosofttech.com>
     * @param  $data
     * @return $requirement
     */
    public function save(array $data)
    {
    	Requirement::create($data);
    }


    /**
     * Updates a Requirement.
     *
     * @param int
     * @param $array
     */
    public function update($id,array $data)
    {
        Requirement::find($id)->update($data);
    }

    /**
     * Deletes a Requirement.
     *
     * @Author Pooja <pooja.lavhat@neosofttech.com>
     * @param int
     */
    public function delete($id)
    {
        Requirement::destroy($id);
    }
}