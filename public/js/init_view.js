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
    
    

});
    
     
           


