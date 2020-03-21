<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Buyer;
use App\Order;
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
        $product_quantity = [];
        $product_quantity = array_combine($product_id , $quantity_of_products);
        $products = Product::find($product_id);
        $total_for_each_prooduct = Order::calculate_total_price_for_each_product_order($products,$product_quantity);
        $total_for_order_before_coupon = Order::calculate_subtotal_price_for_all_products_in_order($total_for_each_prooduct);
        return view("buyer.order.create_order")
        ->with(compact(['products','product_quantity','total_for_order_before_coupon']));
       
    }
    public function create_order(Request $request){
        $products_id = $request->input('products_id') ;
        $quantity_of_products = $request->input('quantity');
        $data = ['product_id'=>$products_id,'quantity_of_products'=>$quantity_of_products];
        return route('create_new_order',$data);

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $request->validate([
            'tele' => 'required|integer',
            'street_no' =>'required|integer',
            'street_name' =>'required',
            'city' =>'required',
            
       ]);
        $product_id = array_keys($request->input('product_quantity'));
        $quantity = array_values($request->input('product_quantity'));
        $street_no = $request->input('street_no');
        $street_name = $request->input('street_name');
        $city = $request->input('city');
        $full_address = join('-', \array_wrap([$street_no,$street_name,$city]));//convert address data to one string
        $order_items = Order::get_the_count_of_items_in_order($quantity); //get_count of the order items
        dump($request->input());
        $buyer = Buyer::get()->where('user_id', auth()->id())->first();
        
        $order = Order::create([
            'telephone_for_shipping'=>$request->input('tele'),
            'total_order_price'=>$request->input('total_for_order_before_coupon'),
            'total_order_items_quantity' =>$order_items,
            'buyer_id'=>$buyer->id,
            'order_items' =>\json_encode($quantity) ,
            'address_for_shipping'=>$full_address,

        ]);
        
        $order->products()->sync(\json_encode($product_id));
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
