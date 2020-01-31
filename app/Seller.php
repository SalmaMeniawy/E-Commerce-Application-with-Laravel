<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Product;
class Seller extends Model
{
    protected $fillable = ['fname','lname' ,'date_of_birth' , 'user_id'];
    public function user(){
        return $this->hasOne(User::class);
    }
    public function products(){
        return $this->hasMany(Product::class);
    }
}
