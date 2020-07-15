<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    protected $table = 'vms_notifications';
    protected $fillable = ['user_id','title','text','type','status'];

    /**
     * Get the Status.
     *
     * @param  string  $value
     * @return string
     */
    public function getTypeAttribute($value)
    {
        $value = str_replace("_"," ",$value);
        return ucfirst($value);
    }
}
