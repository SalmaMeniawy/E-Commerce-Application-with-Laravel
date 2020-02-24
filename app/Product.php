<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Brand;
use App\Category;
use App\Seller;
use App\ShoppingCart;
class Product extends Model
{
    protected $fillable = ['title','description','price',
    'brand_id','category_id','seller_id','in_stock_quantity','image'];
    public function brand(){
        return $this->belongsTo(Brand::class);
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
    
}
