<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Requirement extends Model
{
    use SoftDeletes;

    protected $table = 'vms_requirements';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id','code','title','description','proposal_document','comment',
        'status','from_date','to_date','priority','budget'
    ];
    public function vendor()
    {
      return $this->belongsToMany('App\Model\Vendor','vms_assign_vendors','vendor_id','requirement_id');
    }
    public function category()
    {
      return $this->belongsTo('App\Model\Category','category_id');
    }
}
