<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;
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
        return view('admin.store.index_store')->with('stores',$stores);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.store.create_store');
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
        Store::create([
           'store_name'  => $request->input('store_name'),
            'sammary' => $request->input('sammary'),
        ]);
        
    }

    public function home(){
        return view('admin.home');
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
        $stores->delete();
        return redirect()->view('admin.store.index_store');
    }
}
