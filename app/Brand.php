<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Admin;
use App\Product;
class Brand extends Model
{
    protected $fillable = ['brand_name','admin_id'];
    public function admin(){
        return $this->belongsTo(Admin::class);
    }
    public function products(){
    	return $this->hasMany(Product::class);
    }
    public static function get_available_brands(){
         $brands =  Brand::all();
         return $brands;
    }
}
