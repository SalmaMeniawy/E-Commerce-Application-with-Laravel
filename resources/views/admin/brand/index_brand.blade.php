@extends('layouts.app')
@section('content')
	<div class="container">
         <div class="row justify-content-center">
            <div class="col-md-8">
             <div class="card">
             	 <div class="card-header"><h2>Available Brands</h2></div>
                  <div class="card-body">
                  	@if(isset($brands))
                  	
                      <ul  class="list-inline">
                      	@foreach($brands as $brand)
                      	<dl class="row">
						<dt class="col-md-3">{{$brand->brand_name}}</dt>
						<dd class="col-md-4">
							<a href="{{route('brand.show',$brand->id)}}" class="btn btn-info">Show </a>
						</dd>
						<dt class="col-md-3">

                                 <form action="{{ route('brand.destroy', $brand->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                     <button type="submit" class="btn btn-danger">delete brand</button>
                        
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