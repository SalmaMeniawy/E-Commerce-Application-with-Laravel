@extends(backpack_view('blank'))
<link rel="stylesheet" type="text/css" href="{{ url('/css/order/create_order.css') }}" />

@section('content')
<h1>hello Salma</h1>
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
                  2 of 2
                </div>
          </div>
           
        
    </form>
</div>
@endsection