<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\brand;
use App\Category;
use App\Seller;
class Product extends Model
{
    protected $fillable = ['title','description','price',
    'brand_id','category_id','seller_id','in_stock_quantity'];
    public function brand(){
        return $this->belongsTo(Brand::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function seller(){
        return $this->belongsTo(Seller::class);
    }
}
