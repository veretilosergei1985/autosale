jQuery(function() {

	jQuery('.to_archive').live('click', function(e) {
		e.preventDefault();
		var id = $(this).attr('rel');

		$('#autoDeleteReason' + id).show();
		$('#auto_search_item_another_events_container_' + id).addClass('hide');
	});

	jQuery('.edit-my-offer .close-alert').live('click', function(e) {
		e.preventDefault();
		var id = $(this).attr('rel');

		$('#autoDeleteReason' + id).hide();
		$('#auto_search_item_another_events_container_' + id).addClass('hide');
	});

	jQuery('.to_archive_button_cancel').live('click', function(e) {
		e.preventDefault();
		var id = $(this).attr('auto_id');

		$('#autoDeleteReason' + id).hide();
		$('#auto_search_item_another_events_container_' + id).addClass('hide');
	});

	jQuery('input[type="radio"][name="reason_id"]').live('click', function(e) {
		var id = $(this).attr('auto_id');

		$('#formmm_span_' + id).removeClass('disabled');
		$('#formmm_span_' + id).removeClass('grey-30');
		$('#formmm_span_' + id).addClass('red-30');

		$('#formmm_' + id).removeAttr('disabled');

		//$('#autoDeleteReason'+id).hide();
		$('#auto_search_item_another_events_container_' + id).addClass('hide');


	});

	jQuery('.to_archive_submit').live('click', function(e) {
		e.preventDefault();
		var elem = $(this);
		var id = $(this).attr('auto_id');

		jQuery.ajax({
			url: '/catalog/toarchive',
			type: 'POST',
			data: $('#complaintAdvertisementForm-' + id).serialize(),
			success: function(res) {
				if (res == '1') {
					$('.ticket-item[ticket_auto_id="' + id + '"]').remove();
					window.location = "/user/myautos";
				}
			}
		});
	});

	jQuery('.delete_auto').live('click',function(e) {
        e.preventDefault();
        var auto_id = $(this).attr('auto_id');
        if(auto_id != ''){
            jQuery.ajax({
                url: '/catalog/deleteauto',
                type:'POST',
                data: {'auto_id' : auto_id},
                success: function(res) {
					if(res == 1){
						$('.item-ticket["auto_ticket="'+auto_id+']').remove();
					}
                }
            });
        }
    });

});
