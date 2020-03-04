@extends(backpack_view('blank'))
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-10 col-md-offset-1">
            <table class="table table-hover">
                <thead class="p-3 mb-2 bg-info  text-dark">
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Total</th>
                        <th> </th>
                    </tr>
                </thead>
                @foreach($products as $product  )  
               
                <tbody>
                    <tr>
                        <td class="col-sm-8 col-md-6">
                        <div class="media">
                            <a class="thumbnail pull-left" href="#"> <img class="media-object" src='{{url("/productImages",$product->image)}}' style="width: 72px; height: 72px;"> </a>
                          
                            <div class="media-body">
                                <h4 class="media-heading"><a href="#">{{$product->title}}</a></h4>
                                <!-- <h5 class="media-heading"> by <a href="#">Brand name</a></h5> -->
                                @if($in_stock_state[$product->id] == 1)
                                <span>Status: </span><span class="text-success"><strong>In Stock </strong></span>
                                @else
                                <span>Status: </span><span class="text-danger"><strong>Out of Stock </strong></span>

                                @endif
                            </div>
                           
                        </div></td>
                        <td class="col-sm-1 col-md-1" style="text-align: center" id="quantity-td">
                        
                        <input type="number" class="form-control" id="quantity" value="{{$product_quantity[$product->id]}}">

                        </td>
                        <td class="col-sm-1 col-md-1 text-center" id="price"><strong>${{$product->price}}</strong></td>
                        <td class="col-sm-1 col-md-1 text-center" id="total_item_price"><strong >${{$calculation_item_price[$product->id]}}</strong></td>
                        <td class="col-sm-1 col-md-1">
                        @if($in_stock_state[$product->id] == 1)

                        <form action='{{route("shoppingcart.destroy",$product->id)}}' method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <span class="glyphicon glyphicon-remove"></span> Remove
                        </button>
                        </form>
                        @endif
                        </td>
                    </tr>
                    @endforeach
                    
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h5>Subtotal</h5></td>
                        <td class="text-right" id="total_price_before_coupon"><h5><strong>${{$total_price_for_shopping_cart}}</strong></h5></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h5>Estimated shipping</h5>
                        </td>
                        <td class="text-right" id="coupon_price_with_total">
                        <input name="coupon_hash" id="coupon_hash" type="text" value="">
                            <h5 id="coupon_hash_value"><strong>$0</strong></h5></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h3>Total</h3></td>
                        <td class="text-right"><h3><strong>$31.53</strong></h3></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td>
                        
                        <a href="{{route('buyer.index')}}" class="btn btn-default">Continue Shopping </a>
                            
                        </td>
                        <td>
                        <button type="button" class="btn btn-success">
                            Checkout <span class="glyphicon glyphicon-play"></span>
                        </button></td>  
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript" src="/js/app.js"></script>
<script type="text/javascript">
$(function(){
    /**
        event fire when make any changes on the coupon input 
        and call function  get_coupon_hash_from_buyer
     */
    $("#coupon_hash").on("change",function(){
        get_coupon_hash_from_buyer();
    });
    /***
        craete event when change the quantity field in the shopping cart
     */
    $("tr").on("change","#quantity",function(event){
      
        let quantity_new_value = $(this).val();
        let price_per_item = $(this).parent().next().text();
        let result = change_total_price_per_item(quantity_new_value,price_per_item);
        //change the total price per item by display the result in total column
        $(this).parent().next().next().html(`<strong>`+'$'+result+`</strong>`);
        /*call function get_total_price_for_shopping_cart_before_coupon to get the
             total price of the shopping cart before coupon
        */
        let result_of_total_items_in_shopping_cart = get_total_price_for_shopping_cart_before_coupon();
        //add the result of get_total_price_for_shopping_cart_before_coupon to the shopping cart and display it
        let total_price_before_coupon = $('tbody').find('#total_price_before_coupon').eq(0).html(`<h5>`+`<strong>`+'$'+result_of_total_items_in_shopping_cart+`</strong>`+`</h5>`);
       
    });
    /***
        function that take quantity and price and return the multiplication of them
        that mean the total price per item 
     */
    change_total_price_per_item = function(quantity , price){
       
        let myQuantity = parseInt(quantity);
        let  myPrice = parseFloat($.trim(price.replace('$','')));
       
        let result = (myQuantity * myPrice);
        if(parseInt(result) === result){
            return (result);
        }else{
            return (result.toFixed(2));

        }
    }
    /**
        function to calculate total price for all shopping cart before use coupons
     */
    get_total_price_for_shopping_cart_before_coupon = function(){


        let total_result = 0; //variable before calculate total items
        let all_items_price = $('tbody').find('#total_item_price');//get all total price per item
        let length_of_all_items_price = all_items_price.length; // get length of total price per item
        for(let i = 0 ; i <length_of_all_items_price ; i++ ){
           
            let item_total = all_items_price.eq(i).text();
            let item_total_number= parseFloat($.trim(item_total.replace('$','')));//convert value to float
            total_result = total_result + item_total_number;
         
        }
       
        return total_result; //return the total
    }
    /***
        function to get the coupon hash from buyer and start proceses on it
     */
    get_coupon_hash_from_buyer = function(){
        let coupon_input = $("#coupon_hash");
        if(coupon_input.val()){
            coupon_hash = coupon_input.val();
            console.log( coupon_hash);
        }
        
    }
});

</script>
@endsection