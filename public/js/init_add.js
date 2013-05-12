jQuery(function() {
     
    jQuery.ajax({
            url: '/display/checkaddcar',
            type:'POST',
            success: function(res) {
                     $('#mainauthcontainer__addcars').append(res);
                }


        }); 
    

    
    
    
     
           
    
});
