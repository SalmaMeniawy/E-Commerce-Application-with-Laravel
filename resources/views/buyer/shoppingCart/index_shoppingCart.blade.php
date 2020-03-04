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
                        <td class="col-sm-1 col-md-1" style="text-align: center">
                        
                        <input type="email" class="form-control" id="quantity" value="{{$product_quantity[$product->id]}}">

                        </td>
                        <td class="col-sm-1 col-md-1 text-center" id="price"><strong>${{$product->price}}</strong></td>
                        <td class="col-sm-1 col-md-1 text-center" id="total_item_price"><strong>${{$calculation_item_price[$product->id]}}</strong></td>
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
                        <td class="text-right"><h5><strong>${{$total_price_for_shopping_cart}}</strong></h5></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h5>Estimated shipping</h5></td>
                        <td class="text-right"><h5><strong>$6.94</strong></h5></td>
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


//    $(function(){
    //    $("form").bind("submit",function(event){
    //         event.preventDefault();
    //         swal("hello");
    //         // swal("re you sure you want to remove item ?",{
    //         //     buttons:{
    //         //         cancel : "cancel",
    //         //         delete : {
    //         //             text : "yes",
    //         //             value: "yes",}
    //         //     }
    //         // }).then(function(value){
    //         //     console.log(value);
    //         // });
    //    });
//        $("form > button").bind("click",function(){
//         swal("Are you sure you want to remove item ? ", {
//                     buttons: {
//                        cancel : "cancel",
//                        delete :{
//                         text : "Yes",
//                         value: "yes",
//                          },
                      
//                     },
                    
//                     });
//                     // .then(function(value){
//                     //     if(value == "yes"){
//                     //         $(this).unbind("click");
//                     //         $("form > button").trigger("click");
//                     //     }
//                     // });
//        });
//     //    let myForm = $("form");
//     //    $("form").bind("click",function(){
//         // swal("Are you sure you want to remove item ? ", {
//         //             buttons: {
//         //                cancel : "cancel",
//         //                delete :{
//         //                 text : "Yes",
//         //                 value: "yes",
//         //                },
                      
//         //             },
                    
//                     // }).then(function(value){
//                     //     if(value == "yes"){
//                     //         // myForm.trigger("submit").submit();
//                     //       myForm.unbind("click");
//                     //     //   $("form > button").trigger("click");
                            
//                     //         // myForm.toggle("submit").submit();
//                     //         // mySwal.hide();
                        
//                     //     }else{
//                     //         return;
//                     //     }
//     //    });
//     //    let myForm = $("form");
//     //    myForm.one("submit",function(event){
//     //        let myEvent = event;   
//     //        myEvent.preventDefault();
//     //       var mySwal= swal("Are you sure you want to remove item ? ", {
//     //                 buttons: {
//     //                    cancel : "cancel",
//     //                    delete :{
//     //                     text : "Yes",
//     //                     value: "yes",
//     //                    },
                      
//     //                 },
                    
//     //                 }).then(function(value){
//     //                     if(value == "yes"){
//     //                         // myForm.trigger("submit").submit();
                          
                            
//     //                         myForm.toggle("submit").submit();
//     //                         // mySwal.hide();
                        
//     //                     }else{
//     //                         return;
//     //                     }
//     //                 });

//     //    });
// //   let removeItemButton = function(event){
// //     let myEvent = event;
// //     myEvent.preventDefault();
// //     swal("Are you sure you want to remove item ? ", {
// //                     buttons: {
// //                        cancel : "cancel",
// //                        delete :{
// //                         text : "Yes",
// //                         value: "yes",
// //                        },
                      
// //                     },
                    
// //                     }).then(function(value){
// //                         if(value != "yes"){
// //                             return;
// //                         }
// //                     }
// //     $(this).unbind(myEvent);

// //   };
// //   let myForm = $("form");
// //   myForm.bind("submit",removeItemButton);
//    });
</script>
@endsection