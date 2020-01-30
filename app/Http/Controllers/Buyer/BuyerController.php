<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\ShoppingCart;
use App\Buyer;
class BuyerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //creat buyer homepage
        $products =  Product::all();
        return view('buyer.index_buyer')->with('products',$products);
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
     * Display the specified resource.
     *
     * @param  int  $product_id
     * @return \Illuminate\Http\Response
     */
    public function get_product_details($product_id){
        $product = Product::find($product_id);
        $product_category = $product->category->where('id',$product->category_id)->get()[0]->category_name;
        $product_brand = $product->brand->where('id',$product->brand_id)->get()[0]->brand_name;
        return view('buyer.show_product')->with('product',$product)
        ->with('product_category' ,$product_category)
        ->with('product_brand',$product_brand);
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
    public function get_shopping_cart_details(){
        $buyer = Buyer::all()->where('user_id',auth()->id())->first();
        $shoppingCart = $buyer->shopping_cart;
        $product_quantity = json_decode($shoppingCart->product_quantity,true);
        $products_ids = array_keys($product_quantity);
        $products = Product::find($products_ids); //get all products user add to shopping cart
        $quantity = array_values($product_quantity);
        \dump($products);
        dump($quantity);

       return view('buyer.shoppingCart.index_shoppingCart')
       ->with('products',$products)
       ->with('quantity',$quantity);
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
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
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
