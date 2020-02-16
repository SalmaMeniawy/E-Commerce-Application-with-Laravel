@extends(backpack_view('blank'))
@section('content')
<div class="container">
         <div class="row justify-content-center">
            <div class="col-md-8">
             <div class="card">
                <div class="card-header">
                    <h2>Create Buyer Category</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="/buyerCategory">
                    @csrf
                    <div class="form-group row">
                    <label for="brand_name" class="col-md-4 col-form-label text-md-right">Buyer Category Name                </label>
                        <div class="col-md-6">
                        <input name="buyer_category_name" type="text">
                        </div>
                    </div>
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary"> Submit</button>
                    </div>
                    </form>
                </div>
             </div>
            </div>
        </div>
</div>
@endsection