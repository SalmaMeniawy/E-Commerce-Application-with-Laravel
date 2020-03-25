<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
use App\Buyer;
use App\Coupon; 
class Order extends Model
{
    protected $fillable = ["address_for_shipping","telephone_for_shipping",
        "total_order_items_quantity","total_order_price","order_items","buyer_id"
        ,"order_price_after_coupon_value","order_code_id_for_buyer"];
    public function products(){
        return $this->belongsToMany(Product::class)->withPivot('order_state_for_seller');
    }
    
    /**
     * function to merge the product ID  and quantity for reach product in one associtive array 
     */
    public static function add_product_ids_and_quantity_of_items_in_one_array($products_in_the_order , $order){
        $order_items_quantity = json_decode($order->order_items);
        $product_ids = [];
        foreach($products_in_the_order as $product){
            array_push($product_ids,$product->id);
        }
        $product_quantity  = array_combine($product_ids,$order_items_quantity);
        return $product_quantity;
    }
    /**
     * create decrease_product_quantity_in_the_stock function  to get order and decrease it is 
     * product items in this order in the stock by useing static method in decrease_product_quantity_in_the_stock_after_order
     * in product model
     */
    public function decrease_product_quantity_in_the_stock(){
        $products = $this->products;
        $product_quantity = self::add_product_ids_and_quantity_of_items_in_one_array($products , $this);
        $result_of_decrease = Product::decrease_product_quantity_in_the_stock_after_order($product_quantity);
      return $product_quantity;

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
