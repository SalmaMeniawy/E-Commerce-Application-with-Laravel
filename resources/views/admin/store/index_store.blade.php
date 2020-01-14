@extends('layouts.app')
@section('content')
<div class="container">
         <div class="row justify-content-center">
            <div class="col-md-8">
             <div class="card">
                 <div class="card-header"><h2>Available Stores</h2></div>
                  <div class="card-body">
                      @if($stores)
                      <table class="table table-sm">
                          <thead>
                            <tr>
                            <th >Store name</th>
                            <th>Sammary</th>
                            <th>Delete</th>
                            <th></th>
                           
                            </tr>
                            <tbody>
                                @foreach($stores as $store)
                                <tr>
                                    <td>
                                        {{$store->store_name}}
                                    </td>
                                    <td>{{$store->sammary}}</td>
                                    <td></td>
                                    <td>
                                    <a href="{{action('StoreController@show',[$store->id])}}"class="btn btn-info">view</a>

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