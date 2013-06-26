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
        }

    
    });
    
     jQuery('#publications_app_btn_activate').live('click',function(e) {
         
         if($('#publications_app_block_preferences_non_actived:visible')){
            
             $('#publications_app_block_preferences_non_actived').css({'display':'none'});
                     
             $('#publications_app_block_head_non_active').css({'display':'none'});
             $('#publications_app_block_head_active').css({'display':'block'});
             $('#publications_app_block_preferences_actived').css({'display':'block'});
             
           
         }
                     
    
    });
    
    jQuery('#publications_app_btn_disactivate').live('click',function(e) {
         
         
         if($('#publications_app_block_preferences_actived:visible')){
             $('#publications_app_block_preferences_non_actived').css({'display':'block'});
             
             $('#publications_app_block_head_active').css({'display':'none'});
             $('#publications_app_block_head_non_active').css({'display':'block'});
             $('#publications_app_block_preferences_non_actived').css({'display':'block'});
             $('#publications_app_block_preferences_actived').css({'display':'none'});
         }
            
    
    });
    
    

});

