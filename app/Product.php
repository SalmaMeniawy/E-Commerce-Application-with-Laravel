<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\brand;
class Product extends Model
{
    protected $fillable = ['title','description','price'];
    public function brand(){
        return $this->belongTo(Brand::class);
    }
}
