<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Admin;
class Coupon extends Model
{
    protected $fillable = [
    	'coupon_name','number_of_usage','lifetime','coupon_persentage',
    	'coupon_price','admin_id',
    ];
    public function admin(){
        return $this->belongsTo(Admin::class);
    }
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
