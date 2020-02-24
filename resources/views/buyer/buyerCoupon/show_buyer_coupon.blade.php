@extends(backpack_view('blank'))
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-10 col-md-offset-1">
            <table class="table table-hover">
                <thead  class="p-3 mb-2 bg-info  text-dark">
                    <tr>
                        <th>Available Coupon</th>
                        <th >Code</th>
                        <th>Expired date</th>
                        <th class="text-center">Persentage</th>
                        <th class="text-center">Usage no.</th>

                        <th> </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="col-sm-8 col-md-6">
                        <div class="media">
                            <h4>{{$buyer_coupon->coupon_name}}</h4>
                        </div></td>
                        <td class="col-sm-1 col-md-1" style="text-align: center">
                        <h6>{{$buyer_coupon->hash_id}}</h6>
                        </td>
                        <td class="col-sm-1 col-md-1" style="text-align: center">
                        <input type="datetime" value="{{$buyer_coupon->lifetime}}">
                        </td>
                        <td class="col-sm-1 col-md-1 text-center"><strong>{{$buyer_coupon_persentage}}</strong></td>
                        <td class="col-sm-1 col-md-1 text-center"><strong>{{$buyer->coupon_uses_number}}</strong></td>
                       
                    </tr>
                  
                   
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection