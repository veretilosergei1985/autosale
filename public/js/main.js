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
       
        var html =
            '<div class="popup  uarr __left" style="width: 346px;" id="final_page__send_message_popup_container">'+
                '<form class="grid wrapper" action="/ajax.php?target=messages&event=sendMail" id="final_page__send_message_form">'+
                    '<a class="close" href="javascript:void(0);" id="final_page__send_message_close_popup">×</a>'+
                    '<input name="user_id" type="hidden" id="final_page__send_message_user_id"/>'+
                    '<input name="autoIdToSend" type="hidden" id="final_page__send_message_auto_id"/>'+
                    '<div class="title bold">'+
                        'Отправить сообщение'+
                    '</div>'+
                    '<p class="rows">'+
                        '<input class="span3" placeholder="ФИО" type="text" id="final_page__send_message_fio" name="fio" tabindex="1">'+
                    '</p>'+
                   '<p class="rows">'+
                        '<input class="span3" placeholder="email" type="text" id="final_page__send_message_email" name="email" tabindex="2">'+
                    '</p>'+
                    '<p class="rows">'+
                        '<input class="span3" placeholder="Телефон" type="text" id="final_page__send_message_phone" name="phone" tabindex="3">'+
                    '</p>'+
                    '<p class="rows">'+
                        '<textarea placeholder="Текст сообщения" class="boxed" id="final_page__send_message_message" name="message" cols="30" rows="5" tabindex="4"></textarea>'+
                    '</p>'+
                    '<p class="help-block">Сообщение будет отправлено на электронную почту продавца от вашего электронного адреса <span id="final_page__send_message_email_user"></span></p>'+
                    '<div class="button-bar">'+
                        '<input type="submit" class="button green" value="Отправить сообщение" tabindex="5">'+
                        '<a href="javascript:void(0);" class="button" id="final_page__send_message_cancel_button" tabindex="6">Отмена</a>'+
                    '</div>'+
                '</form>'+
            '</div>';
               
        $(this).prepend(html);
    
    });
           
    
});
