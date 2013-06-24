$(document).ready(function () {

    jQuery('#showfreepublicationhelp__addcars').live('click',function(e) {
         $('#freepublicationhelp__addcars').show();

    });  
    
    jQuery('#freepublicationhelp__addcars .close').live('click',function(e) {
         $('#freepublicationhelp__addcars').hide();

    });  
    
    jQuery('#publish_period').live('change',function(e) {
        var value = $(this).val();
        var price = parseInt($('#simple_price').val());
        
        var total = value * price;
        $('#publish_cost_view').text(total);
        $('#add_cars__publication_count_which_will_be_used').text(value);
    });    
   
   jQuery('#chk_activate').live('click',function(e) {
                
        if($(this).is(':checked')) {    
            $('#publications_app_block_preferences_non_actived').show();
            
        } else {
            $('#publications_app_block_preferences_non_actived').hide();
            $('#publications_app_block_preferences_actived').hide();
        }

    
    });
    
     jQuery('#publications_app_btn_activate').live('click',function(e) {
         
         //if($('#publications_app_block_preferences_actived:visible')){
            $('#publications_app_block_preferences_non_actived').hide();
            $('#publications_app_block_head_non_active').hide();
            $('#publications_app_block_head_active').show();
            $('#publications_app_block_preferences_actived').show();
             
           
         //} else {
            
            
    
    });
    
    jQuery('#publications_app_btn_disactivate').live('click',function(e) {
         
         //if($('#publications_app_block_preferences_actived:visible')){
            $('#publications_app_block_preferences_non_actived').show();
            $('#publications_app_block_head_non_active').show();
            $('#publications_app_block_head_active').hide();
            $('#publications_app_block_preferences_actived').hide();
             
    });
    
     jQuery('.tab-publication').live('click',function(e) {
         
         $('.tab-publication').removeClass('active');
         var type = $(this).attr('tab-type');
         
         if(type == 'sms'){
             $('#regular_promo_table__addcars').hide();
             $('#sms_promo_warning__addcars').show();
             $('#sms_promo_table__addcars').show();
             $(this).addClass('active');
         }
         
         if(type == 'individual'){
             $('#regular_promo_table__addcars').show();
             
             $('.switch-select').show();
             $('#hotpublication_promo_block__addcars').hide();
             $('#urgentpublication_promo_block__addcars').hide();
             
             $('#sms_promo_warning__addcars').hide();
             $('#sms_promo_table__addcars').hide();
             $(this).addClass('active');
         }
         
         if(type == 'top'){
             $('#regular_promo_table__addcars').show();
             
             $('.switch-select').hide();
             $('#hotpublication_promo_block__addcars').show();
             $('#urgentpublication_promo_block__addcars').show();
             
             $('#sms_promo_warning__addcars').hide();
             $('#sms_promo_table__addcars').hide();
             $(this).addClass('active');
         }
             
    }); 

});

