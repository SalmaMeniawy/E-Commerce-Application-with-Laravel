<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\ShoppingCart;
class CreateShoppingCartIfNotExist extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $shoppingCart = ShoppingCart::get()->where('buyer_id',auth()->id());
        if(!isset($shoppingCart)){
            $shoppingCart = new ShoppingCart;
            $shoppingCart->buyer_id = auth()->id();
            $shoppingCart->save();
            return $shoppingCart;

        }
    }
}
