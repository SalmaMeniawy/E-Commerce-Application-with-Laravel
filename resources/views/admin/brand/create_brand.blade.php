@extends(backpack_view('blank'))
@section('content')
	<div class="container">
         <div class="row justify-content-center">
            <div class="col-md-8">
             <div class="card">
             	 <div class="card-header"><h2>Brand Creation Form</h2></div>
                  <div class="card-body">
                  	@if($errors->any())
                  	 <ul id="errors">
                  	 	@foreach($errors->all() as $error)
							<div class="alert alert-danger" role="alert">
                                 {{$error}}
                            </div>
                  	 	@endforeach
                  	 </ul>
                  	 @endif
                  	<form method="POST" action="/brands">
                  		@csrf
                  		<div class="form-group row">
                  			<label for="brand_name" class="col-md-4 col-form-label text-md-right">Brand name                 </label>
                  			<div class="col-md-6">
                                 <input name="brand_name" type="text">
                             </div>
                  		</div>
                  		<div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                   Submit
                                </button>
                             </div>
                  	</form>
                  </div>
                  <div>
                    <a href="{{action('Brand\BrandController@index')}}"class="btn btn-info"> Back </a>
                 </div>
              </div>
             </div>
         </div>
     </div>

 </div>

@endsection