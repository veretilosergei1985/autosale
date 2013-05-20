jQuery(function() {
     
    /* 
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
      */  
     
        var city_id = $('#city option:selected').val();
        
        //if(city_id != ''){
            var region_id = $('#region option:selected').val();

            if(region_id != ''){
                jQuery.ajax({
                    url: '/display/getcity',
                    type:'POST',
                    data: { region_id : region_id },

                    success: function(res) {

                        //data = jQuery.parseJSON(res);                
                               var tips = '';
                                $("select[name='city'] option").remove();
                                var tips = '<option value="">Выберите</option>';

//                                  for (var i in data) {
//                                      tips += '<option value="'+ data[i].id + '">' + data[i].name + '</option>';
//                                  }
                                  tips +=res;
                                  $('#city').append(tips);

                        }


                }); 
            }
        //}
        

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

                      //data = jQuery.parseJSON(res);                
                           var tips = '';
                            $("select[name='city'] option").remove();
                            var tips = '<option value="">Выберите</option>';
                            
//                              for (var i in data) {
//                                  tips += '<option value="'+ data[i].id + '">' + data[i].name + '</option>';
//                              }
//                              $('#city').append(tips);
                                tips +=res;
                                  $('#city').append(tips);

                      }


              }); 
        });
    

    
    
    
     
           
    
});
