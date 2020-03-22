<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
        $buyer =Buyer::where('user_id', auth()->id())->first();
        $orders = $buyer->orders;
       
        return view('buyer.order.index_order')->with(compact(['orders']));
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
        $product_quantity = array_combine($product_id, $quantity_of_products);
        $products = Product::find($product_id);
        $total_for_each_prooduct = Order::calculate_total_price_for_each_product_order($products, $product_quantity);
        $total_for_order_before_coupon = Order::calculate_subtotal_price_for_all_products_in_order($total_for_each_prooduct);
        return view("buyer.order.create_order")
        ->with(compact(['products','product_quantity','total_for_order_before_coupon']));
    }
    public function create_order(Request $request)
    {
        $products_id = $request->input('products_id') ;
        $quantity_of_products = $request->input('quantity');
        $data = ['product_id'=>$products_id,'quantity_of_products'=>$quantity_of_products];
        return route('create_new_order', $data);
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
        $coupon_id_from_form =$request->input('coupon_id');
        // $coupon_id_from_form = (isset($request->input('coupon_id')))
        $order_price_after_coupon_value =$request->input('order_price_after_coupon_value');
        $street_no = $request->input('street_no');
        $street_name = $request->input('street_name');
        $city = $request->input('city');
        $full_address = join('-', \array_wrap([$street_no,$street_name,$city]));//convert address data to one string
        $order_items = Order::get_the_count_of_items_in_order($quantity); //get_count of the order items
        $buyer = Buyer::get()->where('user_id', auth()->id())->first();  
        $random_code_order_id_for_buyer =Str::random(7);

        $order = new Order();
        $order->telephone_for_shipping = $request->input('tele');
        $order->total_order_price = $request->input('total_for_order_before_coupon');
        $order->total_order_items_quantity = $order_items;
        $order->buyer_id = $buyer->id;
        $order->order_code_id_for_buyer =$random_code_order_id_for_buyer;
        $order->order_items =json_encode($quantity) ;
        $order->address_for_shipping = $full_address;
        if ($coupon_id_from_form != 0) {
            $order->coupon_id = $coupon_id_from_form;
            $order->order_price_after_coupon_value = $order_price_after_coupon_value;
            $order->save();
            $order->products()->sync(\json_encode($product_id));
            $buyer->shopping_cart->products()->sync("null");
            $buyer->shopping_cart->update(['product_quantity'=>null]);
        } else {
            $order->save();
            $order->products()->sync(\json_encode($product_id));
            $buyer->shopping_cart->products()->sync("null");
            $buyer->shopping_cart->update(['product_quantity'=>null]);
        }
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
