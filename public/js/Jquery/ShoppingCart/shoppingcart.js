
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
        $("#total_price").html("<h3><strong>"+"$"+result_of_total_items_in_shopping_cart+"</strong></h3>")
        get_coupon_hash_from_buyer();//to recalculate total and coupon
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
        let coupon_input = $("#coupon_hash"); //get coupon hash from user
        //total price for subtotal
        var total_price_before_coupon = parseFloat($.trim($("#total_price_before_coupon").text().replace('$','')));
        if(coupon_input.val()){ //check if the input of hash has value
            coupon_hash = coupon_input.val(); //get hash input value
            let req = $.ajax({ //start to hit route buyerCoupon with value to get coupon of the buyer
                "url":"buyerCoupon/"+coupon_hash,
                "dataType":"json",
            });
            //after connect and get data
            req.done(function(data){
        
                let persentage = data.coupon_persentage; //get persentage value from the coupon 
                //get coupon_persentage_value_from_subtotal and convert it to float
                let coupon_persentage_value_from_subtotal = (persentage *total_price_before_coupon).toFixed(2);
                //display coupon_persentage_value_from_subtotal
                $("#coupon_hash_value").html("<strong>"+"$"+coupon_persentage_value_from_subtotal+"</strong>");
                //remove the value of coupon from total and display it
                let total_price_after_coupon = (total_price_before_coupon - coupon_persentage_value_from_subtotal).toFixed(2);
                $("#total_price").html("<h3><strong>"+"$"+total_price_after_coupon+"</strong></h3>");
                
              
            });
            /**
                control the fails of connection by ajax
             */
            req.fail(function(fail){
                swal("Invalid Code for Coupon!", {
                    icon: 'error',
                    title: 'Oops...',
                    buttons: {
                       ok : "Ok",      
                    },
                    
                 })
            });
           
            
        }
        
    }
    /**
     * function to get all quantity in the shopping cart
     * and return the values in array
     */
    let get_all_quantity = function(){
        let get_quantity_from_view = $("tbody").find("#quantity");
        let final_quantity = [];
        get_quantity_from_view.each(function(){
            final_quantity.push($(this).val());
        });
        return final_quantity;
    }
    /**
     * function to get shopping cart from the view
     */
    let get_shoppingCart_id = function(){
        let shoppingCart_id = $("#shoppingCart_id").val() ;
        return shoppingCart_id;
    }
    /**
     * function to get all products ID in the view
     */
    let get_products_id = function(){
        let get_all_products_from_view = $("tbody").find("#product_id");
        let final_products = [];
        get_all_products_from_view.each(function(){
            final_products.push($(this).val());
        });
        return final_products;
    }
    let saveAllShoppingCartAfterChange = function(event){
        //get shopping cart ID from hidden input in view
        let shoppingCart_id = get_shoppingCart_id();
        let final_quantity = get_all_quantity(); //get final quantity in the view
        let final_products = get_products_id(); //get final products ID in the view
        let data = {
            "quantity" : final_quantity,
            "products" : final_products,
        }
        let req = $.ajax({
            "url":"shoppingCart/"+shoppingCart_id,
            "type" : "PUT",
            "dataType" : "json",
            "data" : data,
        });
       
    }

    // let get_hash_of_buyer_from_db = function(){
    //     let req = $.ajax({
    //         "url":"buyerCouponHash",
    //         "type":"GET",
    //         "dataType" : "text",
    //     });
       
    //     req.done(function(data){
    //         // return compare_hash_input_for_coupon_and_hash_of_buyer(data);  
    //     });
    //     console.log(req);
    //     // let compare_hash_input_for_coupon_and_hash_of_buyer=function(coupon_hash_buyer){
    //     //     let coupoun_hash_input = $("#coupon_hash").val();
    //     //     let coupon_hash_buyer_value = coupon_hash_buyer;
    //     //     if(coupon_hash_buyer_value == coupoun_hash_input){
    //     //         return true;
    //     //         console.log("true0");
    //     //     }else{
    //     //         return false;
    //     //     }
    //     // }
        
    // }
    

    /**
     * function that contain Ajax to call route decreaseCouponUsage 
     * to decrease the coupon_uses_number if it available
     */
    let decrease_coupon_uses_number_for_buyer = function(){
        let req = $.ajax({
            "url" : "decreaseCouponUsage",
            "type" : "GET",
        });
        req.done(function(data){
          
            if(data == 1){
                swal({
                    icon: 'error',
                    title: 'Oops...',
                    text: "number of usage or lifeTime for your Coupon is Expired!!",
                  });
            }
        });
       
    }
    
    /**
     * create event to fire unload event when any change happen in the 
     * document
     */

    $(document).ready(function(){
        
        $(window).on('beforeunload', function(e){
            saveAllShoppingCartAfterChange();
        });
        let checkout = $("#checkout"); //get object element for checkout button
        //create event on the checkout button to fire on click decrease_coupon_uses_number_for_buyer
        checkout.on("click",decrease_coupon_uses_number_for_buyer);
        get_hash_of_buyer_from_db();
    });
   
});
