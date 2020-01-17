@extends('layouts.app')
@section('content')
   
        <div class="container">
        	<div class="row justify-content-center">
            <div class="col-md-8">

             <div class="card">

                <div class="card-header">Coupon Creation Form</div>
                  <div class="card-body">
                  	<form method="POST" action="">
                  		@csrf
                  		<div class="form-group row">
							<label for="coupon_name" class="col-md-4 col-form-label text-md-right">Coupon name                 </label>
							<div class="col-md-6">
                                 <input name="coupon_name" type="text">
                             </div>
                  		</div>
                  		<div class="form-group row">
                  			<label for="number_of_usage" class="col-md-4 col-form-label text-md-right">Usage number               </label>
                  			<div class="col-md-6">
                                 <input name="number_of_usage" type="number">
                             </div>
                  		</div>
                  		
                  		<div class="form-group row">
                  			<label for="lifetime" class="col-md-4 col-form-label text-md-right">Lifetime for coupon              </label>
                  			<div class="col-md-6">
                                 <input name="lifetime" type="time">
                             </div>
                  		</div>
                  		<div class="form-group row">
                  			<label for="coupon_persentage" class="col-md-4 col-form-label text-md-right">Coupon persentage            </label>
                  			<div class="col-md-6">
                                 <input name="coupon_persentage" type="number"  step="0.01">
                             </div>
                  		</div>
                  		
                  		<div class="form-group row">
                  			<label for="coupon_price" class="col-md-4 col-form-label text-md-right">Coupon persentage            </label>
                  			<div class="col-md-6">
                  				<input type="number"step="0.1" name="coupon_price">
                  			</div>
                  		</div>
            			<div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                   Submit
                                </button>
                             </div>
                  	</form>
                  </div>
              	</div>
             </div>

        </div>
@endsection