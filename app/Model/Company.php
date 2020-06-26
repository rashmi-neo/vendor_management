<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
 
    protected $table = 'vms_company_details';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'vendor_id','company_name', 'address','state','city','pincode',
        'contact_number','fax','website'
    ];

}
