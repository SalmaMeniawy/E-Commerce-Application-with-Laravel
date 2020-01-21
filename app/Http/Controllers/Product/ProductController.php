<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Brand;
use App\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
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
            'in_stock_quantity' =>'required|max:500|min:10',
            'price'=>'required'
            ]
        );
        $product = Product::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'in_stock_quantity' => $request->input('in_stock_quantity'),
            'brand_id'=>$request->input('brand_id'),
            'category_id'=>$request->input('category_id'),
            'seller_id' =>auth()->id(),
            'price' => $request->input('price'),
        ]);
        return redirect()->route('product.index');
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
        $product_category = $product->category->where('id',$product->category_id)->get();
        $product_category_name = $product_category[0]->category_name;
        return view('seller.product.show_product')
        ->with('product',$product)->with('product_category_name',$product_category_name);

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
