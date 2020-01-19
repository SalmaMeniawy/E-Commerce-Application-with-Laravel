@extends(backpack_view('blank'))
@section('content')
<div class="container">
         <div class="row justify-content-center">
            <div class="col-md-8">
             <div class="card">
                 @if($store)
                  <div class="card">
                <div class="card-header" ><h2>{{$store->store_name}} store's details</h2></div>
                <div class="card-block">
                    <ul class="list-group list-group-flush">
                    <li class="list-group-item">Store name :{{$store->store_name}}</li>
                     
                    <li class="list-group-item">Sammary  :  {{$store->sammary}}</li>
                    <li class="list-group-item">
                        Created at : {{$store->created_at}}    
                    </li>
                
                
                </div>
                </div>
                      

                 @endif
                 
                      
                      
                      
                      
                </div>
             </div>
                 <div>
                    <a href="{{action('Store\StoreController@index')}}"class="btn btn-info"> Back </a>
                      </div>
    </div>
</div>

@endsection