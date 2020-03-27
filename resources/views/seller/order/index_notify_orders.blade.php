@extends(backpack_view('blank'))
@section('content')
<div class="page-header">
<h2> Your Orders </h2>
</div>
<div class="container">
@if($orders)


</div>
       
        <div class="row">
            @foreach($orders as $order)
        
            <div class="col ">
            <table class="table table-hover">
                    <td class="  table-info">
                        <h5>order code : <strong>{{$order->order_code_id_for_buyer}}</strong></h5>
                        <h5>created at : <strong>{{$order->created_at}}</strong></h5>
                    </td>
                @foreach($order->products as $product)
                   
                    <tr>

                            <td>
                            <h5 class="d-inline ">product title : <strong>{{$product->title}} </strong></h5>
                            </td>
                            @if($product->pivot->order_state_for_seller == "Pending")

                            <td>
                               <h5 class="d-inline ">status : <strong class="text-danger">{{$product->pivot->order_state_for_seller}}</strong> </h5>

                            </td>
                            <td>
                            <a  class="btn-sm btn btn-info">Confirm product</a>

                            </td>
                           
                            <td>
                                    
                            <a  href="{{route('product.show',$product->id)}}" class="btn-sm btn btn-dark">View product</a>
                            </td>
                            @elseif($product->pivot->order_state_for_seller == "Confirmed")
                            <td>
                                <h5 class="d-inline ">status : <strong class="text-warning">{{$product->pivot->order_state_for_seller}}</strong> </h5>
                            </td>
                            <td>
                            <a  class="btn-sm btn btn-warning">Deliver product</a>

                            </td>
                            <td>
                                    
                                    <a  href="{{route('product.show',$product->id)}}" class="btn-sm btn btn-dark">View product</a>
                            </td>
                     @else
                        <td>
                             <h5 class="d-inline ">status : <strong class="text-success">{{$product->pivot->order_state_for_seller}}</strong> </h5>
                        </td>
                    @endif  
                    </tr>

                    
                @endforeach
                </div>
           
            @endforeach
            </table>

        </div>

    @else
    
       <div class="alert alert-danger " role="alert"  id="alert_invalid_order">
      <strong><h3>Ohh !! There is no orders yet !</h3></strong>
    </div>
    @endif


    <!-- </table> -->
@endsection