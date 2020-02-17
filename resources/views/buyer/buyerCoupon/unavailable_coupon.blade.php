@extends(backpack_view('blank'))
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-10 col-md-offset-1">
            <table class="table table-hover">
                <thead  class="p-3 mb-2 bg-info  text-dark">
                    <div class="alert alert-danger" role="alert">
                        <strong>Oh sorry!</strong> {{$notfound_coupon}}
                    </div>
                </thead>
            </table>
        </div>
    </div>
</div>        
@endsection