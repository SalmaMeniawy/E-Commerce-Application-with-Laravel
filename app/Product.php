<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\brand;
use App\Category;
class Product extends Model
{
    protected $fillable = ['title','description','price',
    'brand_id','category_id'];
    public function brand(){
        return $this->belongsTo(Brand::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
