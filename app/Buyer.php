<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\ShoppingCart;
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
}
