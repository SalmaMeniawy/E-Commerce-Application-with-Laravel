@extends('layouts.app')

@section('content')
        <div class="container">
         <div class="row justify-content-center">
            <div class="col-md-8">
             <div class="card">
             	 <div class="card-header"><h4>Product Creation Form</h4></div>
             	 <div class="card-body">
             	 	<form method="POST" action="/products">
             	 		@csrf
             	 		<div class="form-group row">
                  			<label for="title" class="col-md-4 col-form-label text-md-right">title          </label>
                  			<div class="col-md-6">
                                 <input name="title" type="text" value="{{old('text')}}">
                             </div>
                  		</div>
             	 		<div class="form-group row">
                  			<label for="description" class="col-md-4 col-form-label text-md-right">description          </label>
                  			<div class="col-md-6">
                                 <textarea name="description"></textarea>  
                             </div>
                  		</div>
             	 		
             	 		<div class="form-group row">
                  			<label for="coupon_persentage" class="col-md-4 col-form-label text-md-right">price           </label>
                  			<div class="col-md-6">
                                 <input name="price" type="number"  step="0.01" value="{{old('price')}}">
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
 	</div>
@endsection