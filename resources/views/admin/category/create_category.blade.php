@extends(backpack_view('blank'))
@section('content')
   
        <div class="container">
        	<div class="row justify-content-center">
            <div class="col-md-8">

             <div class="card">
             	
                  <div class="card-header">Category Creation Form</div>
                  <div class="card-body">
                  	<form method="POST" action="/categories">
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
                    		<label for="category_name" class="col-md-4 col-form-label text-md-right">Category name                 </label>
                    		<div class="col-md-6">
                                 <input name="category_name" type="text">
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
          <div>
            <a href="{{route('category.index')}}"class="btn btn-info"> Back </a>
          </div>
      </div>
        </div>
@endsection