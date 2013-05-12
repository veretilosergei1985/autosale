jQuery(function() {
    
    jQuery('#add_author').live('click',function(e) {
        e.preventDefault();

        var last_author = $('.authors_list').last();
        
        $(last_author).clone().insertAfter(last_author);
        var last_author = $('.authors_list').last();
        $(last_author).find("input").val('');
        $(last_author).find(".del_author").remove();
        $(last_author).append("<a class='del_author' href='#'></a>");
    
    });
    
    jQuery('.del_author').live('click',function(e) {
        e.preventDefault();

        $(this).parent().remove();
    
    });
   
   jQuery('#del_button').live('click',function(e) {
        //e.preventDefault();
        if($('input[@name="ids[]"]:checked').length > 0){
            if(confirm('Delete selected items?')){
                $('#books_form').submit();
                return false;
            } else {
                return false;
            }
        } else {
            alert('Select at least one item');return false;
        }    
    
    });
    
    
    jQuery('.del_author_from_edit').live('click',function(e) {
        e.preventDefault();
        
        var element = $(this);
        var id = $(this).attr('rel');
        
        jQuery.ajax({
                url: $(this).attr('href'),
                type:'POST',
                data: {id : id},
                success: function(res) {
                    data = jQuery.parseJSON(res);
                    if(data.status == 'ok'){
                        $('.author_block_'+id).remove();
                        $(element).remove();
                    }
                   
                }
            }); 
    
    });
    
    jQuery('#final_page__mail_to_seller').live('click',function(e) {
        e.preventDefault();
        var elem = $(this);
        var car_user_id = $(elem).attr('rel');
        var curr_user_id = $(elem).data('currentuser');
        
          jQuery.ajax({
                url: $(this).attr('href'),
                type:'POST',
                data: {'car_user_id': car_user_id, 'curr_user_id' : curr_user_id },
                success: function(res) {
     
                    $(elem).after(res);
                    

                }
            }); 
   
    });
    
    jQuery('#final_page__send_message_form input[type="submit"]').live('click',function(e) {
        e.preventDefault();
        
        jQuery.ajax({
                url: '/ajax/send',
                type:'POST',
                data: $("#final_page__send_message_form").serialize(),
                success: function(res) {
     
                    $('#final_page__send_message_popup_container').remove();

                }
            }); 
   
    });
    
     jQuery('#final_page__send_message_close_popup').live('click',function(e) {
        e.preventDefault();
        
        $('#final_page__send_message_popup_container').remove();
    
    });
           
    
});
