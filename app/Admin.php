<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Brand;
use App\Store;
use App\Category;
use App\Coupon;
class Admin extends Model
{
    protected $fillable = ['fname','lname','user_id'];
    public function user(){
        return $this->hasOne(User::class);
    }
    public function brands(){
    	return $this->hasMany(Brand::class);
    }
    public function stores(){
        return $this->hasMany(Store::class);
    }
    public function categories(){
        return $this->hasMany(Category::class);
    }
    public function coupons(){
        return $this->hasMany(Coupon::class);
    }
}
