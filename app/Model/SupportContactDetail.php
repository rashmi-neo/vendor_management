<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupportContactDetail extends Model
{
    use SoftDeletes;
    
    protected $table = 'vms_support_contact_details';
    
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
       'vendor_id','contact_person','phone_number','email'
   ];
}
