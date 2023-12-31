$(document).ready(function() {
	$(document).on('click', '.article-delete', function(e) {
		e.preventDefault();
		alert('hallo');
		var el = $(this);
		
		var request_data = {};
		var url = 'article/delete';
		var dataType = 'json';
		
		var article_preview = el.closest('div[class^="col-"]');
		var article_id = article_preview.find('.article-id').val();
		console.log(article_id);
		var is_confirmed = confirm("delete this article?");
		if (is_confirmed == true) {
			request_data['article_id'] = article_id;
			$.post(url, request_data, function(response_data, textStatus, jqXHR) {
				console.log(response_data);
				article_preview.hide();
			}, dataType);
		}
	});
});
