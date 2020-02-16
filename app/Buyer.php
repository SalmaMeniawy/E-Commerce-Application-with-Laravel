<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\ShoppingCart;
use App\BuyerCategory;
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

}
