
$(function(){
   
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

   
    /**
     * create event to fire unload event when any change happen in the 
     * document
     */

    $(document).ready(function(){
        
        $(window).on('beforeunload', function(e){
            saveAllShoppingCartAfterChange();
        });
      
    });
   
});
