
@extends('layouts.app')
@section('content')
   
        <div class="container">
         <div class="row justify-content-center">
            <div class="col-md-8">
             <div class="card">
                  <div class="card-header">Store Creation Form</div>
                  <div class="card-body">
                    <form method="post" action="/stores">
                    @csrf
                         <div class="form-group row">
                             <label for="store_name" class="col-md-4 col-form-label text-md-right">Store name                 </label>
                             <div class="col-md-6">
                                 <input name="store_name" type="text">
                             </div>
                             <label for="sammary" class="col-md-4 col-form-label text-md-right">Sammary                 </label>
                             <div class="col-md-6">
                                 <textarea name="sammary">
                                 </textarea>
                             </div>
                            
                          <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                   Submit
                                </button>
                             </div>
                        </div>
                    </form>
                 </div>
              </div>
           </div>
         </div>
        </div>
   
@endsection