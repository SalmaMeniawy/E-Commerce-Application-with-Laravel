<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\ShoppingCart;
use App\Buyer;
use App\BuyerCategory;
use App\Coupon;
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
    public function get_coupon_details(){
        
    }
    /**
     * function to get all shopping cart details related
     * to the buyer and display it in there own page
     */
    public function get_shopping_cart_details(){
        $buyer = Buyer::all()->where('user_id',auth()->id())->first();
        $shoppingCart = $buyer->shopping_cart;
        $product_quantity = json_decode($shoppingCart->product_quantity,true);
        if(isset($product_quantity)){
                $products_ids = array_keys($product_quantity);
                $products = Product::find($products_ids); //get all products user add to shopping cart
                $calculation_result_for_item_price = ShoppingCart::calculate_total_price_for_each_product($products,$product_quantity);
                $in_stock_result = ShoppingCart::check_product_quantity_stock($products);
                $total_price_for_shopping_cart = ShoppingCart::calculate_subtotal_price_for_all_products($calculation_result_for_item_price);
               return view('buyer.shoppingCart.index_shoppingCart')
               ->with('products',$products)
               ->with('product_quantity',$product_quantity)
               ->with('calculation_item_price',$calculation_result_for_item_price)
               ->with('in_stock_state',$in_stock_result)
               ->with('total_price_for_shopping_cart',$total_price_for_shopping_cart);
        }else{
            return view('buyer.shoppingCart.empty_shopping_cart')
            ->with('empty_shopping_cart',"the shopping cart is empty");
           
        }
    
    }
    /**
     * function to get Coupon details for each buyer
     */
    public function get_coupoun_details(){
        $buyer = Buyer::get()->where('user_id',auth()->id())->first();
        $buyer_coupon = $buyer->coupon;
        if($buyer->buyerCategory == null){
            $normal_buyer_category = BuyerCategory::get()->where('buyer_category_name','Normal')->first();
            $normal_buyer_category->buyers()->save($buyer);
        }
        if(isset($buyer_coupon)){
             //get coupon persntage in "%" way 
             $buyer_coupon_persentage = Coupon::get_persentage($buyer_coupon->coupon_persentage);
             if($buyer_coupon->validate_state == 1 && $buyer->coupon_uses_number > 0){
                return view('buyer.buyerCoupon.show_buyer_coupon')->with('buyer',$buyer)
                  ->with('buyer_coupon',$buyer_coupon)
                  ->with('buyer_coupon_persentage',$buyer_coupon_persentage);
              }
        }//buyer doesn 't have coupon
        else{
            return view('buyer.buyerCoupon.unavailable_coupon')
            ->with('notfound_coupon',"there is no available Coupons");
        }
       
    }
    /**
     * 
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
    /**
     * function to get coupon by hash from the eloquent relation
     */
    public function get_coupon_to_buyer($coupon_hash){
        $buyer = Buyer::where("user_id",auth()->id())->get()->first();
        $coupon = $buyer->coupon->where('hash_id',$coupon_hash)->get()->first();
        if(isset($coupon)){
            return $coupon;
        }else{
            return false;
        }
    }
}
