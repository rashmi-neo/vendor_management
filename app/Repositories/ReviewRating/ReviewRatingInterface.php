<?php

namespace App\Repositories\ReviewRating;
use Illuminate\Http\Request;

interface ReviewRatingInterface{

	/**
     * Get's all ratings and reviews.
     *
     *@Author bharati <bharati.tadvi@neosofttech.com>
     * @return void
     */
    public function all();

    /**
     * Save a review and rating.
     *@Author bharati <bharati.tadvi@neosofttech.com>
     * 
     * @param $data
     */
    public function save($data);


    /**
     * Get review and rating as per vendor.
     *@Author bharati <bharati.tadvi@neosofttech.com>
     * 
     * @param $data
    */
    public function getVendorRating($data);

    /**
     * Find review and rating.
     *@Author bharati <bharati.tadvi@neosofttech.com>
     * 
     * @param $id
    */
    public function find($id);
}
