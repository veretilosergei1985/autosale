jQuery(function() {
     
    jQuery.ajax({
            url: '/display/checkaddcar',
            type:'POST',
            success: function(res) {
                     $('#mainauthcontainer__addcars').append(res);
                }


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

        $('#selectedtypetext__addcars').text($(this).text());
        $('#selectedtypeicon__addcars').removeAttr('class');
        $('#selectedtypeicon__addcars').addClass($(this).find('i').attr('class'));
        $('#transpottype__addcars').hide(); 
        $('#cat_id').val($(this).attr('category_id'));
    
    });
    
    
     jQuery('#choosebodystyle__addcars').live('click',function(e) {
        e.preventDefault();
        
        if($('#cat_id').val() == '' || $('#cat_id').val() == '0'){
            
        } else {
            
        }
        
    
    });
     
           
    
});
