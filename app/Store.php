<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Admin;
use App\Seller;
use App\Product;
class Store extends Model
{
    protected $fillable = ['store_name' , 'sammary','admin_id','seller_id'];
    public function admin(){
        return $this->belongsTo(Admin::class);
    }
    public function seller(){
        return $this->belongsTo(Seller::class);
    }
    public function products(){
        return $this->hasMany(Product::class);
    }
}
