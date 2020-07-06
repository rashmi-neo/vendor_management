<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class AssignVendor extends Model
{
    use SoftDeletes;
    
    protected $table = 'vms_assign_vendors';
    
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'vendor_id','requirement_id'
    ];
}
