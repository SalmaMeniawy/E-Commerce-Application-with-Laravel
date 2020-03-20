<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\ShoppingCart;
use App\BuyerCategory;
use App\Coupon;
use App\Order;
class Buyer extends Model
{
    protected $fillable = ['fname','lname','date_of_birth' 
    ,'user_id','coupon_id','coupon_uses_number'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function shopping_cart(){
        return $this->hasOne(ShoppingCart::class);
    }
    /**
     * eloquent relation function with Order model
     */
    public function orders(){
        return $this->hasMany(Order::class);
    }
    /**
     * eloquent relation function with Coupon model
     */
    public function coupon(){
        return $this->belongsTo(Coupon::class);
    }
    /**
     * eloquent relation function with BuyerCategory model
     */
    public function buyerCategory(){
        return $this->belongsTo(BuyerCategory::class);
    }
    /**
     * function to check the number of coupon_uses_number 
     * for each user 
     */
    public static function check_coupon_uses_number(){
        $buyer = Buyer::where('user_id',auth()->id())->get()->first();
            if($buyer->coupon_uses_number > 0){
                //use method in coupon model to check the lifetime  for coupon
                $checkLifeTime = $buyer->coupon->check_validation_lifeTime_for_coupon();
                 if($checkLifeTime){
                     return $buyer;
                 }else{
                     return null;
                 }
             }else{
                 return null;
             }     
       
    }
    /**
     * static fucnction to get buyer coupon hash
     */
    // public static function get_buyer_coupon_hash(){
    //     $buyer = Buyer::where('user_id',auth()->id())->get()->first();
    //     if(isset($buyer->coupon->hash_id)){
    //         return $buyer->coupon->hash_id;
    //     }

    // }
    /**
     * function to decrese the number of usage for coupon 
     * when buyer use it
     */
   public static function decrease_coupon_uses_number(){
        $buyer = self::check_coupon_uses_number();
        if(isset($buyer)){
            $buyer->coupon_uses_number =  $buyer->coupon_uses_number - 1;
            $buyer->save();
            return true;
        }else{
            return false;
        }
      

   }
}
