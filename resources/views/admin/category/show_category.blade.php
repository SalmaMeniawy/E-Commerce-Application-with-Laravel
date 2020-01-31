@extends(backpack_view('blank'))
@section('content')
<div class="container">
         <div class="row justify-content-center">
            <div class="col-md-8">
             <div class="card">
             	@if(isset($category))
             		<div class="card">
             			 <div class="card-header" ><h2>{{$category->category_name}} 	 details</h2>
             			</div>
             			<div class="card-block">
                    <ul class="list-group list-group-flush">
                    <li class="list-group-item">Category name :{{$category->category_name}}</li>
                     
                    <li class="list-group-item">
                        Created by : {{$admin->fname}}
                    </li>
                    <li class="list-group-item">
                        Created at : {{$category->created_at}}    
                    </li>
                </div>
             		</div>
             	@endif
             </div>
             <div>
                 <a href="{{route('category.index')}}"class="btn btn-info">Back </a>
         
             </div>
         </div>
     </div>
 </div>
  @endsection