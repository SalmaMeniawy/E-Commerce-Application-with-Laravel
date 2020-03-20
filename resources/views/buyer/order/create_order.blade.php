@extends(backpack_view('blank'))
<script type="text/javascript" src="{{ asset('js/jquery-3.4.1.min.js') }}" ></script>
<script type="text/javascript" src="{{ asset('js/Jquery/order/buyer_order.js') }}" ></script>

@section('content')
<h1>Your order details </h1>
<div class="card">


    <form action="{{route('store_order',['product_quantity'=>$product_quantity,'total_for_order_before_coupon'=>$total_for_order_before_coupon])}}" method="POST">
        @csrf
        @method('POST')
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
                      @if($errors->any())
                         <ul id="errors">
             		 		@foreach($errors->all() as $error)
             		 			 <div class="alert alert-danger" role="alert">
                                 {{$error}}
                                 </div>
             		 		@endforeach
             		 	 </ul>

                     @endif
                            <div class="form-group">
                                    <label  class="form-label "> 
                                        <strong><h3>Enter Order data plaese</h3></strong>
                                    </label>
                            </div>
                            <div class="form-group">
                                <label for="tele" class="col-md-4 col-form-label text-md-center"> 
                                        Tele :
                                </label>
                                <input class="form-control-center"type="telephone" name="tele" id="tele" placeholder="Enter tele">

                           </div>
                           <div class="col">
                               
                                 <div class="form-row">
                                    <label  class=" text-md-center"> 
                                    <strong> Address details </strong>   </label>
                                </div>
                                <div class="form-group">
                                    <label for="street_no" class="col-md-4 col-form-label text-md-center"> 
                                    Street no. :   </label>
                                    <input class="form-control-center"type="number" name="street_no" id="street_no" placeholder="Enter building number ">
                                    <label for="street_name" class="col-md-4 col-form-label text-md-center"> 
                                    Street name :   </label>
                                    <input class="form-control-center"type="text" name="street_name" id="street_name" placeholder="Enter street name ">
                                    <label for="city" class="col-md-4 col-form-label text-md-center"> 
                                    City :   </label>
                                    <input class="form-control-center"type="text" name="city" id="city" placeholder="Enter City ">

                                </div>
                                <div class="form-group">
                                        <div class="row">
                                            <label  class=" text-md-center"> 
                                            <strong> Way of payment </strong>   </label>
                                        </div>
                                        
                                        <div class="btn-group dropright ">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-expanded="false">
                                            Choose the payment way!
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                <button class="dropdown-item disabled" type="button">Cash</button>
                                                <button class="dropdown-item" type="button">Visa</button>
                                            </div>
                                        
                                    </div>
                                    <div class="row invisible" >
                                        <div>
                                            <strong>Visa Cart details</strong>
                                        </div>
                                         <label for="visa_no." class="col-md-4 col-form-label text-md-center cart_data"> 
                                        Cart no.   </label>
                                        <input class="form-control-center"type="text" name="visa_no" id="cart_number" placeholder="Enter Cart number " value=0>
                                    </div>
                                </div>
           
                          </div>

                  </div>

                </div>
          </div>
          
          <button type="submit" class="btn btn-success  btn-lg btn-block" >Submit-Order</button>

        
    </form>
</div>
@endsection