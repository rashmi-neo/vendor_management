<?php

namespace App\Repositories;
use App\Model\Category;

class CategoryRepository implements CategoryInterface{


	/**
     * Get's a category by it's ID
     *
     * @param int
     * @return collection
     */
    public function get($id)
    {
        return Category::find($id);
    }


    /**
     * Get's all category.
     *
     *@Author Pooja <pooja.lavhat@neosofttech.com>
     *@param  void
     *@return $product
     */
    public function all()
    {
    	$category = Category::all();
    	return $category
    }


    /**
     * Save a category.
     *
     * @Author Pooja <pooja.lavhat@neosofttech.com>
     * @param  $data
     * @return $category
     */
    public function save($data)
    {
    	Category::create($data);
    }


    /**
     * Updates a category.
     *
     * @param int
     * @param array
     */
    public function update($id, array $data)
    {
        Category::find($id)->update($data);
    }

    /**
     * Deletes a category.
     *
     * @Author Pooja <pooja.lavhat@neosofttech.com>
     * @param int
     */
    public function delete($id)
    {
        Category::destroy($id)
    }
}