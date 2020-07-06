<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $table = 'vms_categories';


    protected $fillable = [
        'name','status'
    ];

    public function vendorCategory() 
    {   
     return $this->hasOne('App\Model\VendorCategory','category_id');
    }

}
