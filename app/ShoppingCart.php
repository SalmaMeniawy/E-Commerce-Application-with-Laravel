<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Brand;
class ShoppingCart extends Model
{
    protected $fillable = ['product_id','buyer_id','quantity'];
    public function buyer(){
        return $this->belongsTo(Brand::class);
    }
    public static function check_if_product_added_before_and_return_it(int $product_id){
           $product = ShoppingCart::get()->where('buyer_id',auth()->id())->where('product_id',$product_id)->first();
           if(isset($product)){
               return $product;
           }else{
               return null;
           }
    }
}
