jQuery(document).ready(function(){
    jQuery(document).on('click', ".st-funnel-yes", function(e){
        // Submit the form
        e.preventDefault();
        jQuery('#add_sale').submit();
    });
    
    jQuery(document).on('click', ".st-funnel-no", function(e){
        // Submit the form
        e.preventDefault();
        jQuery('#skip_sale').submit();
    });
   jQuery('.st-funnel-yes, .st-funnel-no').on('click', '.elementor-button-link', function(e){
       e.preventDefault();
   })
});