<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Bank extends Model
{
    //
    protected $table = 'bank';
    use  SoftDeletes;
    protected $dates = ['deleted_at'];
}
