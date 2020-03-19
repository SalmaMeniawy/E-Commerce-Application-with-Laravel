@extends(backpack_view('blank'))
<link rel="stylesheet" type="text/css" href="{{ url('/css/order/create_order.css') }}" />

@section('content')
<h1>Your order details </h1>
<div class="card">


    <form>
        <div class="form-group">
        <div class="row">
             <div class="col">
                <table class="table table-hover ">
                    <thead class="p-3 mb-2 bg-info  text-dark">
                    <tr>
                        <th class="text-center">Product</th>
                        <th>Quantity</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        @if($product->in_stock_quantity < 1)
                        <tr class="table-danger">
                            <td class="col-sm-1 col-md-1 text-center">
                                    <mark>Out-Of-Stock</mark>
                                    <strong><del>{{$product->title}}</del></strong>
                                </td>
                                <td class="col-sm-1 col-md-1 text-center">
                                    <strong>
                                        <del>
                                        {{$product_quantity[$product->id]}}
                                        </del>
                                    </strong>
                                </td>
                                <td class="col-sm-1 col-md-1 text-center">
                                    <strong>
                                        <del>
                                        ${{$product->price}}
                                        </del>
                                    </strong>
                                </td>
                                <td class="col-sm-1 col-md-1 text-center">
                                    <strong>
                                        ${{0}}
                                    </strong>
                                </td>
                        </tr>
                        @else
                        <tr>
                            <td class="col-sm-1 col-md-1 text-center">
                                <strong>{{$product->title}}</strong>
                            </td>
                            <td class="col-sm-1 col-md-1 text-center">
                                <strong>
                                    {{$product_quantity[$product->id]}}
                                </strong>
                            </td>
                            <td class="col-sm-1 col-md-1 text-center">
                                <strong>
                                    ${{$product->price}}
                                </strong>
                            </td>
                            <td class="col-sm-1 col-md-1 text-center">
                                <strong>
                                    ${{$product->price * $product_quantity[$product->id]}}
                                </strong>
                            </td>
                            @endif
                        </tr>
                  
                        @endforeach
                        
                        <tr class="col-sm-1 col-md-1 text-center">
                        
                            <td>
                                <strong>Coupon code</strong>
                            <input class="form-control " name="coupon_hash" id="coupon_hash" type="text" value="">

                            </td>
                            <td id="hash_coupon_value">
                                <h5><strong>$0</strong></h5>
                            </td>
                            <td>
                              
                                <button type="button" class="btn btn-info" name="hash_coupon" id="coupon_hash_button">submit Coupon </button>

                            </td>

                        </tr>
                        <tr>
                            <td>   </td>
                            <td>   </td>
                            
                            <td><h3>Total</h3></td>
                        
                            <td class="text-right" id="total_price"><h3><strong>${{$total_for_order_before_coupon}}</strong></h3></td>
                         </tr>
                        
                    </tbody>

                </table>
            </div>
                 <div class="col">
                    <div>
                    <label  class="form-label "> 
                        <strong>Enter Order data plaese</strong>
                  </label>
                    </div>
                  <div>
                        <label for="tele" class="col-md-4 col-form-label text-md-right"> 
                                Tele :
                        </label>
                        <input class="form-control-md"type="telephone" name="tele" id="tele" placeholder="Enter tele">

                  </div>

                </div>
          </div>
           
        
    </form>
</div>
@endsection