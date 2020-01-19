@extends(backpack_view('blank'))
@section('content')
   
        <div class="container">
        	<div class="row justify-content-center">
            <div class="col-md-8">
            	<a href="{{action('Category\CategoryController@create')}}"class="btn btn-primary">Craete new category</a>
            	<div class="card">
             	 <div class="card-header"><h2>Available Categories</h2>
             	 		<div class="card-body">
             	 			@if(isset($categories))
             	 				  <ul  class="list-inline">
             	 				  	@foreach($categories as $category)

             	 				  		<dl class="row">
                						<dt class="col-md-3">{{$category->category_name}}</dt>
                						<dd class="col-md-4">
                							<a href="{{route('category.show',$category->id)}}" class="btn btn-info">Show </a>
                						</dd>
                						<dt class="col-md-3">

		                                 <form action="{{ route('category.destroy', $category->id)}}" method="post">
		                                            @csrf
		                                            @method('DELETE')
		                                     <button type="submit" class="btn btn-danger">delete category</button>
		                        
		                                 </form> 
									
						                </dt>
						
						          </dl>

             	 				  	@endforeach
             	 				  </ul>
             	 			@endif
             	 		</div>
             	 </div>
            </div>
        	</div>
        </div>

@endsection