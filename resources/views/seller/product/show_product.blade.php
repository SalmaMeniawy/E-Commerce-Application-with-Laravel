@extends(backpack_view('blank'))
@section('content')
<div class="container">
         <div class="row justify-content-center">
            <div class="col-md-8">
             <div class="card">
             @if(isset($product)&& isset($product_category_name))
             <div class="card">
             <div class="card-header" ><h2>{{$product->title}} product	 details</h2>
                <div class="card-block">
                <div class="container d-flex h-100">
                    <div class="row justify-content-center align-self-center">
                    <img src='{{url("/productImages",$product->image)}}' width="200" height="200" class="align-middle"> 

                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        Product title : {{$product->title}}
                    </li>
                    <li class="list-group-item">
                        Product category : {{$product_category_name}}
                    </li>
                    <li class="list-group-item">
                        Product brand : {{$product_brand_name}}
                    </li>
                    <li class="list-group-item">
                        Product description : {{$product->description}}
                    </li>
                    <li class="list-group-item">
                        Quentity in Stock : {{$product->in_stock_quantity}}
                    </li>
                    <li class="list-group-item">
                        Product price : {{$product->price}}
                    </li>
                </ul>

                </div>
               
             </div>
            
             </div>
             @endif
             
             </div>
             <div>
                    <a href="{{route('product.index')}}" class="btn btn-info">Back</a>
                </div>
            </div>
         </div>
</div>
@endsection
