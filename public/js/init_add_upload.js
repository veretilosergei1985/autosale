$(document).ready(function() {
	
	var id = '<!--{$entity.id}-->';
	if (id == '') id = 0;
	$("#uploadify").uploadify({
		'uploader': '../../public/js/uploadify.swf',
		'script': 'uploadify.php',
		'cancelImg': '../../public/images/cms/cancel.png',
		'queueID': 'fileQueue',
		'auto': true,
		'multi': true,
		'scriptData': {'cat_id': id},
		'onAllComplete': function() {
			UpdatePhotosList();
		} 
	});
	$('#photos-list .photo .title').click(function() {
		var photo = $(this).parent();
		var title = photo.find('.title').text();
		photo.find('.title').hide();
		photo.find('.edit textarea').html(title == 'No title' ? '' : title);
		photo.find('.edit').show();
		photo.find('.edit button.btn-save').click(function() {
			var photo = $(this).parent().parent().parent();
			var new_title = photo.find('.edit textarea').val();
			$.get('?type=ajax_update_title&id='+photo.attr('rel')+'&title='+new_title);
			if (new_title == '') {
				new_title = 'No title';
			}
			photo.find('.title').text(new_title).show();
			photo.find('.edit').hide();
			return false;
		});
		photo.find('.edit button.btn-cancel').click(function() {
			var photo = $(this).parent().parent().parent();
			photo.find('.title').show();
			photo.find('.edit').hide();
			return false;
		});
	});
	$('#photos-list .photo a.delete_photo').click(function() {
		var photo_id = $(this).attr('rel');
		$.get('?type=delete_photo&id='+photo_id);
		$('#photos-list .photo[rel='+photo_id+']').remove();
		return false;
	});
});
function UpdatePhotosList() {
	$.getJSON('action.php?type=get_photos_list&id=<!--{$entity.id}-->', function(data) {
                location.reload(true);
//		$('#photos-list').empty();
//		$.each(data, function(i, item) {
//			$('#photos-list').append('<div class="photo"><img src="<!--{$site_url_rel}-->scripts/thumb.php?src=../public/images/galleries/'+item.cat_id+'/'+item.image_file+'&w=300&h=200" /></div>');
//		});
	});
}