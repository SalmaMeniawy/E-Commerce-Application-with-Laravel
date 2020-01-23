@extends('layouts.app')

@section('content')
<div class="container">
<a href="{{action('Product\ProductController@create')}}"class="btn btn-primary">Craete new product</a>
	<div class="row justify-content-center">
            <div class="col-md-8">
            	
            	<div class="card">
            		<div class="card-header"><h2>Available Products
            		</h2>
            		<div class="card-body">
            			@if(isset($products))
            				<ul  class="list-inline">

            					<dl class="row">
            						<dt class="col-md-4">
             	 							Product title
             	 						</dt>
            					</dl>
            					@foreach($products as $product)
            					<dl class="row">
            						<dt class="col-md-3">
            							{{$product->title}}
									</dt>
									<dd class="col-md-4">
									<a href="{{route('product.show',$product->id)}}"  class="btn btn-info">Show</a>
									</dd>
									<form method="POST" action="{{ route('product.destroy', $product->id)}}">
										@csrf
										@method('DELETE')
										<button type="submit" class="btn btn-danger">delete product</button>

									</form>
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