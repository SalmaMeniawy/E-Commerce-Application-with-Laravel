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
             	 		@if($errors->any())
             	 			<ul id="errors">
             		 		@foreach($errors->all() as $error)
             		 			 <div class="alert alert-danger" role="alert">
                                 {{$error}}
                             </div>
             		 		@endforeach
             		 		</ul>
             	 		@endif
             	 		<div class="form-group row">
                  			<label for="title" class="col-md-4 col-form-label text-md-right">title          </label>
                  			<div class="col-md-6">
                                 <input name="title" type="text" value="{{old('title')}}">
                             </div>
                  		</div>
             	 		<div class="form-group row">
                  			<label for="description" class="col-md-4 col-form-label text-md-right">description          </label>
                  			<div class="col-md-6">
                                 <textarea name="description"></textarea>  
                             </div>
						  </div>
						  <div class="form-group row">
						  <label for="description" class="col-md-4 col-form-label text-md-right">quantity          </label>
						  <div class="col-md-6">
						  	<input name="in_stock_quantity" type="number" value="{{old('in_stock_quantity')}}">
						  </div>
						  </div>
             	 		<div class="form-group row">
						  <label for="brand" class="col-md-4 col-form-label text-md-right">brand  </label>
						  <div class="col-md-6">
						  <select class="col-md-6"  name="brand_id">
                                @foreach($brands as $brand)
								<option value="{{$brand->id}}">{{$brand->brand_name}}</option>

								@endforeach
								</select>
                            </div>
							
             	 		</div>
						  <div class="form-group row">
						  <label for="category" class="col-md-4 col-form-label text-md-right">category  </label>
							<div class="col-md-6">
							<select class="col-md-6"  name="category_id">
							@foreach($categories as $category)

							<option value="{{$category->id}}">{{$category->category_name}}</option>		
							@endforeach
							</select>
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