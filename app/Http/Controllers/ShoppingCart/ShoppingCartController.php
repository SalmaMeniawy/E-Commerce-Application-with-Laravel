<?php

namespace App\Http\Controllers\ShoppingCart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ShoppingCart;

class ShoppingCartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function add_to_shopping_cart($product_id ){
        $result_of_check = ShoppingCart::check_if_product_added_before_and_return_it($product_id);
        if($result_of_check == TRUE){

        
                $shoppingCart = ShoppingCart::create([
                    'product_id'=> $product_id,
                    'buyer_id' => auth()->id(),

                ]);
                return redirect()->back();
        }else{
            $old_quantity = $result_of_check[0]->quantity;
            $result_of_check[0]->quantity =  $this->increase_product_quantity($old_quantity);
            $result_of_check[0]->save();
            return redirect()->back()->with('old',$result_of_check);
      }
    }
    public function increase_product_quantity(int $product_quantity){
        $product_quantity = $product_quantity + 1;
        return $product_quantity;
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
