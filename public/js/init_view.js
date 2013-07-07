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
    

});
    
     
           


