@extends('layouts.app')
@section('content')
   
        <div class="container">
        	<div class="row justify-content-center">
            <div class="col-md-8">

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