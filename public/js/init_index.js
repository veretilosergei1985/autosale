jQuery(function() {
    
    
    
    jQuery('.select-ed').live('click',function(e) {
        e.preventDefault();
             
        if($('.optgroup').hasClass('hide')){
            $('.optgroup').removeClass('hide');
        } else {
            $('.optgroup').addClass('hide');
        }
        
    });
    
    jQuery('.optgroup .item').live('click',function(e) {
        e.preventDefault();
                
        var cat_id = $(this).attr('val');
        
        jQuery.ajax({
            url: '/display/getmarksbycatselect',
            type:'POST',
            data: {'cat_id' : cat_id },
            success: function(res) {
                     data = jQuery.parseJSON(res);
                     
                     var tips = '';
                     $("#select_auto_used_marka option").remove();
                     var tips = '<option value="">Любая</option>';
                     for (var i in data) {
                         tips += '<option value="'+ data[i].id + '">' + data[i].name + '</option>';
                     }
                                          
                     $('#select_auto_used_marka').append(tips);
                }

        });         
        
        jQuery.ajax({
            url: '/display/getbodytypeselect',
            type:'POST',
            data: {'category_id' : cat_id },
            success: function(res) {
                     data = jQuery.parseJSON(res);
                     
                     var tips = '';
                     $("#select_auto_used_bodystyle option").remove();
                     var tips = '<option value="">Любая</option>';
                     for (var i in data) {
                         tips += '<option value="'+ data[i].id + '">' + data[i].name + '</option>';
                     }
                                          
                     $('#select_auto_used_bodystyle').append(tips);
                }

        }); 
        
        var html = $(this).html();
        $('.select-ed').html(html);
        $('input[name="category_id"]').val($(this).attr('val'));
        $('.optgroup').addClass('hide');
        
    });
    
    
    //////////////////////////////////////////////////////////////////////////////
    /*
        $('#select_auto_used_bodystyle').change(function () {

            if($(this).find("option:selected").val() != ''){
                var subcat_id = $(this).find("option:selected").val();
            } 
            
            if (subcat_id == '') {
                //$('#select_auto_used_model').html('');
                //$('#select_auto_used_model').attr('disabled', true);
                //return(false);
            } else {

                //$('#select_auto_used_model').attr('disabled', false);
                    jQuery.ajax({
                          url: '/display/findmarksbysubcat',
                          type:'POST',
                          data: { subcat_id : subcat_id },

                          success: function(res) {

                              data = jQuery.parseJSON(res);                
                                   var tips = '';
                                    $("#select_auto_used_marka option").remove();
                                    var tips = '<option value="">Любая</option>';

                                      for (var i in data) {
                                          tips += '<option value="'+ data[i].id + '">' + data[i].name + '</option>';
                                      }
                                      $('#select_auto_used_model').append(tips);

                              }


                      }); 

            }
     }); 
     */
    //////////////////////////////////////////////////////////////////////////////
    
    $('#select_auto_used_marka').change(function () {

       if($(this).find("option:selected").val() != ''){
           var mark_name = $(this).find("option:selected").text();
           
       } 
       var mark_id = $(this).val();

       if (mark_id == '') {
           $('#select_auto_used_model').html('');
           $('#select_auto_used_model').attr('disabled', true);
           return(false);
       } else {

           $('#select_auto_used_model').attr('disabled', false);
               jQuery.ajax({
                     url: '/display/getmodel',
                     type:'POST',
                     data: { mark_id : mark_id },

                     success: function(res) {

                         //data = jQuery.parseJSON(res);                
                              var tips = '';
                               $("#select_auto_used_model option").remove();
                               var tips = '<option value="">Любая</option>';

   //                              for (var i in data) {
   //                                  tips += '<option value="'+ data[i].id + '">' + data[i].name + '</option>';
   //                              }
   //                              $('#city').append(tips);
                                   tips +=res;
                                     $('#select_auto_used_model').append(tips);

                         }


                 }); 

       }
}); 


});
    
     
           


