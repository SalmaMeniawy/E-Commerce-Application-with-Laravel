<?php

namespace App\Http\Controllers\Coupon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Coupon;
class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::all();
        return view('admin.coupon.index_coupon')->with('coupons',$coupons);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.coupon.create_coupon');
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
            'coupon_name' => 'required|min:3|max:25|unique:coupons|alpha_num',
            'number_of_usage' => 'numeric|min:5|max:20|required',
            'lifetime' => 'required_with:coupon_name',
            'coupon_persentage' => 'nullable|required_with:lifetime',
            'coupon_price'=>'nullable',
        ]);
        $coupon = Coupon::create([
            'coupon_name' => $request->input('coupon_name'),
            'number_of_usage' => $request->input('number_of_usage'),
            'lifetime' => $request->input('lifetime'),
            'coupon_persentage' => $request->input('coupon_persentage'),
            'coupon_price' => $request->input('coupon_price'),
            'admin_id' => auth()->id(),
        ]);
       return redirect()->route('coupon.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($coupon_id)
    {
        $coupon = Coupon::find($coupon_id);
        $coupon_input_from_user_in_float = $coupon->coupon_persentage;
        $coupon->coupon_persentage = Coupon::get_persentage($coupon_input_from_user_in_float);
        
        return view('admin.coupon.show_coupon')->with('coupon',$coupon);
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
    public function destroy($coupon_id)
    {
        $coupon = Coupon::find($coupon_id);
        $coupon->delete();
        return redirect()->route('coupon.index');
    }
}
