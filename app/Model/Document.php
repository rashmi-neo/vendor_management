<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use SoftDeletes;

    protected $table = 'vms_documents';
    
    protected $fillable = [
        'name','is_mandetory'
    ];

}
