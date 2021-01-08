<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderDt extends Model
{
    //
    protected $table = 'purchase_order_dt';

    protected $fillable = [
        'id', 'purchase_order_id', 'product_id','sc_colorid','quantity_request','perunit_amount','deleted_at','created_at','updated_at'
    ];
}
