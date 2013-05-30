jQuery(function() {
    
          
     
    jQuery.ajax({
            url: '/display/checkaddcar',
            type:'POST',
            success: function(res) {
                     $('#mainauthcontainer__addcars').append(res);
                }


        }); 
        
    jQuery.ajax({
            url: '/display/bodytype',
            type:'POST',
            success: function(res) {
                     $('#bodystylespopup__addcars').append(res);
                     //$('#bodystylespopup__addcars').show();
                }


    }); 
    
    
    jQuery('#transpottype__addcars a').live('click',function(e) {
        e.preventDefault();
        
        var category_id = $(this).attr('category_id');
        $('#category__addcars').val(category_id);
        
        jQuery.ajax({
            url: '/display/bodytype',
            type:'POST',
            data: {'category_id' : $('#category__addcars').val()},
            success: function(res) {
                     $('.window-bodytype').remove();
                     $('#bodystylespopup__addcars').append(res);
                     //$('#bodystylespopup__addcars').show();
                }


        }); 
    });
    
    jQuery('#choosebodystyle__addcars').live('click',function(e) {
        e.preventDefault();
             
        if($('#category__addcars').val() !== '0'){
            $('#bodystylespopup__addcars').show();
        } else {
            $('#categoryerrormessage__addcars').show();
        }
        
    });
    
    jQuery('.close').live('click',function(e) {
        e.preventDefault();
              
        $('#categoryerrormessage__addcars').hide();
    });
    
    jQuery('#closebodystyle__addcars').live('click',function(e) {
        e.preventDefault();
              
        $('#bodystylespopup__addcars').hide();
        $('#categoryerrormessage__addcars').hide();
    });
    
    
    
    jQuery('.car_reg_submit').live('click',function(e) {
        e.preventDefault();
        $("#registrationerrors__addcars").empty();
        $('#registrationerrors__addcars').css({'display':'none'});
        var element = $(this);
        var id = $(this).attr('rel');
        
        jQuery.ajax({
                url: '/user/carregister',
                type:'POST',
                data: $('.reg_form').serialize(),
                success: function(res) {
                        data = jQuery.parseJSON(res);
                        
                        if(data.status == 'success'){
                            jQuery.ajax({
                                url: '/display/checkaddcar',
                                type:'POST',
                                success: function(res) {
                                         $('#mainauthcontainer__addcars').empty();
                                         $('#mainauthcontainer__addcars').append(res);
                                    }


                            }); 
                        } else {

                            var tips = '';
                            for (var i in data) {

                                tips += '<div><span class="bold"> ' + data[i].label + '</span>' + data[i].message + '</div>';
                            }

                            $('#registrationerrors__addcars').append(tips);
                            $('#registrationerrors__addcars').css({'display':'block'});
                        }
                    }
                   
                }
            ); 
    
    });
    
    jQuery('.car_log_submit').live('click',function(e) {
        e.preventDefault();
        $("#loginerrors__addcars").empty();
        $('#loginerrors__addcars').css({'display':'none'});
        var element = $(this);
        var id = $(this).attr('rel');
        
        jQuery.ajax({
                url: '/user/carlogin',
                type:'POST',
                data: $('.log_form').serialize(),
                success: function(res) {
                        data = jQuery.parseJSON(res);
                        
                        if(data.status == 'success'){
                            jQuery.ajax({
                                url: '/display/checkaddcar',
                                type:'POST',
                                success: function(res) {
                                         $('#mainauthcontainer__addcars').empty();
                                         $('#mainauthcontainer__addcars').append(res);
                                    }


                            });
                        } else if(data.status == 'error'){
                            $('#loginerrors__addcars').append('<p style="margin-bottom: 0px;">Указанный Вами e-mail не присутствует в базе.<a href="/user/register">Зарегистрируйтесь</a></p>');
                            $('#loginerrors__addcars').css({'display':'block'});
                        
                        } else {

                            var tips = '';
                            for (var i in data) {

                                tips += '<div><span class="bold"> ' + data[i].label + '</span>' + data[i].message + '</div>';
                            }

                            $('#loginerrors__addcars').append(tips);
                            $('#loginerrors__addcars').css({'display':'block'});
                        }
                    }
                   
                }
            ); 
    
    });

        
    jQuery('.select-ed').live('click',function(e) {
        e.preventDefault();

        
        if($('#transpottype__addcars').css('display') == 'none'){ 
            $('#transpottype__addcars').show(); 
        } else { 
            $('#transpottype__addcars').hide(); 
        }
    
    });
    
    jQuery('#transpottype__addcars .item').live('click',function(e) {
        e.preventDefault();
        
        if($(".name-bodystyle").length>0) {
            $(".name-bodystyle").remove();
            $('#replacedelement__addcars').append('<span class="element-select"><a id="choosebodystyle__addcars" class="selected" href="javascript:void(0);">Выбрать</a></span>');
        }

        $('#selectedtypetext__addcars').text($(this).text());
        $('#selectedtypeicon__addcars').removeAttr('class');
        $('#selectedtypeicon__addcars').addClass($(this).find('i').attr('class'));
        $('#transpottype__addcars').hide(); 
        $('#cat_id').val($(this).attr('category_id'));
    
    });
    
    
     jQuery('#choosebodystyle__addcars_btn').live('click',function(e) {
        e.preventDefault();
        if($(".name-bodystyle").length>0) {
            $(".name-bodystyle").remove();
        }
        
        if($('.radio-bodytype:checked').length>0) {    
            var radio = $('.radio-bodytype:checked');
            var title = $(radio).next();
            
            $('#replacedelement__addcars .element-select').remove();
            $('#replacedelement__addcars').append('<div class="name-bodystyle"><strong>' +  $(title).text() + '</strong>[<a id="choosebodystyle__addcars" href="javascript:void(0);">изменить</a>]</div>');
        }
        
        $('#bodystylespopup__addcars').hide();
    
    });
    
    jQuery('#cancelbodystyle__addcars').live('click',function(e) {
        $('#bodystylespopup__addcars').hide();
    });
    
     $('#mark').change(function () {
         
            if($(this).find("option:selected").val() != ''){
                var mark_name = $(this).find("option:selected").text();
                $('#previewmarka__addcars').text(mark_name);
            } else {
                var mark_name = 'Марка';
                $('#previewmarka__addcars').text(mark_name);
                
                var model_name = 'Модель';
                $('#previewmodel__addcars').text(model_name);
            }

            var mark_id = $(this).val();

            if (mark_id == '') {
                $('#model').html('');
                $('#model').attr('disabled', true);
                return(false);
            } else {
                
                $('#model').attr('disabled', false);
                    jQuery.ajax({
                          url: '/display/getmodel',
                          type:'POST',
                          data: { mark_id : mark_id },

                          success: function(res) {

                              //data = jQuery.parseJSON(res);                
                                   var tips = '';
                                    $("select[name='model'] option").remove();
                                    var tips = '<option value="">Выберите</option>';

        //                              for (var i in data) {
        //                                  tips += '<option value="'+ data[i].id + '">' + data[i].name + '</option>';
        //                              }
        //                              $('#city').append(tips);
                                        tips +=res;
                                          $('#model').append(tips);

                              }


                      }); 
              
            }
    });  
    
    
    jQuery('#selectcolor__addcars').live('click',function(e) {
        e.preventDefault();

        if($('#fuel').val() == '0'){
            $('#showchoosefuelratesnotice__addcars').show();
        }

        $('#colorslist__addcars').show();
        
    
    });
    
    jQuery('#colorslist__addcars a').live('click',function(e) {
        e.preventDefault();
      
        var html = $(this).html();

        $('#selectcolor__addcars').empty();
        $('#selectcolor__addcars').append(html);
        $('#colorslist__addcars').hide();
    
    });
    
    jQuery('#choosefuelrates__addcars').live('click',function(e) {
        e.preventDefault();

        if($('#fuel').find(":selected").val() == ''){
            $('#showchoosefuelratesnotice__addcars').show();
        } else {
            $('#fuelratesblock__addcars').show();
            $('#choosefuelrates__addcars').hide();
        }
       
    
    });
        
    jQuery('#fuel').live('change',function(e) {
        $('#showchoosefuelratesnotice__addcars').hide();
    
    });    
    
           
    jQuery('#choosefuelrates__addcars').live('click',function(e) {
        e.preventDefault();
        
        $('#colorslist__addcars').hide();
    
    });  
    
    jQuery('#showchoosefuelratesnotice__addcars .close').live('click',function(e) {
        e.preventDefault();
        
        $('#showchoosefuelratesnotice__addcars').hide();
    
    });  
    
    jQuery('.fuel-consumption input').live('keyup',function(e) {
        e.preventDefault();
       
//       var regexp = /^\d+$/; 
//	 
//        if(!regexp.test($(this).val())){
//            $(this).val('');
//        } 
    
    }); 
    
    
    jQuery('#specifypower__addcars').live('click',function(e) {
        e.preventDefault();
        $('#powerblock__addcars').show();
        $(this).hide();
    
    });  
    
    
    jQuery('#region').live('change',function(e) {
        e.preventDefault();
        
        if($(this).find("option:selected").val() != ''){
            var reg_name = $(this).find("option:selected").text();
            $('#previewcity__addcars').text(reg_name);
        } else {
            var reg_name = 'Город';
            $('#previewcity__addcars').text(reg_name);
        }
    
    });
    

    
    jQuery('#model').live('change',function(e) {
        e.preventDefault();
        
        if($(this).find("option:selected").val() != ''){
            var model_name = $(this).find("option:selected").text();
            $('#previewmodel__addcars').text(model_name);
        } else {
            var model_name = 'Модель';
            $('#previewmodel__addcars').text(model_name);
        }
    
    });  
    
    jQuery('#year').live('change',function(e) {
        e.preventDefault();
        
        if($(this).find("option:selected").val() != ''){
            var year = $(this).find("option:selected").text();
            $('#previewyear__addcars').text(year);
        } else {
            var year = 'Год выпуска';
            $('#previewyear__addcars').text(year);
        }
    
    });  
    
    jQuery('.item-ad input').live('change',function(e) {
        //e.preventDefault();
        if($(this).val() != '0'){
            $('#previewishot__addcars').removeAttr('class');
            $('#previewticket__addcars').addClass('paid');
            $('#previewishot__addcars').addClass($(this).next().attr('class'));
            
        } else {
            $('#previewticket__addcars').removeClass('paid');
            $('#previewishot__addcars').removeAttr('class');
        }
        
        
    
    
    });  
    
        
    jQuery('body').click(function() {

        if($('#transpottype__addcars').css('display') == 'block'){ 
            $('#transpottype__addcars').hide(); 
        }
    });
    
    
     
           
    
});
