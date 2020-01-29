<?php

namespace App\Http\Controllers\ShoppingCart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ShoppingCart;
use App\Product;
class ShoppingCartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shoppingCart = ShoppingCart::get()->where('buyer_id',auth()->id())[0];
        $product_quantity = json_decode($shoppingCart->product_quantity,true);
        $products_id = array_keys($product_quantity);
        $products = Product::find($products_id);
        $result = $shoppingCart->products()->where('product_id',$products_id)->get();
        dump($products);
      
        
        
        return view('buyer.shoppingCart.index_shoppingCart');
        // ->with('shoppingCartComponent',$shoppingCartComponent);
    }
    public function add_to_shopping_cart($product_id ){
        
        $product_quantity = ShoppingCart::get_product_id_from_shopping_cart();
        if(isset($product_quantity)){ //check if the return not empty
            if(array_key_exists($product_id,$product_quantity)){
                //to check if the product id exists before
                $product_quantity[$product_id] = $this->increase_product_quantity($product_quantity[$product_id]);
                //increase the existance value by one
                $shoppingCart = ShoppingCart::all()->where('buyer_id',auth()->id())->first();
                $shoppingCart->product_quantity = $product_quantity;
                $shoppingCart->save();
                //add products Id and buyer id in relational table
                $products_id = array_keys($product_quantity);
                $shoppingCart->products()->attach(json_encode($products_id));
                // return redirect()->back();
            }else{
                $product_quantity[$product_id] = 1;
                dump($product_quantity);
                $shoppingCartAll = ShoppingCart::all();
                $shoppingCart = $shoppingCartAll->where('buyer_id',auth()->id());
                // $shoppingCart = ShoppingCart::get()->where('buyer_id',auth()->id())[0];
                $shoppingCart->first()->product_quantity =json_encode( $product_quantity);
                // $shoppingCart->product_quantity =json_encode( $product_quantity);

                // $shoppingCart->->save();
                // $products_id = array_keys($product_quantity);
                // $shoppingCart->products()->attach(json_encode($products_id));

                // return redirect()->back();
            }
            
        }else{
            $product_quantity[$product_id] = 1;
            $shoppingCartAll = ShoppingCart::all();
            $shoppingCart = $shoppingCartAll->where('buyer_id',auth()->id())->first();
            $shoppingCart->product_quantity =json_encode( $product_quantity);
            $shoppingCart->save();
            $products_id = array_keys($product_quantity);
            $shoppingCart->products()->attach(json_encode($products_id));

            return redirect()->back();
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
