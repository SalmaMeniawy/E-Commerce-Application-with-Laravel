<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
    	'coupon_name','number_of_usage','lifetime','coupon_persentage',
    	'coupon_price',
    ];
}
