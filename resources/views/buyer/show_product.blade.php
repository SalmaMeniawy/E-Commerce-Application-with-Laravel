@extends(backpack_view('blank'))
@section('content')
<div class="container">
         <div class="row justify-content-center">
            <div class="col-md-8">
            
               <div class="media">
                  <div class="media-left">
                    <a href="#">
                
                    <img class="img-responsive" style="float:left;width:300px;height:400px;" src='{{url("/productImages",$product->image)}}'>
                    </a>
                  </div>
                  <div class="media-body">
                    <h4 class="media-heading">{{$product->title}}</h4>
                    <div>
                      <h5 style="display: inline-block" class="font-weight-bold">title : </h5>   {{$product->title}}
                      
                    </div>

                    <div>
                       <h5 style="display: inline-block" class="font-weight-bold">description : </h5>
                      <p class="p-3 mb-2 bg-info text-white">
                        {{$product->description}}
                      </p>
                    </div>
                    <div class="p-3 mb-2 bg-warning text-dark">
                      @if($product->in_stock_quantity == 0 )
                      <h5 class="text-danger font-weight-bold" style="display: inline-block"> Out of Stock</h5>

                      @elseif($product->in_stock_quantity < 3 )
                      <h5  style="display: inline-block" class="font-weight-bold" >quentity : </h5 >
                      <h5 class="text-danger font-weight-bold"> {{$product->in_stock_quantity}}</h5>
                      @else
                     
                      <h5  style="display: inline-block" class="font-weight-bold" >quentity : </h5 >
                      <h5 class="text-success font-weight-bold"  style="display: inline-block"> {{$product->in_stock_quantity}}</h5>
                     
                      @endif
                    </div>
                  
                  </div>
                </div>
             </div>
             </div>
             
          </div>
</div>

@endsection