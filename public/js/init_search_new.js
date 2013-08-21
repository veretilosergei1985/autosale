jQuery(function() {
    
    
    
    
    jQuery('.photo-85x56').live('click',function(e) {
        e.preventDefault();
       
        var img = $(this).find('img');
        var src = $(img).attr('src');
        var auto_id = $('#current_auto_id').text();
        
        var fileUrl = "blah/filename.zip",
//        parts, ext = ( parts = src.split("/").pop().split(".") ).length > 1 ? parts.pop() : "";
       
        parts, ext = ( parts = src.split("/").pop().split(".") ).length > 1 ? parts.pop() : "";
        $('#final_page__main_photo').attr('src', '/images/photos/'+auto_id+'/'+parts+'.'+ext);

       
    });
    
    jQuery('#final_page__show_all_photos').live('click',function(e) {
        e.preventDefault();
        
        $('#final_page__preview_photos_wrapper_hidden').show();
        $(this).hide();
        $('#final_page__photos_count').hide();
        $('#final_page__hide_photos').show();
        
       
    });
    
    jQuery('#final_page__hide_photos').live('click',function(e) {
        e.preventDefault();
        
        $('#final_page__preview_photos_wrapper_hidden').hide();
        $(this).hide();
        $('#final_page__show_all_photos').show();
        $('#final_page__photos_count').show();
        
       
    });
    
    
    jQuery('#final_page__add_comment').live('click',function(e) {
        e.preventDefault();
         
        jQuery.ajax({
            url: '/display/cancommentauto',
            type:'POST',
            success: function(res) {
                    data = jQuery.parseJSON(res);
                    if(data.result == 'ok'){
                     
                     jQuery.ajax({
                            url: '/display/showautocommentform',
                            type:'POST',
                            success: function(res) {
                                     $('.add-comment').after(res);
                                }
                        }); 
                    }
                }
        }); 
  
    });
    
    jQuery('#final_page__send_message_form input[type="submit"]').live('click',function(e) {
        e.preventDefault();
        
        if($('#final_page__send_message_message').val() != ''){
                jQuery.ajax({
                url: '/ajax/sendmailtoowner',
                type:'POST',
                data: $('#final_page__send_message_form').serialize(),
                success: function(res) {
                    $('#final_page__send_message_popup_container').remove();
                }
            }); 
        } else{
            $('#final_page__send_message_message').css('border-color', 'red');
        }
                
  
    });
    
        jQuery('#final_page__mail_to_seller').live('click',function(e) {
        e.preventDefault();
        var elem = $(this);
        var car_user_id = $(elem).attr('rel');
        var curr_user_id = $(elem).data('currentuser');
        var car_id = $(elem).attr('car_id');
        
          jQuery.ajax({
                url: $(this).attr('href'),
                type:'POST',
                data: {'car_user_id': car_user_id, 'curr_user_id' : curr_user_id, 'car_id' : car_id },
                success: function(res) {
     
                    $(elem).after(res);
                    

                }
            }); 
   
    });
   
    
     jQuery('#final_page__send_message_close_popup').live('click',function(e) {
        e.preventDefault();
        
        $('#final_page__send_message_popup_container').remove();
    
    });
    
        
    
    

});
    
     
           


