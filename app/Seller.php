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
}
