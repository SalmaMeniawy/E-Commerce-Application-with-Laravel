<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Brand;
use App\Store;
class Admin extends Model
{
    protected $fillable = ['fname','lname','date_of_birth','user_id'];
    public function user(){
        return $this->hasOne(User::class);
    }
    public function brands(){
    	return $this->hasMany(Brand::class);
    }
    public function stores(){
        return $this->hasMany(Store::class);
    }
}
