@extends(backpack_view('blank'))
@section('content')
<div class="container " >
    <div class="card-group">
        @foreach($products as $product) 
        <table class="table-responsive-lg">
        
        <tbody>
        <tr class="d-flex">
        <th style="width: 100%">
        <div class="card" >
                 <div class="card-header" ><h4>{{$product->title}}</h4> </div>
            <img src='{{url("/productImages",$product->image)}}' width="200" height="200" class="align-middle"> 

            <div class="card-block">
                <a href='{{url("/product",$product->id)}}' class="btn btn-info" style="width:49%"    > Show </a>
                <a href='{{route("addShopCart",$product->id)}}' class="btn btn-success" style="width:49%"> Add to<i class="fa fa-shopping-cart"></i> </a>
                
            </div>
            
          
            
        </div>
        </th>
        </tr>
        </tbody>
        </table>
           
        @endforeach
    </div>
</div>

@endsection