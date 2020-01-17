@extends('layouts.app')
@section('content')
   
        <div class="container">
        	<div class="row justify-content-center">
            <div class="col-md-8">
            	<div class="card">
             	 <div class="card-header"><h2>Available Coupons</h2>
             	 		<div class="card-body">
             	 			@if(isset($coupons))
             	 				<ul  class="list-inline">
             	 					<dl class="row">
             	 						<dt class="col-md-3">
             	 							Coupon name
             	 						</dt>
             	 						<dt class="col-md-3">
             	 							Available state
             	 						</dt>
             	 					</dl>
             	 					@foreach($coupons as $coupon)
             	 					<dl class="row">
             	 						<dt class="col-md-3">
             	 							{{$coupon->coupon_name}}
             	 						</dt>
             	 						<dt class="col-md-3">
             	 							{{$coupon->validate_state}}
             	 						</dt>
             	 						<dd class="col-md-4">
             	 							<a href="{{route('coupon.show',$coupon->id)}}" class="btn btn-info">Show </a>
             	 						</dd>
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