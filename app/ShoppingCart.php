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
}
