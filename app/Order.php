<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
class Order extends Model
{
    protected $fillable = ["address_for_shipping","telephone_for_shipping",
        "total_order_items_quantity","total_order_price","order_items"];
    public function products(){
        return $this->belongsToMany(Product::class);
    }
    public static function calculate_total_price_for_each_product_order($products,array $product_quantity){
        $calculation_result = [];
        foreach($products as $product)
        {
            if($product->in_stock_quantity > 0){
                $result = $product->price * $product_quantity[$product->id];
                $calculation_result[$product->id] = $result;
            }
           
        }
       
        return $calculation_result;
    }
}
