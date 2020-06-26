<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use SoftDeletes;
      
    protected $fillable = [
        'user_id','first_name','middle_name','last_name','mobile_number','profile_image'
    ];
}
