@extends(backpack_view('blank'))
@section('content')
<div class="container">
         <div class="row justify-content-center">
            <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2> Buyer categories</h2></div>
                <div class="card-block">
                <table class="table" >
                    <thead>
                        <tr>
                        <th scope="col">Buyer category name</th>
                        
                        </tr>
                    </thead>
                    <tbody >
                        @foreach($buyer_categories as $item)
                        <tr>
                        <td>{{$item->buyer_category_name}}</td>
                        
                        </tr>
                        @endforeach
                       
                    </tbody>
                </table>
                </div>
                </div>
            </div>
        </div>
</div>


@endsection