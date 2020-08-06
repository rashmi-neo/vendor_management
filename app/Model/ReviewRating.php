<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ReviewRating extends Model
{
    protected $table = 'vms_reviews_and_ratings';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'requirement_id','vendor_id','rating','review'
    ];


    /**
     * Get the Review.
     *
     * @param  string  $value
     * @return string
     */
    public function getReviewAttribute($value)
    {
        return ucfirst($value);
    }

    public function requirement() 
    {   
        return $this->belongsTo('App\Model\Requirement','requirement_id','id');
    }
    
    public function vendor() 
    {   
        return $this->belongsTo('App\Model\Vendor','vendor_id','id');
    }
}
