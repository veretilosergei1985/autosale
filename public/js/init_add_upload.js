$(document).ready(function () {

    jQuery('.item-control .delete_photo').live('click',function(e) {
        e.preventDefault();
        
        var photo_id = $(this).attr('rel');
        
        if(photo_id != ''){
            jQuery.ajax({
                url: '/display/deletephoto',
                type:'POST',
                data: {'photo_id' : photo_id, 'auto_id': $('#autoId').val() },
                success: function(res) {
                        
                        if(res == 1){
                            $('#'+photo_id).remove();
                        }
                        
                    }


            }); 
        }
    });
    
    jQuery('.do_main').live('click',function(e) {
        e.preventDefault();
        var elem = $(this);
        
        var newMainPhotoId = $(this).attr('rel');
        var oldMainPhotoId = $(".delete_main_photo").attr('rel');
        
        if(typeof oldMainPhotoId !== "undefined" && typeof newMainPhotoId !== "undefined"){

                jQuery.ajax({
                    url: '/display/changemainphoto',
                    type:'POST',
                    data: {'old_photo' : oldMainPhotoId, 'new_photo': newMainPhotoId, 'auto_id': $('#autoId').val() },
                    success: function(res) {
                            data = jQuery.parseJSON(res);
                            if(data.result == 'ok'){

                                $('#mainphotocontainer__addcars img').attr('src', data.new_path);
                                $('#mainphotocontrols__addcars a.delete_main_photo').attr('rel', data.new_main_photo);
                                $('#mainphotocontrols__addcars').show();
                                
                                $('#'+data.new_main_photo+' img').attr('src', data.old_path);
                                $('#'+data.new_main_photo).attr('id', data.old_main_id);
                                $(elem).attr('rel', data.old_main_id);
                                $('#'+data.old_main_id+' .delete_photo').attr('rel', data.old_main_id);
                           }

                        }


                }); 

        }
    });
    

    jQuery('#mainphotocontrols__addcars a.delete_main_photo').live('click',function(e) {
        e.preventDefault();
        
        var oldMainPhotoId = $(this).attr('rel');
        var newMainPhotoId = $("#uploadingphotocontainer__addcars .item-photo:first-child").attr('id');
        
        if(typeof oldMainPhotoId !== "undefined"){
            if(typeof newMainPhotoId !== "undefined"){
                jQuery.ajax({
                    url: '/display/deletemainphoto',
                    type:'POST',
                    data: {'old_photo' : oldMainPhotoId, 'new_photo': newMainPhotoId, 'auto_id': $('#autoId').val() },
                    success: function(res) {
                            data = jQuery.parseJSON(res);
                            if(data.result == 'ok'){

                                $('#mainphotocontainer__addcars img').attr('src', data.path);
                                $('#mainphotocontrols__addcars a.delete_main_photo').attr('rel', data.main_photo);
                                $('#mainphotocontrols__addcars').show();


                                $('#'+data.main_photo).remove();
                            }

                        }


                }); 
            } else {
            // only one photo exist
            // remove from server, remove from table and insert def. image in main image
            
            jQuery.ajax({
                    url: '/display/deletemainphoto',
                    type:'POST',
                    data: {'old_photo' : oldMainPhotoId, 'auto_id': $('#autoId').val() },
                    success: function(res) {
                            data = jQuery.parseJSON(res);
                            if(data.result == 'ok'){

                                $('#mainphotocontainer__addcars img').attr('src', 'http://img.auto.ria.ua/images/no-photo/no-photo-135x90.jpg');
                                $('#mainphotocontrols__addcars a.delete_main_photo').attr('rel', '');
                                $('#mainphotocontrols__addcars').hide();


                                $('#'+data.main_photo).remove();
                            }

                        }


                }); 
            }
        } 
    });
    
    
    jQuery('#uploadvideofromyoutube__addcars').live('click',function(e) {
        e.preventDefault();

            jQuery.ajax({
                url: '/display/showuploadvideopopup',
                type:'POST',
               success: function(res) {
                       $('#uploadvideofromyoutube__addcars').after(res);                   
                       
                    }


            }); 

    });
    
    
    jQuery('#cancelyoutubepopup__addcars').live('click',function(e) {
        e.preventDefault();
        $('#addyoutubevideopopup__addcars').hide();
    });
    
    
    jQuery('#uploadyoutubevideo__addcars').live('click',function(e) {
        e.preventDefault();
        $('#errorblock__addcars').empty();
        $('#errorblock__addcars').hide();
            jQuery.ajax({
               url: '/display/downloadfromyoutube',
               type:'POST',
               data: {'url': $('#youtubeurlinput__addcars').val(), 'auto_id': $('#autoId').val() },
               success: function(res) {
                             data = jQuery.parseJSON(res);
                             if(data.result == 'ok'){

                                 $('.delete_video').attr('rel', data.id);
                                 $('#uploadedvideopreview__addcars img').attr('src', data.path);
                                 $('#uploadedvideopreview__addcars').attr('href', data.video_url[0]);
                                 $('#uploadingvideocontainer__addcars').show();
                                 
                                 $('#addyoutubevideopopup__addcars').remove();
                                 $('#photogallerycontainer__addcars').show();
                                 
                             } else if(data.result == 'error' && data.reason == 'video_exist') {
                                 $('#errorblock__addcars').append(data.message);
                                 $('#errorblock__addcars').show();
                                 $('#addyoutubevideopopup__addcars').hide();
                             } else if(data.result == 'error' && data.reason == 'no_found') {
                                 $('#errorblock__addcars').append(data.message);
                                 $('#errorblock__addcars').show();
                                 $('#addyoutubevideopopup__addcars').hide();
                             }
                        }
            }); 
    });
    
    jQuery('.delete_video').live('click',function(e) {
        e.preventDefault();
        
        var video_id = $(this).attr('rel');
        
        if(video_id != ''){
            jQuery.ajax({
                url: '/display/deletevideo',
                type:'POST',
                data: {'video_id' : video_id, 'auto_id': $('#autoId').val() },
                success: function(res) {
                        
                        if(res == 1){
                            $('.delete_video').attr('rel', '');
                            $('#uploadedvideopreview__addcars img').attr('src', '');
                            $('#uploadedvideopreview__addcars').attr('href', '');
                            $('#uploadingvideocontainer__addcars').hide();
                        }
                        
                    }


            }); 
        }
    });
    
    jQuery('#state-13').live('click',function(e) {
       
       if ($(this).is(':checked')) {
            $('#matchedCarCountry').show();
            $('#matchedCarCountry').removeAttr('disabled');
       } else {
           $('#matchedCarCountry').hide();
            $('#matchedCarCountry').attr('disabled', 'disabled');
       } 
       
    });  
    
    $('#description__addcars').limit('1024','#maxdescriptionslength__addcars');
    
    
   

});

