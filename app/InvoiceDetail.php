<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    protected $table = 'invoice_detail';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invoice_id',
        'product_id',
        'product_name',
        'featured_src',
        'price',
        'brand_name',
        'category_name',
        'quantity',
        'total_amount'
    ];

    public function invoice() 
    {
    	return $this->belongsTo('App\Invoice', 'invoice_id');
    }
}
