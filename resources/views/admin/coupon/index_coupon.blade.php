@extends(backpack_view('blank'))
@section('content')
   
        <div class="container">
        	<div class="row justify-content-center">
            <div class="col-md-8">
            	<div>
            		<a href="{{route('coupon.create')}}" class="btn btn-primary">Create new coupon</a>
            	</div>
            	<div class="card">
             	 <div class="card-header"><h2>Available Coupons</h2>
             	 		<div class="card-body">
             	 			@if(isset($coupons))
             	 				<ul  class="list-inline">
             	 					<dl class="row">
             	 						<dt class="col-md-4">
             	 							Coupon name
             	 						</dt>
             	 						
             	 					</dl>
             	 					@foreach($coupons as $coupon)
             	 					<dl class="row">
             	 						<dt class="col-md-3">
             	 							{{$coupon->coupon_name}}
             	 						</dt>
             	 						
             	 						<dd class="col-md-4">
             	 							<a href="{{route('coupon.show',$coupon->id)}}" class="btn btn-info">Show </a>
             	 						</dd>
             	 						<dt class="col-md-3">

		                                 <form action="{{ route('coupon.destroy', $coupon->id)}}" method="post">
		                                            @csrf
		                                            @method('DELETE')
		                                     <button type="submit" class="btn btn-danger">delete coupon</button>
		                        
		                                 </form> 
									
						                </dt>
             	 						
             	 					</dl>

             	 					@endforeach
             	 			@endif
             	 		</div>

             	 	</div>
             	 </div>
            </div>
        </div>
        </div>
@endsection