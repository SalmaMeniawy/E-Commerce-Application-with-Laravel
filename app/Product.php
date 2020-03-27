<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Brand;
use App\Category;
use App\Seller;
use App\ShoppingCart;
use App\Store;
use App\Order;
class Product extends Model
{
    protected $fillable = ['title','description','price',
    'brand_id','category_id','seller_id','in_stock_quantity','image','store_id'];
    public function brand(){
        return $this->belongsTo(Brand::class);
    }
    public function orders(){
        return $this->belongsToMany(Order::class)->withPivot('order_state_for_seller');
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function seller(){
        return $this->belongsTo(Seller::class);
    }
    public function shoppingCarts(){
        return $this->belongsToMany(ShoppingCart::class);
    }
    public function store(){
        return $this->belongsTo(Store::class);
    }
   public static function decrease_product_quantity_in_the_stock_after_order($product_quantity){
    $product_ids = array_keys($product_quantity);
    $products = self::find($product_ids);
    foreach($products as $product){
        if($product->in_stock_quantity > 0){
            $product->in_stock_quantity = $product->in_stock_quantity -1 ;
            $product->save();
        }
    }

   }
   /**
    * create check_if_the_stock_greater_than_order_quantity to remove from product quantity any 
    * product that the_stock quantity less than the order
    */
   public static function check_if_the_stock_greater_than_order_quantity($product_quantity){
    $product_ids = array_keys($product_quantity);
    $products = self::find($product_ids);
    foreach($products as $product){
        if($product->in_stock_quantity >=  $product_quantity[$product->id]){
            $check_result[$product->id] = true;
        }else{
            unset($product_quantity[$product->id]);
        }
    }
    return $product_quantity;
   }
}
