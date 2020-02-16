<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Buyer;
class BuyerCategory extends Model
{
    protected $fillable = ['buyer_category_name'];
    public function buyers(){
        return $this->hasMany(Buyer::class);
    }
}
