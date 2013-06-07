$(document).ready(function () {

    // uploader photos
    var uploadPropPhoto = new qq.FileUploader({
        element:document.getElementById('photo_div'),
        action:'/js/upload.php',
        multiple:false,
        onSubmit:function(id, fileName){
            $('#loading_bar').fadeIn('fast');
        },
        onComplete:function (id, fileName, responseJSON) {
            if (responseJSON.success) {
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
            }
        }
    });

    $('.wrap-photo').bind('mouseover', function () {
        $(this).children('a').show();
    });

    $('.wrap-photo').bind('mouseout', function () {
        $(this).children('a').hide();
    });

    $('#membership').bind('change', function () {
        $.ajax({
            type:'post',
            url:'/properties/validate-add-photo/',
            datatype:'html',
            data:{
                msid:$('#membership').val(),
                countPhotos:$('.photo').length
            },
            success:function (answer) {
                var data = JSON.parse(answer);
                $('#limitCountPhoto').hide();
                $('#uploadPropPhoto').show();
                if (!data.allowAddPhoto) {
                    $('#photo_div').empty();
                }

                return false;
            }
        });
    });

});

function validateAbilityEdit() {
    $.ajax({
        type:'post',
        url:'/properties/validate-ability-edit/',
        datatype:'html',
        data:{
            edit:edit,
            msid:$('#membership').val(),
            countPhotos:$('.photo').length
        },
        success:function (answer) {
            var data = JSON.parse(answer);

            if (data.error) {
                $.each(data.error, function (key, value) {
                    $('#' + key).show();
                    if (key == 'limitEditPhoto') {
                        $('#uploadPropPhoto').remove();
                        $('.wrap-photo').unbind();
                        $('.wrap-photo a').remove();
                    } else {
                        $('#uploadPropPhoto').hide();
                        $('.wrap-photo a').hide();
                    }
                });
            }

            return false;
        }
    });
}

function setPrimaryPhoto(photoId, photo) {
    $.ajax({
        type:'post',
        url:'/properties/set-primary-photo-add/',
        datatype:'html',
        data:{
            photo:photo
        },
        success:function (answer) {
            if (answer == 'success') {
                $('.primary-photo').removeClass('primary-photo');
                $('#' + photoId).addClass('primary-photo');
            }
        }
    });
}

function deletePhoto(photoId, photo) {
    if ($('#' + photoId).hasClass('primary-photo')) {
        alert('You cannot delete primary photo!');
    } else {
        $.ajax({
            type:'post',
            url:'/properties/delete-photo/',
            datatype:'html',
            data:{
                photo:photo,
                edit:edit,
                msid:$('#membership').val(),
                countPhotos:$('.photo').length
            },
            success:function (answer) {
                var data = JSON.parse(answer);

                if (data.success) {
                    $('#' + photoId).detach();
                }

                if (data.allowAddPhoto) {
                    $('#uploadPropPhoto').show();
                    $('#limitCountPhoto').hide();
                }
            }
        });
    }
}
