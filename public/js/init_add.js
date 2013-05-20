jQuery(function() {
     
    jQuery.ajax({
            url: '/display/checkaddcar',
            type:'POST',
            success: function(res) {
                     $('#mainauthcontainer__addcars').append(res);
                }


        }); 
    
    jQuery('#submit').live('click',function(e) {
        e.preventDefault();
        
        var element = $(this);
        var id = $(this).attr('rel');
        
        jQuery.ajax({
                url: '/user/carregister',
                type:'POST',
                data: $('.reg_form').serialize(),
                success: function(res) {
                        data = jQuery.parseJSON(res);

                        var tips = '';
                        for (var i in data) {

                            tips += '<div><span class="bold"> ' + data[i].label + '</span>' + data[i].message + '</div>';
                        }

                        $('#registrationerrors__addcars').append(tips);
                        $('#registrationerrors__addcars').css({'display':'block'});
                    }
                   
                }
            ); 
    
    });
    

    
    
    
     
           
    
});
