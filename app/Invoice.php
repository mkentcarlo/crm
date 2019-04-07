<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoice';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invoice_type',
        'customer_id',
        'additional_fields',
        'total_amount',
        'invoice_no'
    ];

    public function invoice_detail() 
    {
    	return $this->hasMany('App\InvoiceDetail', 'invoice_id');
    }

    public function customer() 
    {
        return $this->belongsTo('App\Customer', 'customer_id');
    }
}
