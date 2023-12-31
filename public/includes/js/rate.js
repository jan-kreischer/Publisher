$(document).ready(function(){
	var rating = function() {
		$('.rating-button').on('click', function (ev) {
			ev.preventDefault();
			var el = $(this);
			
			var url = '/rate';
			var request_data = {};
			var dataType = 'json';
			
			var rating_section = $(this).parent();

			if($(this).attr('data-rating') == 'up') {
				request_data['rating_value'] = +1;
			}
			else if($(this).attr('data-rating') == 'down') {
				request_data['rating_value'] = -1;
			}
			request_data['rating_type'] = $(this).attr('data-rating-type');
			//request_data['article_id'] = $('.article_id', rating_section).attr('value');
			var article_id = el.closest('div[class^="col-"]').find('.article-id').val();
			request_data['article_id'] = article_id;
			
			$.post(url, request_data, function(response_data) {

				if(response_data.success === true){
					$('.up > span', rating_section).text(response_data.up_count);
					$('.down > span', rating_section).text(response_data.down_count);
					
					if(response_data.rating_value === 1) {
						//top state
						$('.up > i', rating_section).addClass('active');
						$('.down > i', rating_section).removeClass('active');
					}
					else if(response_data.rating_value === -1) {
						//down state
						$('.down > i', rating_section).addClass('active');
						$('.up > i', rating_section).removeClass('active');
					}
					else {
						//neutral state
						$('.up > i', rating_section).removeClass('active');
						$('.down > i', rating_section).removeClass('active');
					}
				}
			}, dataType);			
	    });
	}
	rating();
});