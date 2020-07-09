<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VendorCategory extends Model
{
    use SoftDeletes;
    
    protected $table = 'vms_vendor_categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'vendor_id','category_id'
    ];

    public function vendor() 
    {   
        return $this->belongsTo('App\Model\Vendor','vendor_id');
    }
 
    public function category() 
    {   
        return $this->belongsTo('App\Model\Category','category_id');
    }
 
}
