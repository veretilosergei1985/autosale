jQuery(function() {


    jQuery('#slf_filter_vendor_category_toggle_handler').live('click',function(e) {
        e.preventDefault();
             
        if($('#slf_filter_vendor_category_toggle_target').is(':visible')){
           $('#slf_filter_vendor_category_toggle_target').hide('slow');
        } else {
            $('#slf_filter_vendor_category_toggle_target').show('slow');
        }
        
    });
    
    jQuery('#slf_filter_marka_model_block_toggle_handler').live('click',function(e) {
        e.preventDefault();
             
        if($('#slf_filter_marka_model_block_toggle_target').is(':visible')){
           $('#slf_filter_marka_model_block_toggle_target').hide('slow');
        } else {
            $('#slf_filter_marka_model_block_toggle_target').show('slow');
        }
        
    });
    
    jQuery('.city-opener').live('click',function(e) {
        e.preventDefault();
             
        if($('.hidden_city').css('height') == '0px'){
           $('.hidden_city').css('height','auto'); 
           $('div[dir="city"]').addClass('city_empty_margin');
        } else {
           $('.hidden_city').css('height','0px'); 
           $('div[dir="city"]').removeClass('city_empty_margin');
        }
        
    });
    
    var search_bodystyle_id = $('#search_bodystyle_id').val();
    
    jQuery.ajax({
            url: '/display/getbodytypeselect',
            type:'POST',
            data: {'category_id' : $('#search_category_id').val() },
            success: function(res) {
                     data = jQuery.parseJSON(res);
                     
                     var tips = '';
                     $("#sfl_bodyStyleId option").remove();
                     var tips = '<option value="">Любая</option>';
                     for (var i in data) {
                         tips += '<option ';
                            if(search_bodystyle_id != '' && data[i].id == search_bodystyle_id){
                                tips += 'selected="selected"'; 
                            }
                         tips += ' value="'+ data[i].id + '">' + data[i].name + '</option>';
                     }
                                          
                     $('#sfl_bodyStyleId').append(tips);
                }

        }); 
        
        var search_mark_id = $('#search_mark_id').val();
        
        jQuery.ajax({
            url: '/display/getmarksbycatselect',
            type:'POST',
            data: {'cat_id' : $('#search_category_id').val() },
            success: function(res) {
                     data = jQuery.parseJSON(res);
                     
                     var tips = '';
                     $("#filter_marka option").remove();
                     var tips = '<option value="">Любая</option>';
                     for (var i in data) {
                         tips += '<option ';
                            if(search_mark_id != '' && data[i].id == search_mark_id){
                                tips += 'selected="selected"'; 
                            }
                         tips += ' value="'+ data[i].id + '">' + data[i].name + '</option>';
                     }
                                          
                     $('#filter_marka').append(tips);
                }

        });   
        
       $('#filter_marka').change(function () {

            if($(this).find("option:selected").val() != ''){
                var mark_name = $(this).find("option:selected").text();

            } 
            var mark_id = $(this).val();

            if (mark_id == '') {
                $('#filter_model').html('');
                $('#filter_model').attr('disabled', true);
                return(false);
            } else {

                $('#filter_model').attr('disabled', false);
                    jQuery.ajax({
                          url: '/display/getmodel',
                          type:'POST',
                          data: { mark_id : mark_id },

                          success: function(res) {             
                                   var tips = '';
                                    $("#filter_model option").remove();
                                    var tips = '<option value="">Любая</option>';
                                        tips +=res;
                                          $('#filter_model').append(tips);
                              }
                      }); 
                 }
        }); 
        
        
        jQuery('#slf_location_chk_toggle_handler').live('click',function(e) {
            e.preventDefault();

            if($('#statePanel').is(':visible')){
               $('#statePanel').hide('slow');
            } else {
               $('#statePanel').show('slow');
            }

        });
        
        
         jQuery('#slf_filter_additional_data_toggle_handler').live('click',function(e) {
            e.preventDefault();

            if($('#slf_filter_additional_data_toggle_target').is(':visible')){
               $('#slf_filter_additional_data_toggle_target').hide('slow');
            } else {
               $('#slf_filter_additional_data_toggle_target').show('slow');
            }

        });
        
        jQuery('#slf_filter_additional_data_price_block_toggle_handler').live('click',function(e) {
            e.preventDefault();

            if($('#slf_filter_additional_data_price_block_toggle_target').hasClass('hide')){
               $('#slf_filter_additional_data_price_block_toggle_target').removeClass('hide');
            } else {
               $('#slf_filter_additional_data_price_block_toggle_target').addClass('hide');
            }

        });
        
        jQuery('#slf_filter_additional_data_race_block_toggle_handler').live('click',function(e) {
            e.preventDefault();

            if($('#slf_filter_additional_data_race_block_toggle_target').hasClass('hide')){
               $('#slf_filter_additional_data_race_block_toggle_target').removeClass('hide');
            } else {
               $('#slf_filter_additional_data_race_block_toggle_target').addClass('hide');
            }

        });
        
        jQuery('#slf_filter_additional_data_more_gearbox_toggle_handler').live('click',function(e) {
            e.preventDefault();

            if($('#slf_filter_additional_data_more_gearbox_toggle_target').hasClass('hide')){
               $('#slf_filter_additional_data_more_gearbox_toggle_target').removeClass('hide');
            } else {
               $('#slf_filter_additional_data_more_gearbox_toggle_target').addClass('hide');
            }

        });
        
        jQuery('#slf_filter_additional_data_more_engine_volume_toggle_handler').live('click',function(e) {
            e.preventDefault();

            if($('#slf_filter_additional_data_more_engine_volume_toggle_target').hasClass('hide')){
               $('#slf_filter_additional_data_more_engine_volume_toggle_target').removeClass('hide');
            } else {
               $('#slf_filter_additional_data_more_engine_volume_toggle_target').addClass('hide');
            }

        });
        
        jQuery('#slf_filter_additional_data_more_type_toggle_handler').live('click',function(e) {
            e.preventDefault();

            if($('#slf_filter_additional_data_more_type_toggle_target').hasClass('hide')){
               $('#slf_filter_additional_data_more_type_toggle_target').removeClass('hide');
            } else {
               $('#slf_filter_additional_data_more_type_toggle_target').addClass('hide');
            }

        });
        
        jQuery('#slf_filter_additional_data_more_drive_type_toggle_handler').live('click',function(e) {
            e.preventDefault();

            if($('#slf_filter_additional_data_more_drive_type_toggle_target').hasClass('hide')){
               $('#slf_filter_additional_data_more_drive_type_toggle_target').removeClass('hide');
            } else {
               $('#slf_filter_additional_data_more_drive_type_toggle_target').addClass('hide');
            }

        });
        
        jQuery('#slf_filter_additional_data_more_color_toggle_handler').live('click',function(e) {
            e.preventDefault();

            if($('#slf_filter_additional_data_more_color_toggle_target').hasClass('hide')){
               $('#slf_filter_additional_data_more_color_toggle_target').removeClass('hide');
            } else {
               $('#slf_filter_additional_data_more_color_toggle_target').addClass('hide');
            }

        });
        
        
        jQuery('.ria-check-all').live('click',function(e) {
            e.preventDefault();

            if($(this).hasClass('checked')){
               $(this).removeClass('checked');
               $(this).addClass('check');
            } else {
               $(this).removeClass('check');
               $(this).addClass('checked');
            }

        });
        
        
        jQuery('#slf_auto_id_handler').live('click',function(e) {
            e.preventDefault();

            if($('#slf_auto_id_target').hasClass('hide')){
               $('#slf_auto_id_target').removeClass('hide');
            } else {
               $('#slf_auto_id_target').addClass('hide');
            }

        });
        
        
        if($('#filter_marka').find(":selected").val() != ''){
        
                var mark_id = $('#search_mark_id').val();
                var mark_name = $('#filter_marka').find("option:selected").text();

                $('#filter_model').attr('disabled', false);
                jQuery.ajax({
                      url: '/display/getmodel',
                      type:'POST',
                      data: { mark_id : mark_id },

                      success: function(res) {

                          //data = jQuery.parseJSON(res);                
                               var tips = '';
                                $("#filter_model option").remove();
                                var tips = '<option value="">Выберите</option>';

        //                              for (var i in data) {
        //                                  tips += '<option value="'+ data[i].id + '">' + data[i].name + '</option>';
        //                              }
        //                              $('#city').append(tips);
                                    tips +=res;
                                      $('#filter_model').append(tips);

                                        if($('#search_model_id').val() != '' && $('#search_model_id').val() != '0'){
                                            var model_id = $('#search_model_id').val();

                                            $('#filter_model option[value="'+model_id+'"]').attr('selected', true);
                                        }

                          }


          }); 
        
    }


});
    
     
           


