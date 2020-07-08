<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    
    protected $table = 'vms_documents';
    
    protected $fillable = [
        'name','is_mandetory'
    ];

    public function vendorDocument() 
    {   
        return $this->hasOne('App\Model\VendorDocument','document_id','id');
    }
    
}
