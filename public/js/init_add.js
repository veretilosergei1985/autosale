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

    
    
    
     
           
    
});
