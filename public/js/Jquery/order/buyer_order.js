$(function(){
    
    $(document).ready(function(){
        $("#visa_data").hide(); //as default visa inputs are hidden 
        /**
         * event fire when click on visa button the function 
         * display_visa_code_inputs fire to display the inputs
         */
        $("#visa_button").on("click",display_visa_code_inputs);

    })

    /**
     * 
     * function to display the visa input fields in html
     */
    let display_visa_code_inputs = function(event){
        $("#visa_data").show();
    }
});