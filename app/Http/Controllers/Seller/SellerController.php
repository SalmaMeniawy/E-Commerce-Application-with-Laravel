<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Order;
use App\Product;
use App\Seller;
class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $seller = Seller::where('user_id',auth()->id())->first();
        $orders = $seller->get_all_seller_orders(); //get_seller_orders
        // $product_quantity_for_each_order = [];
        // $product_ids = [];
        // $order_items_quantity=[];
        // foreach($orders as $order){
        //     // $order_items_quantity[$order->id] = \json_decode($order->order_items);

        //     foreach($order->products->unique() as $product){
        //         array_push($product_ids,$product->id);
        //     }
        //     // $order_items_quantity[$order->id] = array_combine();

        //     // \dump($product_ids,$order_items_quantity);
        //     // dump($product_quantity = array_combine($product_ids,$order_items_quantity));

        // // $product_quantity_for_each_order[$order->id] = array_combine($product_ids,$order_items_quantity);
        // }
        // // \dump($product_quantity);
        // dump($product_ids,$order_items_quantity);

        // dump($product_quantity_for_each_order);
        return view('seller.order.index_notify_orders')->with(\compact(['orders'])) ;
       
        
      
    }
    /**
     * create confirm_product to change product status in pivot table to be confirmed rather than 
     * pending state
     */
    public function confirm_product(Request $request){
        $order_id = $request->input('order_id');
        $product_id = $request->input('product_id');
        $order = Order::find($order_id);
        $order->confirm_product($product_id);
        
        return redirect()->back();
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('seller.home_seller');
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
