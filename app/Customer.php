<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use  SoftDeletes;
    protected $dates = ['deleted_at'];
    //
    protected $table = 'customers';

    protected $fillable = [
        'id', 'customer_name', 'handphone','address','is_deleted','updatedby_id','createdby_id','created_at','updated_at','deleted_at'
    ];

 }
