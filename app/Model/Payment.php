<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'vms_payments';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'vendor_id','requirement_id','receipt','amount','payment_date'
    ];

    public function requirement() 
    {   
        return $this->belongsTo('App\Model\Requirement','requirement_id','id');
    }
    
    public function vendor() 
    {   
        return $this->belongsTo('App\Model\Vendor','vendor_id','id');
    }
}
