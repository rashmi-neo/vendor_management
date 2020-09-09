<?php 

namespace App\Repositories\Category;
use Illuminate\Http\Request;

interface CategoryInterface{ 
	
	/**
     * Get's a category by it's ID
     *
     * @param int
     */
    public function get($id);


	/**
     * Get's all category.
     *
     *@Author Pooja <pooja.lavhat@neosofttech.com>
     * @return void
     */
    public function all();


    /**
     * Save a category.
     *
     * @param array
     */
    public function save(array $data);

    /**
     * Updates a category.
     *
     * @param int
     * @param array
     */
    public function update($id,array $data);

    /**
     * Deletes a category.
     *
     * @param int
     */
    public function delete($id);
}