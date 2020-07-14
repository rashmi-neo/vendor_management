<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VendorQuotation extends Model
{
    use SoftDeletes;
    
    protected $table = 'vms_vendor_quatation';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'assign_vendor_id','comment','admin_comment','quatation_doc','status'
    ];
}
