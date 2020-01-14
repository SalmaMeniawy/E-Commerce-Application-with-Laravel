@extends('layouts.app')
@section('content')
<div class="container">
   <a href="{{action('StoreController@create')}}"class="btn btn-primary">Craete new store</a>
         <div class="row justify-content-center">
            <div class="col-md-8">
             <div class="card">
                 <div class="card-header"><h2>Available Stores</h2></div>
                  <div class="card-body">
                      @if(isset($stores))
                      <table class="table table-sm">
                          <thead>
                            <tr>
                            <th >Store name</th>
                            <th></th>
                            <th></th>
                            <th></th>
                           
                            </tr>
                          </thead>
                            <tbody>
                                @foreach($stores as $store)
                                <tr>
                                    <td>
                                        {{$store->store_name}}
                                    </td>
                                    <td>
                                    <a href="{{action('StoreController@show',[$store->id])}}"class="btn btn-info">view</a>

                                    </td>
                                     <td>
                                 <form action="{{ route('store.destroy', $store->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                     <button type="submit" class="btn btn-danger">delete store</button>
                                          </form>
                                        
                                    </td>
                                    
                                </tr>
                                @endforeach
                          </tbody>
                      </table>
                      @endif
                 </div>
                </div>
             </div>
    </div>
</div>

@endsection