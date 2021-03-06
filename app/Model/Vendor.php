<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Vendor extends Model
{
    use SoftDeletes;

    protected $table = 'vms_vendors';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','first_name','middle_name','last_name','mobile_number','profile_image'
    ];

    /**
     * Get the Vendor Firstname.
     *
     * @param  string  $value
     * @return string
     */
    public function getFirstNameAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * Get the Vendor Middlename.
     *
     * @param  string  $value
     * @return string
     */
    public function getMiddleNameAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * Get the Vendor Lastname.
     *
     * @param  string  $value
     * @return string
     */
    public function getLastNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function category()
    {
        return $this->hasOne('App\Model\VendorCategory','vendor_id');
    }

    public function vendorCategory()
    {
        return $this->hasMany('App\Model\VendorCategory','vendor_id');
    }

    public function company()
    {
        return $this->hasOne('App\Model\Company','vendor_id');
    }
    public function user()
    {
     return $this->belongsTo('App\User','user_id');
    }

    public function vendorDocument()
    {
     return $this->hasOne('App\Model\VendorDocument','vendor_id');
    }

    public function assignVendor()
    {
        return $this->hasMany('App\Model\AssignVendor','vendor_id');
    }

    public function requirements()
    {
        return $this->hasManyThrough('App\Model\Requirement','App\Model\AssignVendor','requirement_id','id');
    }

    public function requirement()
    {
        return $this->belongsToMany('App\Model\Requirement','vms_assign_vendors','vendor_id','requirement_id');
    }

    public function document()
    {
      return $this->hasMany('App\Model\VendorDocument','vendor_id');
    }
}
