<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
use App\Buyer;
use App\Coupon; 
class Order extends Model
{
    protected $fillable = ["address_for_shipping","telephone_for_shipping",
        "total_order_items_quantity","total_order_price","order_items","buyer_id","order_price_after_coupon_value"];
    public function products(){
        return $this->belongsToMany(Product::class);
    }
    /**
     * eloquent relation function with Buyer model
     */
    public function buyer(){
        return $this->belongsTo(Buyer::class);
    }
    /**
     * eloquent relation function with Coupon model
     */
    public function coupon(){
        return $this->hasOne(Coupon::class);
    }
    /**
     * create calculate_total_price_for_each_product_order to get total price for
     * each product if it is available in the Stock
     */
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
    /**
     * create calculate_subtotal_price_for_all_products_in_order to calculate total price of the order
     * before Coupon
     */
    public static function calculate_subtotal_price_for_all_products_in_order($product_individual_totlal){
        $result = 0;
        foreach($product_individual_totlal as $total_item){
            $result = $result + $total_item;
        }
        return (float)$result;

    }
    /**
     * create this function to get all Order items in the order
     */
    public static function get_the_count_of_items_in_order($quantity_in_order_for_all_products){
        $order_items_count = 0;
        foreach($quantity_in_order_for_all_products as $item){
            $order_items_count = $order_items_count + $item;

        }
        return $order_items_count;
    }
}
