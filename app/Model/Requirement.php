<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Requirement extends Model
{
    use SoftDeletes;

    protected $table = 'vms_requirements';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id','code','title','description','proposal_document','comment',
        'status','from_date','to_date','priority','budget'
    ];

    public function assignVendor() 
    {   
     return $this->belongsToMany('App\Model\AssignVendor','requirement_id');
    }
    
    public function setPriorityAttribute($value)
    {
        $this->attributes['priority'] = strtolower($value);
    }

    public function getPriorityAttribute($value)
    {
        return ucfirst($value);
    }

    public function getTitleAttribute($value)
    {
        return ucfirst($value);
    }

    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = strtolower($value);
    }

    public function getStatusAttribute($value)
    {
        $value = str_replace("_"," ",$value);
        return ucfirst($value);
    }

    public function vendor()
    {
      return $this->belongsToMany('App\Model\Vendor','vms_assign_vendors','vendor_id','requirement_id');
    }
    
    public function category()
    {
      return $this->belongsTo('App\Model\Category','category_id');
    }

    public function reviewRating(){
        return $this->hasOne('App\Model\ReviewRating','requirement_id');
    }


    public function payment(){
        return $this->hasOne('App\Model\Payment','requirement_id');
    }

}
