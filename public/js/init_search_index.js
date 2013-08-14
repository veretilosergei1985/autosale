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
    
    jQuery('a[pname="state"]').live('click',function(e) {
        e.preventDefault();
        
        var pvalue = $(this).attr('pvalue');
                        
        if($('.hidden_subgroup[pvalue="'+pvalue+'"]').is(':visible')){
            $('.hidden_subgroup[pvalue="'+pvalue+'"]').hide();
            $(this).removeClass('checked');
            $(this).addClass('check');
            
            // delete hidden inputs for new regions
            $('input.m_state[value="'+pvalue+'"]').remove();
            $('input.m_city[state_id="'+pvalue+'"]').remove();
            
        } else {
            $('.hidden_subgroup[pvalue="'+pvalue+'"]').show();
            $('.hidden_subgroup[pvalue="'+pvalue+'"]').css('margin-left','12px');
            $(this).removeClass('check');
            $(this).addClass('checked');
            
            // create hidden inputs for new regions
            $('<input class="m_state" type="hidden" name="m_state[]" city_id="" value="' + pvalue + '" />').appendTo('#search_ajax_form');
            $('<input class="m_city" type="hidden" name="m_city[]" state_id="' + pvalue + '" value="0" />').appendTo('#search_ajax_form');
                        
        }
        
        $('.wrapper_search').empty();
        $('.wrapper_search').append('<div id="search_form_container" class="grid grid-span2"><div class="preloader-window"></div></div>');

        jQuery.ajax({
              url: '/search/ajax',
              type:'POST',
              data: $('#search_ajax_form').serialize(),
              success: function(res) {
                    $('.wrapper_search').empty();
                    $('.wrapper_search').append(res);
                    $('#search_results_count').text($('#count_result').val());
                    window.history.pushState('Object', 'Title', '?' + $('#queryString').val());
                  }
          }); 
        
    });
    
    jQuery('a[pname="city"]').live('click',function(e) {
        e.preventDefault();
        
        var pvalue = $(this).attr('pvalue');
        var state_id = $(this).attr('state_id');
                        
        if($(this).hasClass('checked')){
            $(this).removeClass('checked');
            
            $('.m_state[value="'+state_id+'"][city_id="'+pvalue+'"]').remove();
            $('.m_city[state_id="'+state_id+'"][value="'+pvalue+'"]').remove();
            
//            if($('.m_city[state_id="'+state_id+'"][value="'+pvalue+'"]').length>0) {
//                $('.m_city[state_id="'+state_id+'"][value="'+pvalue+'"]').val('');
//            } 
            // delete hidden inputs for new cities
            //$('input.m_city[value="'+pvalue+'"]').remove();
            // remove value of main hidden input - region
            //if(pvalue == $('input#region').val())
                //$('input#region').val('');
        } else {
            $(this).addClass('checked');
                        
            // create hidden inputs for new cities
            $('<input class="m_state" type="hidden" name="m_state[]" city_id="'+pvalue+'" value="' + state_id + '" />').appendTo('#search_ajax_form');
            $('<input class="m_city" type="hidden" name="m_city[]" state_id="' + state_id + '" value="'+pvalue+'" />').appendTo('#search_ajax_form');
            
//            else {
//                $('<input class="m_city" type="hidden" name="m_city[]" value="' + pvalue + '" />').appendTo('#search_ajax_form');
//            }           
        }
        
        $('.wrapper_search').empty();
        $('.wrapper_search').append('<div id="search_form_container" class="grid grid-span2"><div class="preloader-window"></div></div>');

        jQuery.ajax({
              url: '/search/ajax',
              type:'POST',
              data: $('#search_ajax_form').serialize(),
              success: function(res) {
                    $('.wrapper_search').empty();
                    $('.wrapper_search').append(res);
                    $('#search_results_count').text($('#count_result').val());
                    window.history.pushState('Object', 'Title', '?' + $('#queryString').val());
                  }
          }); 
        
    });
    
    var search_bodystyle_id = $('#bodystyle').val();
    
    jQuery.ajax({
            url: '/display/getbodytypeselect',
            type:'POST',
            data: {'category_id' : $('#category_id').val() },
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
        
        var search_mark_id = $('#mark').val();
        
        jQuery.ajax({
            url: '/display/getmarksbycatselect',
            type:'POST',
            data: {'cat_id' : $('#category_id').val() },
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
            $('#model').val('');

            if($(this).find("option:selected").val() != ''){
                var mark_name = $(this).find("option:selected").text();

            } 
            var mark_id = $(this).val();

            if (mark_id == '') {
                $('#filter_model').html('');
                $('#model').val('');
                var tips = '<option value="">Любая</option>';                
                $('#filter_model').append(tips);
                //$('#filter_model').attr('disabled', true);
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
        
                var mark_id = $('#mark').val();
                var mark_name = $('#filter_marka').find("option:selected").text();

                //$('#filter_model').attr('disabled', false);
                jQuery.ajax({
                      url: '/display/getmodel',
                      type:'POST',
                      data: { mark_id : mark_id },

                      success: function(res) {

                          //data = jQuery.parseJSON(res);                
                               var tips = '';
                                $("#filter_model option").remove();
                                var tips = '<option value="">Любая</option>';

        //                              for (var i in data) {
        //                                  tips += '<option value="'+ data[i].id + '">' + data[i].name + '</option>';
        //                              }
        //                              $('#city').append(tips);
                                    tips +=res;
                                      $('#filter_model').append(tips);

                                        if($('#model').val() != '' && $('#model').val() != '0'){
                                            var model_id = $('#model').val();

                                            $('#filter_model option[value="'+model_id+'"]').attr('selected', true);
                                        }

                          }


          }); 
        
       }
       
       
       if($('#year_start').val() != '' && $('#year_start').val() != '0'){
           var val = $('#year_start').val();
           $('#filter_s_yers option[value='+val+']').attr('selected', 'selected');
       }
       
       if($('#year_end').val() != '' && $('#year_end').val() != '0'){
           var val = $('#year_end').val();
           $('#filter_po_yers option[value='+val+']').attr('selected', 'selected');
       }
       
       if($('.m_state').val() != '' && $('.m_state').val() != '0'){
           var reg_val = $('.m_state').val();
           $('a[pvalue='+reg_val+'][pname="state"]').removeClass('check');
           $('a[pvalue='+reg_val+'][pname="state"]').addClass('checked');
           
            $('.hidden_subgroup[pvalue="'+reg_val+'"]').show();
            $('.hidden_subgroup[pvalue="'+reg_val+'"]').css('margin-left','12px');
       }
       
       if($('#with_photo').val() != '' && $('#with_photo').val() != '0'){
           $(this).attr('pchecked', 'true');
                     
           $('#lf_search_with_photo').removeClass('check');
           $('#lf_search_with_photo').addClass('checked');
       }
       
       if($('#with_video').val() != '' && $('#with_video').val() != '0'){
           $('#lf_search_with_video').removeClass('check');
           $('#lf_search_with_video').addClass('checked');
       }
       
       if( ($('#price_start').val() != '' && $('#price_start').val() != '0') || ($('#price_end').val() != '' && $('#price_end').val() != '0') ){
           $('#slf_filter_additional_data_price_block_toggle_target').removeClass('hide');
           
           if($('#price_start').val() != '' && $('#price_start').val() != '0'){
               $('#lf_price_from').val($('#price_start').val());
           }
           
           if($('#price_end').val() != '' && $('#price_end').val() != '0'){
               $('#lf_price_to').val($('#price_end').val());
           }
           
           if($('#currency').val() != '' && $('#currency').val() != '0'){
               $('#lf_currency_id option[value='+$('#currency').val()+']').attr('selected', 'selected');
           }
       }
       
       if( ($('#mileage_start').val() != '' && $('#mileage_start').val() != '0') || ($('#mileage_end').val() != '' && $('#mileage_end').val() != '0') ){
           $('#slf_filter_additional_data_race_block_toggle_target').removeClass('hide');
           
           if($('#mileage_start').val() != '' && $('#mileage_start').val() != '0'){
               $('#lf_race_from').val($('#mileage_start').val());
           }
           
           if($('#mileage_end').val() != '' && $('#mileage_end').val() != '0'){
               $('#lf_race_to').val($('#mileage_end').val());
           }
          
       }
       
       if( ($('#volume_start').val() != '' && $('#volume_start').val() != '0') || ($('#volume_end').val() != '' && $('#volume_end').val() != '0') ){
           $('#slf_filter_additional_data_more_engine_volume_toggle_target').removeClass('hide');
           
           if($('#volume_start').val() != '' && $('#volume_start').val() != '0'){
               $('#lf_engineVolumeFrom').val($('#volume_start').val());
           }
           
           if($('#volume_end').val() != '' && $('#volume_end').val() != '0'){
               $('#lf_engineVolumeTo').val($('#volume_end').val());
           }
          
       }
       
       if($('#drive_id').val() != '' && $('#drive_id').val() != '0'){
           var drive_id = $('#drive_id').val();
           $('#slf_filter_additional_data_more_drive_type_toggle_target').removeClass('hide');
           $('#lf_driveTypeId option[value="'+drive_id+'"]').attr('selected', true);
        
       }
       
       if($('#transmission_id').val() != '' && $('#transmission_id').val() != '0'){
           var tranmission = $('#transmission_id').val();
           $('#slf_filter_additional_data_more_gearbox_toggle_target').removeClass('hide');
           $('#lf_gearBoxId option[value="'+tranmission+'"]').attr('selected', true);
        
       }
       
       if($('#fuel_id').val() != '' && $('#fuel_id').val() != '0'){
           var fuel_id = $('#fuel_id').val();
           $('#slf_filter_additional_data_more_type_toggle_target').removeClass('hide');
           $('#lf_fuel_type option[value="'+fuel_id+'"]').attr('selected', true);
        
       }
       
       if($('#color_id').val() != '' && $('#color_id').val() != '0'){
           var color_id = $('#color_id').val();
           $('#slf_filter_additional_data_more_color_toggle_target').removeClass('hide');
           $('#lf_colorId option[value="'+color_id+'"]').attr('selected', true);
        
       }
       
       if($('.m_state').length>0) {
            $('.m_state').each(function() {
                $('a[pname="state"][pvalue="'+$(this).val()+'"]').addClass('checked');
                $('.hidden_subgroup[pvalue="'+$(this).val()+'"]').show();
                $('.hidden_subgroup[pvalue="'+$(this).val()+'"]').css('margin-left','12px');
            });
       }
       
       $('#search_results_count').text($('#count_result').val());
       
       
       // filtering AJAX
            
            /*  
            $('#filter_marka').change(function () {
                var mark_id = $(this).val();
                        jQuery.ajax({
                              url: '/search/ajax',
                              type:'POST',
                              data: { mark_id : mark_id, query_str : $('#queryString').val() },

                              success: function(res) {
                                    $('.wrapper_search').empty();
                                    $('.wrapper_search').append(res);
                                  }
                          }); 
               });  
               
             $('#sfl_bodyStyleId').change(function () {
                var subcat_id = $(this).val();
                        jQuery.ajax({
                              url: '/search/ajax',
                              type:'POST',
                              data: { subcat_id : subcat_id, query_str : $('#queryString').val() },

                              success: function(res) {
                                    $('.wrapper_search').empty();
                                    $('.wrapper_search').append(res);
                                  }
                          }); 
               });  
              
              $('#filter_model').change(function () {
                var model_id = $(this).val();
                        jQuery.ajax({
                              url: '/search/ajax',
                              type:'POST',
                              data: { model_id : model_id, query_str : $('#queryString').val() },

                              success: function(res) {
                                    $('.wrapper_search').empty();
                                    $('.wrapper_search').append(res);
                                  }
                          }); 
               });  
         */
        
        $('#sfl_bodyStyleId').change(function () {
            
            var subcat_id = $(this).val();
            $('#bodystyle').val(subcat_id);
            
            $('.wrapper_search').empty();
            $('.wrapper_search').append('<div id="search_form_container" class="grid grid-span2"><div class="preloader-window"></div></div>');
                
            jQuery.ajax({
                      url: '/search/ajax',
                      type:'POST',
                      data: $('#search_ajax_form').serialize(),

                      success: function(res) {
                            $('.wrapper_search').empty();
                            $('.wrapper_search').append(res);
                            $('#search_results_count').text($('#count_result').val());
                            
                            window.history.pushState('Object', 'Title', '?' + $('#queryString').val());
                          }
                  }); 
       });  
        
        $('#filter_marka').change(function () {
            
            var mark_id = $(this).val();
            $('#mark').val(mark_id);
            
            $('.wrapper_search').empty();
            $('.wrapper_search').append('<div id="search_form_container" class="grid grid-span2"><div class="preloader-window"></div></div>');
                    
                    jQuery.ajax({
                          url: '/search/ajax',
                          type:'POST',
                          //data: { mark_id : mark_id, query_str : $('#queryString').val() },
                          data: $('#search_ajax_form').serialize(),
                          success: function(res) {
                                $('.wrapper_search').empty();
                                $('.wrapper_search').append(res);
                                $('#search_results_count').text($('#count_result').val());
                                window.history.pushState('Object', 'Title', '?' + $('#queryString').val());
                              }
                      }); 
           }); 
           
           $('#filter_model').change(function () {
                var model_id = $(this).val();
                $('#model').val(model_id);
                
                $('.wrapper_search').empty();
                $('.wrapper_search').append('<div id="search_form_container" class="grid grid-span2"><div class="preloader-window"></div></div>');
                    jQuery.ajax({
                          url: '/search/ajax',
                          type:'POST',
                          data: $('#search_ajax_form').serialize(),

                          success: function(res) {
                                $('.wrapper_search').empty();
                                $('.wrapper_search').append(res);
                                $('#search_results_count').text($('#count_result').val());
                                window.history.pushState('Object', 'Title', '?' + $('#queryString').val());
                              }
                      }); 
           });  
           
           $('#filter_s_yers').change(function () {
               
                var year_start = $(this).val();
                
                if(year_start != '0' && year_start != ''){                
                    $('#year_start').val(year_start);
                } else {
                    $('#year_start').val('');
                }
                $('.wrapper_search').empty();
                $('.wrapper_search').append('<div id="search_form_container" class="grid grid-span2"><div class="preloader-window"></div></div>');
                    jQuery.ajax({
                          url: '/search/ajax',
                          type:'POST',
                          data: $('#search_ajax_form').serialize(),

                          success: function(res) {
                                $('.wrapper_search').empty();
                                $('.wrapper_search').append(res);
                                $('#search_results_count').text($('#count_result').val());
                                window.history.pushState('Object', 'Title', '?' + $('#queryString').val());
                              }
                      }); 
           });  
           
           $('#filter_po_yers').change(function () {
               
                var year_end = $(this).val();
                
                if(year_end != '0' && year_end != ''){                
                    $('#year_end').val(year_end);
                } else {
                    $('#year_end').val('');
                }
                
                $('.wrapper_search').empty();
                $('.wrapper_search').append('<div id="search_form_container" class="grid grid-span2"><div class="preloader-window"></div></div>');
                
                    jQuery.ajax({
                          url: '/search/ajax',
                          type:'POST',
                          data: $('#search_ajax_form').serialize(),

                          success: function(res) {
                                $('.wrapper_search').empty();
                                $('.wrapper_search').append(res);
                                $('#search_results_count').text($('#count_result').val());
                                window.history.pushState('Object', 'Title', '?' + $('#queryString').val());
                              }
                      }); 
           });  
           
           $('#lf_search_with_photo').live('click',function(e) {
                e.preventDefault();
                
                if($(this).attr('pchecked') == 'true'){
                    $(this).attr('pchecked', 'false');
                    
                    $('#with_photo').val('');
                    $('#lf_search_with_photo').removeClass('checked');
                    $('#lf_search_with_photo').addClass('check');
                } else if($(this).attr('pchecked') == 'false'){
                    $(this).attr('pchecked', 'true');
                    
                    $('#with_photo').val('1');
                    $('#lf_search_with_photo').removeClass('check');
                    $('#lf_search_with_photo').addClass('checked');
                }
                
                                
                $('.wrapper_search').empty();
                $('.wrapper_search').append('<div id="search_form_container" class="grid grid-span2"><div class="preloader-window"></div></div>');

                jQuery.ajax({
                          url: '/search/ajax',
                          type:'POST',
                          data: $('#search_ajax_form').serialize(),

                          success: function(res) {
                                $('.wrapper_search').empty();
                                $('.wrapper_search').append(res);
                                $('#search_results_count').text($('#count_result').val());
                                window.history.pushState('Object', 'Title', '?' + $('#queryString').val());
                              }
                      }); 
                              
          
            }); 
            
            $('#lf_search_with_video').live('click',function(e) {
                e.preventDefault();
                
                if($(this).attr('pchecked') == 'true'){
                    $(this).attr('pchecked', 'false');
                    
                    $('#with_video').val('');
                    $('#lf_search_with_video').removeClass('checked');
                    $('#lf_search_with_video').addClass('check');
                } else if($(this).attr('pchecked') == 'false'){
                    $(this).attr('pchecked', 'true');
                    
                    $('#with_video').val('1');
                    $('#lf_search_with_video').removeClass('check');
                    $('#lf_search_with_video').addClass('checked');
                }
                
                                
                $('.wrapper_search').empty();
                $('.wrapper_search').append('<div id="search_form_container" class="grid grid-span2"><div class="preloader-window"></div></div>');

                jQuery.ajax({
                          url: '/search/ajax',
                          type:'POST',
                          data: $('#search_ajax_form').serialize(),

                          success: function(res) {
                                $('.wrapper_search').empty();
                                $('.wrapper_search').append(res);
                                $('#search_results_count').text($('#count_result').val());
                                window.history.pushState('Object', 'Title', '?' + $('#queryString').val());
                              }
                      }); 
                              
          
            }); 
            
           $('#lf_price_from').change(function () {
               
               $('#price_start').val($(this).val());
               
           });  
            
            $('#lf_price_from').blur(function(event) {
                              
                $('.wrapper_search').empty();
                $('.wrapper_search').append('<div id="search_form_container" class="grid grid-span2"><div class="preloader-window"></div></div>');
                    jQuery.ajax({
                          url: '/search/ajax',
                          type:'POST',
                          data: $('#search_ajax_form').serialize(),

                          success: function(res) {
                                $('.wrapper_search').empty();
                                $('.wrapper_search').append(res);
                                $('#search_results_count').text($('#count_result').val());
                                window.history.pushState('Object', 'Title', '?' + $('#queryString').val());
                              }
                      }); 
           });  
           
           $('#lf_price_to').change(function () {
               
               $('#price_end').val($(this).val());
               
           });  
            
            $('#lf_price_to').blur(function(event) {
                              
                $('.wrapper_search').empty();
                $('.wrapper_search').append('<div id="search_form_container" class="grid grid-span2"><div class="preloader-window"></div></div>');
                    jQuery.ajax({
                          url: '/search/ajax',
                          type:'POST',
                          data: $('#search_ajax_form').serialize(),

                          success: function(res) {
                                $('.wrapper_search').empty();
                                $('.wrapper_search').append(res);
                                $('#search_results_count').text($('#count_result').val());
                                window.history.pushState('Object', 'Title', '?' + $('#queryString').val());
                              }
                      }); 
           });  
           
           $('#lf_currency_id').change(function () {
               
               if($('#lf_price_from').val() != '' || $('#lf_price_to').val() != ''){
               
                    var currency = $(this).val();

                    if(currency != '0' && currency != ''){                
                        $('#currency').val(currency);
                    } else {
                        $('#currency').val('');
                    }

                    $('.wrapper_search').empty();
                    $('.wrapper_search').append('<div id="search_form_container" class="grid grid-span2"><div class="preloader-window"></div></div>');

                        jQuery.ajax({
                              url: '/search/ajax',
                              type:'POST',
                              data: $('#search_ajax_form').serialize(),

                              success: function(res) {
                                    $('.wrapper_search').empty();
                                    $('.wrapper_search').append(res);
                                    $('#search_results_count').text($('#count_result').val());
                                    window.history.pushState('Object', 'Title', '?' + $('#queryString').val());
                                  }
                          }); 
               }           
           });  
           
           ///////////////////////////
           
           $('#lf_race_from').change(function () {
               
               $('#mileage_start').val($(this).val());
               
           });  
            
            $('#lf_race_from').blur(function(event) {
                
              //if($('#lf_race_from').val() != ''){  
                              
                $('.wrapper_search').empty();
                $('.wrapper_search').append('<div id="search_form_container" class="grid grid-span2"><div class="preloader-window"></div></div>');
                    jQuery.ajax({
                          url: '/search/ajax',
                          type:'POST',
                          data: $('#search_ajax_form').serialize(),

                          success: function(res) {
                                $('.wrapper_search').empty();
                                $('.wrapper_search').append(res);
                                $('#search_results_count').text($('#count_result').val());
                                window.history.pushState('Object', 'Title', '?' + $('#queryString').val());
                              }
                      }); 
                      
               //}
           });  
           
           $('#lf_race_to').change(function () {
               
               $('#mileage_end').val($(this).val());
               
           });  
            
            $('#lf_race_to').blur(function(event) {
                
              //if($('#lf_race_from').val() != ''){  
                              
                $('.wrapper_search').empty();
                $('.wrapper_search').append('<div id="search_form_container" class="grid grid-span2"><div class="preloader-window"></div></div>');
                    jQuery.ajax({
                          url: '/search/ajax',
                          type:'POST',
                          data: $('#search_ajax_form').serialize(),

                          success: function(res) {
                                $('.wrapper_search').empty();
                                $('.wrapper_search').append(res);
                                $('#search_results_count').text($('#count_result').val());
                                window.history.pushState('Object', 'Title', '?' + $('#queryString').val());
                              }
                      }); 
                      
              //}
           });  
           
           $('#lf_gearBoxId').change(function () {
               
                var transmission = $(this).val();
                
                if(transmission != '0' && transmission != ''){                
                    $('#transmission_id').val(transmission);
                } else {
                    $('#transmission_id').val('');
                }
                $('.wrapper_search').empty();
                $('.wrapper_search').append('<div id="search_form_container" class="grid grid-span2"><div class="preloader-window"></div></div>');
                    jQuery.ajax({
                          url: '/search/ajax',
                          type:'POST',
                          data: $('#search_ajax_form').serialize(),

                          success: function(res) {
                                $('.wrapper_search').empty();
                                $('.wrapper_search').append(res);
                                $('#search_results_count').text($('#count_result').val());
                                window.history.pushState('Object', 'Title', '?' + $('#queryString').val());
                              }
                      }); 
           });  
           
           $('#lf_engineVolumeFrom').change(function () {
               
               $('#volume_start').val($(this).val());
               
           });  
            
            $('#lf_engineVolumeFrom').blur(function(event) {
                
              //if($('#lf_race_from').val() != ''){  
                              
                $('.wrapper_search').empty();
                $('.wrapper_search').append('<div id="search_form_container" class="grid grid-span2"><div class="preloader-window"></div></div>');
                    jQuery.ajax({
                          url: '/search/ajax',
                          type:'POST',
                          data: $('#search_ajax_form').serialize(),

                          success: function(res) {
                                $('.wrapper_search').empty();
                                $('.wrapper_search').append(res);
                                $('#search_results_count').text($('#count_result').val());
                                window.history.pushState('Object', 'Title', '?' + $('#queryString').val());
                              }
                      }); 
                      
               //}
           });  
           
           $('#lf_engineVolumeTo').change(function () {
               
               $('#volume_end').val($(this).val());
               
           });  
            
            $('#lf_engineVolumeTo').blur(function(event) {
                                
              //if($('#lf_race_from').val() != ''){  
                              
                $('.wrapper_search').empty();
                $('.wrapper_search').append('<div id="search_form_container" class="grid grid-span2"><div class="preloader-window"></div></div>');
                    jQuery.ajax({
                          url: '/search/ajax',
                          type:'POST',
                          data: $('#search_ajax_form').serialize(),

                          success: function(res) {
                                $('.wrapper_search').empty();
                                $('.wrapper_search').append(res);
                                $('#search_results_count').text($('#count_result').val());
                                window.history.pushState('Object', 'Title', '?' + $('#queryString').val());
                              }
                      }); 
                      
               //}
           }); 
           
           $('#lf_fuel_type').change(function () {
               
                var fuel_id = $(this).val();
                
                if(fuel_id != '0' && fuel_id != ''){                
                    $('#fuel_id').val(fuel_id);
                } else {
                    $('#fuel_id').val('');
                }
                $('.wrapper_search').empty();
                $('.wrapper_search').append('<div id="search_form_container" class="grid grid-span2"><div class="preloader-window"></div></div>');
                    jQuery.ajax({
                          url: '/search/ajax',
                          type:'POST',
                          data: $('#search_ajax_form').serialize(),

                          success: function(res) {
                                $('.wrapper_search').empty();
                                $('.wrapper_search').append(res);
                                $('#search_results_count').text($('#count_result').val());
                                window.history.pushState('Object', 'Title', '?' + $('#queryString').val());
                              }
                      }); 
           });  
           
           $('#lf_driveTypeId').change(function () {
               
                var drive_id = $(this).val();
                
                if(drive_id != '0' && drive_id != ''){                
                    $('#drive_id').val(drive_id);
                } else {
                    $('#drive_id').val('');
                }
                $('.wrapper_search').empty();
                $('.wrapper_search').append('<div id="search_form_container" class="grid grid-span2"><div class="preloader-window"></div></div>');
                    jQuery.ajax({
                          url: '/search/ajax',
                          type:'POST',
                          data: $('#search_ajax_form').serialize(),

                          success: function(res) {
                                $('.wrapper_search').empty();
                                $('.wrapper_search').append(res);
                                $('#search_results_count').text($('#count_result').val());
                                window.history.pushState('Object', 'Title', '?' + $('#queryString').val());
                              }
                      }); 
           });  
           
           $('#lf_colorId').change(function () {
               
                var color_id = $(this).val();
                
                if(color_id != '0' && color_id != ''){                
                    $('#color_id').val(color_id);
                } else {
                    $('#color_id').val('');
                }
                $('.wrapper_search').empty();
                $('.wrapper_search').append('<div id="search_form_container" class="grid grid-span2"><div class="preloader-window"></div></div>');
                    jQuery.ajax({
                          url: '/search/ajax',
                          type:'POST',
                          data: $('#search_ajax_form').serialize(),

                          success: function(res) {
                                $('.wrapper_search').empty();
                                $('.wrapper_search').append(res);
                                $('#search_results_count').text($('#count_result').val());
                                window.history.pushState('Object', 'Title', '?' + $('#queryString').val());
                              }
                      }); 
           });
           
           $('.head-filter').live('click',function(e) {
                e.preventDefault();
                
                if($('.panel').hasClass('hide')){
                    $('#advanced_panel_contaier').removeClass('compact-filter');
                    $('.panel').removeClass('hide');
                } else {
                    $('#advanced_panel_contaier').addClass('compact-filter');
                    $('.panel').addClass('hide');
                }
                
                
          
            }); 
            
            $('#lfs_auto_id_input').keyup(function () {
               $('#auto_id').val($(this).val());
               
            });
                       
                       
            $('.send_button_ajax_form').live('click',function(e) {
                e.preventDefault();
                           
                $('.wrapper_search').empty();
                $('.wrapper_search').append('<div id="search_form_container" class="grid grid-span2"><div class="preloader-window"></div></div>');

                        jQuery.ajax({
                              url: '/search/ajax',
                              type:'POST',
                              //data: { mark_id : mark_id, query_str : $('#queryString').val() },
                              data: $('#search_ajax_form').serialize(),
                              success: function(res) {
                                    $('.wrapper_search').empty();
                                    $('.wrapper_search').append(res);
                                    $('#search_results_count').text($('#count_result').val());
                                    window.history.pushState('Object', 'Title', '?' + $('#queryString').val());
                                  }
                          }); 
               }); 
               
               
               $('#lf_reset_href').live('click',function(e) {
                e.preventDefault();
                
                $('#search_ajax_form input[type="hidden"]').val('');
                $('.m_state').remove();
                $('.m_city').remove();
                $('#queryString').val('');
                $('#count_result').val('0');
                           
                $('.wrapper_search').empty();
                $('.wrapper_search').append('<div id="search_form_container" class="grid grid-span2"><div class="preloader-window"></div></div>');

                        jQuery.ajax({
                              url: '/search/ajax',
                              type:'POST',
                              data: $('#search_ajax_form').serialize(),
                              //data: { type : 1 },
                              success: function(res) {
                                    $('.wrapper_search').empty();
                                    $('.wrapper_search').append(res);
                                    
                                    $('#search_ajax_form input[type="hidden"]').val('');
                                    $('#queryString').val('');
                                    $('#count_result').val('0');
                                    $('.m_state').remove();
                                    $('.m_city').remove();
                                    window.location = '/search/index';
                                    //window.history.pushState('Object', 'Title', '?' + $('#queryString').val());
                                    //location.reload();
                                    
                                  }
                          }); 
               }); 
               
              

});
    
     
           


