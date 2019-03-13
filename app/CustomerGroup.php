<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerGroup extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'sub_group'
    ];

    public function customer() 
    {
    	return $this->belongsTo('App\Customer', 'id');
    }
}
