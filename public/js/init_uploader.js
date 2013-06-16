$(document).ready(function () {

    // uploader photos
    var uploadPropPhoto = new qq.FileUploader({
        element:document.getElementById('photo_div'),
        action:'/display/uploadphotoscar',
        params: { auto_id: $('#autoId').val() },
        multiple:true,
        onSubmit:function(id, fileName){
            $('#loading_bar').fadeIn('fast');
        },
        onComplete:function (id, fileName, responseJSON) {
            if (responseJSON.success) {
                $('#photogallerycontainer__addcars').show();
                 if (responseJSON.main_photo) {
                
                    $('#mainphotocontainer__addcars img').attr('src', responseJSON.photo);
                    $('#mainphotocontrols__addcars a.delete_main_photo').attr('rel', responseJSON.photo_id);
                    $('#mainphotocontrols__addcars').show();

                 } else {
                     
                     var html = '<div id="'+responseJSON.photo_id+'" class="item-photo">'+
                                    '<div class="photo photo-85x56">'+
                                        '<img width="85" src="'+responseJSON.photo+'">'+
                                    '</div>'+
                                    '<div class="control-bar">'+
                                        '<p class="item-control">'+
                                            '<i class="icon-add__delete"></i>'+
                                            '<a rel="'+responseJSON.photo_id+'" class="delete_photo" href="javascript:void(0);">удалить</a>'+
                                        '</p>'+
                                        '<p class="item-control">'+
                                            '<i class="icon-add__star"></i>'+
                                            '<a class="do_main" rel="'+responseJSON.photo_id+'" href="javascript:void(0);">сделать главным</a>'+
                                        '</p>'+
                                    '</div>'+
                                  '</div>';
                      $('#uploadingphotocontainer__addcars').append(html);    
                     
                 }
                
                /*
                $('#loading_bar').fadeOut('fast');
                var photoid = 'photo-' + responseJSON.index;
                var photoIndex = parseInt($('#photo-index').val()) + 1;
                $('#photo-index').val(photoIndex);
                var html = '<div id="' + photoid + '" class="wrap-photo">' +
                    '<img class="photo" src="' + responseJSON.photo + '" alt="" /><a href="#" title="Set as primary photo"' +
                    ' onclick="setPrimaryPhoto(\'' + photoid + '\', \'' + responseJSON.photo + '\'); return false;"' +
                    ' class="link-photo" style="display: none;">primary</a><a href="#" title="Delete photo"' +
                    ' onclick="deletePhoto(\'' + photoid + '\', \'' + responseJSON.photo + '\'); return false;"' +
                    ' class="link-photo link-delete" style="display: none;">delete</a>' +
                    '<input type="hidden" name="photo-' + photoIndex + '" value="' + responseJSON.photo + '" /></div>';
                $('#photo_div').append(html);

                $('#' + photoid).bind('mouseover', function () {
                    $(this).children('a').show();
                });

                $('#' + photoid).bind('mouseout', function () {
                    $(this).children('a').hide();
                });

                validateAbilityEdit();
                */
                
            }
        }
    });

    
    

});

