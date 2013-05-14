jQuery(function() {
     
    jQuery.ajax({
            url: '/display/getregions',
            type:'POST',
            
            success: function(res) {
                
                data = jQuery.parseJSON(res);                
                     var tips = '';
                        for (var i in data) {
                            tips += '<option value="'+ data[i].id + '">' + data[i].name + '</option>';
                        }
                        $('#region').append(tips);
                       
                }


        }); 
        

        $('#region').change(function () {

            var region_id = $(this).val();
            /*
             * Если значение селекта равно 0,
             * т.е. не выбрана страна, то мы
             * не будем ничего делать
             */ 
            if (region_id == '0') {
                $('#city').html('');
                $('#city').attr('disabled', true);
                return(false);
            }
            
            jQuery.ajax({
                  url: '/display/getcity',
                  type:'POST',
                  data: { region_id : region_id },
                  
                  success: function(res) {

                      data = jQuery.parseJSON(res);                
                           var tips = '';
                              for (var i in data) {
                                  tips += '<option value="'+ data[i].id + '">' + data[i].name + '</option>';
                              }
                              $('#city').append(tips);

                      }


              }); 
        });
    

    
    
    
     
           
    
});
