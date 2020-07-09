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

    public function category()
    {
        return $this->hasOne('App\Model\VendorCategory','vendor_id');
    }

    public function vendorCategory()
    {
        return $this->hasOne('App\Model\VendorCategory','vendor_id');
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
    public function requirement()
    {
        return $this->belongsToMany('App\Model\Requirement','vms_assign_vendors','vendor_id','requirement_id');
    }
}
