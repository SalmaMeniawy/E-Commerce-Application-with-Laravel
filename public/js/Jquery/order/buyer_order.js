$(function () {

    $(document).ready(function () {
        $("#visa_data").hide(); //as default visa inputs are hidden 
        $("#total_price_after_coupon").hide(); //make total price after coupon hidden
            
        /**
         * event fire when click on visa button the function 
         * display_visa_code_inputs fire to display the inputs
         */
        $("#visa_button").on("click", display_visa_code_inputs);
        $("#submit_coupon_button").on("click", get_coupon_hash_from_buyer );
    });
    
    /**
     * get the hash coupon from buyer if it right display the value of coupon from total order price 
     * 
     *
     */
    let get_coupon_hash_from_buyer = function (event) {
        let coupon_hash = $("#coupon_hash").val(); //get coupon hash
        if (!coupon_hash) {
            swal("There is no Coupon Code entered", {
                icon: 'error',
                title: 'Oops...',
                buttons: {
                    ok: "Ok",
                },

            })
        }else{
            console.log(coupon_hash);
            let req = $.ajax({ //start to hit route buyerCoupon with value to get coupon of the buyer
                "url": "buyerCoupon/" + coupon_hash,
                "dataType": "json",
            });
            req.done(function (response) {
                let persentage = response.coupon_persentage;
                let hash_coupon_value = $("#hash_coupon_value");
                let total_price_with_dollar_sign = $("#total_price").text();
                let total_price = parseFloat($.trim(total_price_with_dollar_sign.replace('$','')));
                if(total_price > 0){
                    let hash_coupon_value_without_doller_sign = (persentage * total_price).toFixed(2);
                    console.log(hash_coupon_value_without_doller_sign);
                    hash_coupon_value.html("<h5><strong> "+"$"+hash_coupon_value_without_doller_sign+"</strong></h5>");
                    let total_price_val = $("#total_price").text();
                    let total_price_val_without_doller_sign = parseFloat($.trim(total_price_val.replace('$','')));
                    $("#total_price").html("<del><h3><strong>"+total_price_val+"</strong></h3></del>");
                    let total_price_after_coupon_value = (total_price_val_without_doller_sign -hash_coupon_value_without_doller_sign ).toFixed(2)
                    $("#total_price_after_coupon").show();
                    $("#total_price_after_coupon_value").html("<h3><strong>"+"$"+total_price_after_coupon_value+"</strong></h3>");
                    $("#order_price_after_coupon_value").val(total_price_after_coupon_value);//add the value to hidden input in the form
                    $("#coupon_value_from_order_price").val(hash_coupon_value_without_doller_sign);//add coupon price from order in the hidden input
                    $("#coupon_id").val(response.id);
                    console.log(response.id);
                }
                
            });
            req.fail(function (fail) {
                swal("Invalid Code for Coupon!", {
                    icon: 'error',
                    title: 'Oops...',
                    buttons: {
                        ok: "Ok",
                    },
    
                })
            });
    
    
    
        }
        
    }
    /**
     * 
     * 
     * function to display the visa input fields in html
     */
    let display_visa_code_inputs = function (event) {
        $("#visa_data").show();
    }
});