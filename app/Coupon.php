<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Admin;
use App\Buyer;
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
     * eloquent relation with Buyer model 
     */
    public function buyers(){
        return $this->hasMany(Buyer::class);
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
