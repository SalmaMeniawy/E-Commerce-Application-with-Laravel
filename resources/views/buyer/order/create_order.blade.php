@extends(backpack_view('blank'))
<link rel="stylesheet" type="text/css" href="{{ url('/css/order/create_order.css') }}" />

@section('content')
<h1>hello Salma</h1>
<div class="card">


    <form>
        <div class="form-group">
        <div class="row">
             <div class="col">
                <table class="table table-hover">
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
                  
                        <tr>
                            <td class="col-sm-1 col-md-1 text-center">
                                <strong>{{$product->title}}</strong>
                            </td>
                            <td class="col-sm-1 col-md-1 text-center">
                                <strong>
                  
                                </strong>
                            </td>
                        </tr>
                  
                        @endforeach
                    
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