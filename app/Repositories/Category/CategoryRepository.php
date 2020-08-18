<?php

namespace App\Repositories\Category;
use App\Model\Category;
use App\Repositories\Category\CategoryInterface;

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
     *@return $category
     */
    public function all()
    {
    	$category = Category::orderBy('id', 'desc')->get();
    	return $category;
    }

    /**
     * Save a category.
     *
     * @Author Pooja <pooja.lavhat@neosofttech.com>
     * @param  $data
     * @return collection
     */
    public function save(array $data)
    {
    	return Category::create($data);
    }

    /**
     * Updates a category.
     *
     * @param int
     * @param collection
     */
    public function update($id,array $data)
    {
        return Category::find($id)->update($data);
    }

    /**
     * Deletes a category.
     *
     * @Author Pooja <pooja.lavhat@neosofttech.com>
     * @param collection
     */
    public function delete($id)
    {
        return Category::destroy($id);
    }
}