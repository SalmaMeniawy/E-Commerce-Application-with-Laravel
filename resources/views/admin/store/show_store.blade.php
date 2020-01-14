@extends('layouts.app')
@section('content')
<div class="container">
         <div class="row justify-content-center">
            <div class="col-md-8">
             <div class="card">
                 @if($store)
                  <div class="card">
                <div class="card-header" ><h2>Store details</h2></div>
                <div class="card-block">
                    <ul class="list-group list-group-flush">
                    <li class="list-group-item"><h4>{{$store->store_name}}</h4></li>
                    <li class="list-group-item">{{$store->sammary}}</li>
                    
                
                
                </div>
                </div>
                      

                 @endif
                 
                      
                      
                      
                      
                </div>
             </div>
                 <div>
                    <a href="{{action('StoreController@index')}}"class="btn btn-info"> Back </a>
                      </div>
    </div>
</div>

@endsection