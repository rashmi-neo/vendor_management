<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    protected $table = 'vms_notifications';
    protected $fillable = ['user_id','title','text','type','status'];
}
