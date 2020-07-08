<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VendorDocument extends Model
{
    use SoftDeletes;
    
    protected $table = 'vms_vendor_document';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'vendor_id','document_id','file_name','reason','status','is_uploded'
    ];

    public function document() 
    {   
     return $this->belongsTo('App\Model\Document','document_id');
    }
}
