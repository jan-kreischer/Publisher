$(document).ready(function(){
	//get the action
	var form = $('#tag_form');
	var button = $('#tag_button');
	var input = $('#tag_content');
	
	var url = form.attr('action');
	var request_data = {};
	var dataType = 'json';

    button.on('click', function(e){ 
		e.preventDefault();	

		form.find(':input').each(function(){
			var name = $(this).attr('name');
			var value = $(this).val();
			if(name && value) {
		    	request_data[name] = value;
			}
		});

		$.post(url, request_data, function(response_data, textStatus, jqXHR) {
			if(textStatus == 'success') {
				input.val('');
				if(response_data['success'] == true) {
					$('#tags_section').append(response_data['html']);
				}
			}
			//status == error
			else {
				console.log(request_data);
				console.log(response_data);
			}
				
		}, dataType);
    });
});