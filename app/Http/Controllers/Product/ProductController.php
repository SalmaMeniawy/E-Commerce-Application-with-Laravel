<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Brand;
use App\Category;
use App\Seller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seller = Seller::where('user_id',auth()->id())->first();
        $products = Product::where('seller_id',$seller->id)->get();
        return view('seller.product.index_product')->with('products',$products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::get_available_brands();
        $categories = Category::all();
        return view('seller.product.create_product')->with('brands',$brands)->with('categories',$categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
            'title'=>'required|unique:products|min:3|max:25',
            'description'=>'required|max:110',
            'in_stock_quantity' =>'required|max:500',
            'image' => 'required|image|mimes:jpeg,png,jpg',
            'price'=>'required'
            ]
        );
        $seller = Seller::get()->where('user_id',auth()->id())->first();
        $store = $seller->store;
        $store->products()->create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'in_stock_quantity' => $request->input('in_stock_quantity'),
            'brand_id'=>$request->input('brand_id'),
            'category_id'=>$request->input('category_id'),
            'seller_id' =>$seller->id,

            'price' => $request->input('price'),
        ]);
        
        $store->save();
       $size = \sizeof($store->products) - 1;
       $product = $store->products[$size];
       
        $image = $request->file('image');
        $name = $product->id.'.'.$image->extension();
        $destination = public_path('/productImages');
        $image->move($destination,$name);
        $product->image = $name;
        $product->save();
       
    
            return redirect()->action('Product\ProductController@index');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($product_id)
    {
        $product = Product::find($product_id);
        $product_category_name = $product->category->where('id',$product->category_id)->get()[0]->category_name;
        $product_brand_name = $product->brand->where('id',$product->brand_id)->get()[0]->brand_name;
        return view('seller.product.show_product')
        ->with('product',$product)->with('product_category_name',$product_category_name)
        ->with('product_brand_name',$product_brand_name);

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
    public function destroy($product_id)
    {
        $product = Product::find($product_id);
        $destination = public_path('/productImages');
        $path = public_path("/productImages/$product->image");
        if(unlink($path)){
            $product->delete();
            return redirect()->route('product.index');

        }
       
    }
}
