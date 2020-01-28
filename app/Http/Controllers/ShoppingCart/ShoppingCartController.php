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

        // $shoppingCartComponent = ShoppingCart::get()->where('buyer_id',auth()->id());
        // dump($shoppingCartComponent);
        // $shoppingCartComponent = ShoppingCart::all();
        $shoppingCart = ShoppingCart::get()->where('buyer_id',auth()->id())[0];
        $products_in_shoppind_cart = ShoppingCart::where('buyer_id',auth()->id())->get('product_id');
        // dump($products_in_shoppind_cart);
        $products_titles = $shoppingCart->products();
        // ->where($products_in_shoppind_cart);
        dump($products_titles);
        
        return view('buyer.shoppingCart.index_shoppingCart')->with('products_titles',$products_titles);
        // ->with('shoppingCartComponent',$shoppingCartComponent);
    }
    public function add_to_shopping_cart($product_id ){
        // $product_quantity = [$product_id => 1];
        $product_quantity = ShoppingCart::get_product_id_from_shopping_cart();
        if(isset($product_quantity)){ //check if the return not empty
            if(array_key_exists($product_id,$product_quantity)){
                //to check if the product id exists before
                $product_quantity[$product_id] = $this->increase_product_quantity($product_quantity[$product_id]);
                //increase the existance value by one
                $shoppingCart = ShoppingCart::get()->where('buyer_id',auth()->id())[0];
                $shoppingCart->product_quantity = $product_quantity;
                $shoppingCart->save();
                
            }
            // array_push($product_quantity,[])
            // dump($product_quantity);
        }
       
        // $shoppingCart = ShoppingCart::create([
        //     'buyer_id' => auth()->id(),
        //     'product_quantity' => json_encode($product_quantity),
        // ]);
        // $shoppingCart->products()->attach(json_encode($product_id));
        // return redirect()->back();
        ////////////////////////
    //     $result_of_check = ShoppingCart::check_if_product_added_before_and_return_it($product_id);
    //     if(!isset($result_of_check)){

        
    //             $shoppingCart = ShoppingCart::create([
    //                 'product_id'=> $product_id,
    //                 'buyer_id' => auth()->id(),

    //             ]);
    //             $shoppingCart->products()->attach($product_id);
    //             $shoppingCart->save();
    //             return redirect()->back();
    //     }else{
    //         $old_quantity = $result_of_check->quantity;
    //         $result_of_check->quantity =  $this->increase_product_quantity($old_quantity);
    //         $result_of_check->save();
    //         return redirect()->back()->with('old',$result_of_check);
    //   }
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
