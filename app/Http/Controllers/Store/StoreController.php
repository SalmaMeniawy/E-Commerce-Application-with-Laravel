<?php

namespace App\Http\Controllers\Store;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Store;
use App\Seller;
class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = Store::all();
        $failure = 'There is no Stores available ';
        if(isset($stores) ){
                    return view('admin.store.index_store')->with('stores',$stores);
        }else{
        return redirect()->route('store.index')->compact('failure',$failure);
            
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sellers = Seller::all();
        return view('admin.store.create_store')->with('sellers',$sellers);
    }
    public function get_all_sellers(){
        return Seller::all();
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
            'store_name' => 'required|unique:stores|alpha_num|max:125',
            'sammary' => 'required|between:10,200',
            
        ]);
        $seller = Seller::find($request->input('seller'));
        $seller->store()->create([
            'store_name'  => $request->input('store_name'),
            'sammary' => $request->input('sammary'),
            'admin_id' => auth()->id(),

        ]);
        $seller->save();
        if(isset($store)){
            return redirect()->route('store.index');
                
        }else{
            return redirect()->route('store.create');
        }
    }

    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($store_id)
    {
        $store = Store::find($store_id);
        return view('admin.store.show_store')->with('store',$store);
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
    public function destroy($store_id)
    {
        $store = Store::find($store_id);
        $store->delete();
        return redirect()->route('store.index');
    }
}
