@extends(backpack_view('blank'))
@section('content')

<div class="card">
    @if($orders)
       <div class="row bg-warning text-dark">
            <div class="col">
                <h3>Your List of orders</h3>
            </div>
          
       </div>
        @foreach($orders as $order)
            @if($order->order_state == "Pending")    
            <a href="#">
                <div class="row ">
                    <div class="col p-3 mb-2 bg table-success  text-dark">
                        <h3> Order code (ID) : {{$order->order_code_id_for_buyer}}</h3>
                    </div>
                    <div class="col p-3 mb-2 table-info">
                        <h5> created at :<strong>{{$order->created_at}} </strong> </h5>
                        <h5> order state : <strong>{{$order->order_state}}</strong> </h5>
                        <h5> total price : <strong> $ {{$order->total_order_price}}</strong></h5>
                    </div>
                </div>
            </a>
            @elseif($order->order_state == "Confirmed")
            <a href="#">
                <div class="row table-danger ">
                    <div class="col p-3 mb-2 bg table-danger  text-dark">
                        <h3> Order code (ID) : {{$order->order_code_id_for_buyer}}</h3>
                    </div>
                    <div class="col p-3 mb-2 table-danger ">
                        <h5> created at :<strong>{{$order->created_at}} </strong> </h5>
                        <h5> order state : <strong>{{$order->order_state}}</strong> </h5>
                        <h5> total price : <strong> $ {{$order->total_order_price}}</strong></h5>
                    </div>
                </div>
            </a>
            @else
            <a href="#">
                <div class="row bg-success">
                    <div class="col p-3 mb-2 bg-success  text-dark">
                        <h3> Order code (ID) : {{$order->order_code_id_for_buyer}}</h3>
                    </div>
                    <div class="col p-3 mb-2 bg-success text-dark">
                        <h5> created at :<strong>{{$order->created_at}} </strong> </h5>
                        <h5> order state : <strong>{{$order->order_state}}</strong> </h5>
                        <h5> total price : <strong> $ {{$order->total_order_price}}</strong></h5>
                    </div>
                </div>
            </a>
           
     
            @endif

        
        @endforeach
    @else

    @endif
</div>
@endsection