<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'contact',
        'group_id',
        'street_address',
        'city',
        'postal_code',
        'state',
        'country'
    ];

    public function group() 
    {
    	return $this->belongsTo('App\CustomerGroup', 'group_id');
    }
}
