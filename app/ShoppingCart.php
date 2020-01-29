<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Buyer;
use App\Product;
class ShoppingCart extends Model
{
    protected $fillable = ['product_id','buyer_id','product_quantity'];
    public function buyer(){
        return $this->belongsTo(Buyer::class);
    }
   
    public static function get_products_id_from_shopping_cart(){
        $buyer = Buyer::all()->where('user_id',auth()->id())->first();
        $product_quantity = $buyer->shopping_cart->product_quantity;
        if($product_quantity != NULL){
        $product_quanyity_in_array = json_decode($product_quantity,true); //add true to convert string json to array ^^
            return $product_quanyity_in_array;
       
        }else{
            return null ;
        }
        
        // $shoppingCarts= ShoppingCart::all();
        // $shoppingCart= $shoppingCarts->where('buyer_id',auth()->id())->first();
        // $product_quantity = $shoppingCart->product_quantity;
       
        // $product_quanyity_in_array = json_decode($product_quantity,true); //add true to convert string json to array ^^
        // if(isset($product_quantity))
        // {
        //     return $product_quanyity_in_array;

        // }else{
        //     return null;
        // }
    }
    public static function check_if_product_added_before_and_return_it(int $product_id){
           $product = ShoppingCart::get()->where('buyer_id',auth()->id())->where('product_id',$product_id)->first();
           if(isset($product)){
               return $product;
           }else{
               return null;
           }
    }
    public  function get_items_count_in_shopping_cart(){
    //     $shoppingCartItems = ShoppingCart::get()->where('buyer_id',auth()->id())->first();
    //    $product_quantity= $shoppingCartItems->product_quantity;
    //    if($product_quantity == NULL){
    //        return 0;
    //    }else{
    //     $product_items_in_array =json_decode($shoppingCartItems->product_quantity,true);
    //     $product_items = sizeof($product_items_in_array);
    //     return (int)$product_items;
    //    }
    }
    public function products(){
        return $this->belongsToMany(Product::class);
    }
}
