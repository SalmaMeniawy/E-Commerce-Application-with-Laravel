<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ["address_for_shipping","telephone_for_shipping",
        "total_order_items_quantity","total_order_price","order_items"];
}
