<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Store;
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
    public function store(){
        return $this->hasOne(Store::class);
    }
    /**
     * function that return all seller orders 
     * @return array with all seller orders
     */
    public function get_all_seller_orders(){
        $orders = Order::all();
        $seller_orders = [];
        foreach($orders as $order){
            foreach($order->products as $product){
               
                if($product->seller_id == $this->id){
                    array_push($seller_orders,$order);
                } 
            }
        }
        return $seller_orders;
    }
    /**
     * function to return count of products in orders that need to confirm
     */
    public function get_count_of_pending_products_in_the_orders(){
        $seller = Seller::where('user_id',auth()->id())->first();
        $orders = $seller->get_all_seller_orders(); 
        $pending_orders = 0;
        foreach($orders as $order){
            foreach($order->products as $product){
                if($product->pivot->order_state_for_seller == "Pending"){
                    $pending_orders = $pending_orders + 1;
                }
            }
        }
        return $pending_orders;
    }
}
