@extends(backpack_view('blank'))
@section('content')
<div class="container">
	 <div class="col-md-8">
             <div class="card">
             	@if(isset($coupon))
				<div class="card">
             			 <div class="card-header" ><h2>Coupon details</h2>
             			</div>
             			<div class="card-block">
             				 <ul class="list-group list-group-flush">
             				 	<li class="list-group-item">Coupon name : {{$coupon->coupon_name}}</li>
             				 	<li class="list-group-item">
             				 		Validate state : {{$coupon->validate_state}}
             				 	</li>
             				 	<li class="list-group-item"> Number of usage : {{$coupon->number_of_usage}}</li>
             				 	<li class="list-group-item">
             				 		LifeTime : {{$coupon->lifetime}}
             				 	</li>
             				 	<li class="list-group-item">
             				 		Coupon persentage : {{$coupon->coupon_persentage}}
             				 	</li>
             				 	<li class="list-group-item">
                    				Price : {{$coupon->coupon_price}}
                    			</li>
								<li class="list-group-item">
									Craeted by : {{$admin->fname}}
								</li>
             				 	<li class="list-group-item">
                        			Created at : {{$coupon->created_at}}    
                    			</li>
                    			
             				 </ul>

             			</div>
             	@endif

             </div>

         </div>
         <div>
             	<a href="{{route('coupon.index')}}"  class="btn btn-info">Back</a>
         </div>
</div>

  @endsection