<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
class OrderController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {   
        $product_id = $request->input('product_id');
        $quantity_of_products = $request->input('quantity_of_products');
        $products = Product::find($product_id);
        return view("buyer.order.create_order");
       
    }
    public function create_order(Request $request){
        $products_id = $request->input('products_id') ;
        $quantity_of_products = $request->input('quantity');
        $data = ['product_id'=>$products_id,'quantity_of_products'=>$quantity_of_products];
        // return view("buyer.order.create_order")->with(compact(['products_id',"quantity_of_products","products"]));
        return route('create_new_order',$data);
        // return route('create_new_order',['salamonty'=>'hello']);

        // ->with(compact(['products_id',"quantity_of_products","products"]));
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
