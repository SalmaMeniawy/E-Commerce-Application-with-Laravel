@extends(backpack_view('blank'))
@section('content')
    <div class="card">
        <div class="row table-danger">
            <div class="col">
                <h2>Order details </h2>
            </div>
        </div>
        <div class="row ">
           <div class="col table-info">
               <div id="basic_details">
                    <div>
                        <label class="text-md-center">
                            <h3><strong>
                                Basic details
                            </strong>
                        </label></h3>
                    
                    </div>
                    <div>
                        <h5>Order code : <strong>{{$order->order_code_id_for_buyer}}</strong></h5>
                        <h5>Created at : <strong> {{$order->created_at}}</strong></h5>
                    </div>

                 </div>
                 <div id="address_tele">
                    <div>
                            <label class="text-md-center">
                                <h3><strong>
                                   Address & Tele
                                </strong>
                            </label></h3>
                    </div>
                    <div>     
                        <h5> Address : <strong>{{$order->address_for_shipping}}</strong></h5>
                        <h5> Tele : <strong>{{$order->telephone_for_shipping}}</strong></h5>
                  
                    </div>
                 </div>
                 @if($order->coupon_id)
                    <div>
                         <div>
                            <label class="text-md-center">
                                <h3><strong>
                            Payment details
                                </strong>
                            </label></h3>
                         </div>
                         <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Greate!</strong> You save your money by using our coupons Thanks ^^
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                         <div>
                             <h5>order price before coupon : <strong><del>$ {{$order->total_order_price}}</del></strong></h5>
                             <h5>order price after coupon : <strong>$ {{$order->order_price_after_coupon_value}}</strong> </h5>
                         </div>
                    </div>

                @else
                     <div>
                         <div>
                            <label class="text-md-center">
                                <h3><strong>
                            Payment details
                                </strong>
                            </label></h3>
                         </div>
                         
                         <div>
                             <h5>order price  : <strong>$ {{$order->total_order_price}}</strong></h5>
                         </div>
                    </div>
                 @endif
           </div>
           <div class="col">
                <h1>part two</h1>
           </div>
        </div>
    </div>

@endsection