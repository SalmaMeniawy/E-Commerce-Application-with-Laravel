<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
    	'coupon_name','number_of_usage','lifetime','coupon_persentage',
    	'coupon_price',
    ];
	/**
     * 
     *get_persentage to convert user input from float 
     		to persntage as string
     * 
     *  
     */
    public static function get_persentage($float_value_for_coupon_from_user){
        return round((float)$float_value_for_coupon_from_user * 100)."%";
    }
}
