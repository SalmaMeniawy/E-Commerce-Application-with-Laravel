<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Admin;
use App\Buyer;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class Coupon extends Model
{
    protected $fillable = [
    	'coupon_name','number_of_usage','lifetime','coupon_persentage',
    	'coupon_price','admin_id','hash_id',
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
     * fucntion to check if the lifeTime for coupon is available or no
     */
    public  function check_lifeTime_for_coupon($coupon){
        $life_time_for_coupon = Carbon::parse($this->lifetime);
        if($life_time_for_coupon > now()){
            return true;
        }else{
            $this->validate_state = 0;
            $this->save();
            return false;
        }
    }
    /***
     * function to generate new hash_id for each coupon
     * when create it
     */
    public static function set_hash_id_for_each_coupon(){
        $result = Str::random(16);
        return $result;


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
