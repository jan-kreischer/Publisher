/*var obj = {
	var min_width = 0;
	var max_width = 10;
};*/



$('#article_count').on('click', function () {
	reload();
});

$(window).on('scroll', $.debounce(1048, false, function() { 
	console.log("window.scrollTop: " + $(window).scrollTop() + '; window.height: ' + $(window).height() + '; document.height: ' + $(document).height());
	console.log("screen.height: " + screen.height + " screen.width: " + screen.width);
	if($(window).scrollTop() + $(window).height() == $(document).height()) {
		console.log('reached');
		reload();
		//slide();
	}
	else {
		console.log(0);
		return
	}
}));

function getDocHeight() {
    var D = document;
    return Math.max(
        D.body.scrollHeight, D.documentElement.scrollHeight,
        D.body.offsetHeight, D.documentElement.offsetHeight,
        D.body.clientHeight, D.documentElement.clientHeight
    );
}

/*
var reload = $.debounce(1048, true, function () {

	var url = '/reload';
	var request_data = {};
	var dataType = 'json';
	
	var that_user_id = $('#that_user_id').val();
	request_data['number_items'] = $('.article-teaser').length; 
	request_data['that_user_id'] = $('.that_user_id').val();
	$.post(url, request_data, function(response_data) {
		$('#newsfeed').append(response_data['html']);
		console.log(response_data['article']);
	}, dataType);
});*/


var reload = function () {

	var url = '/reload';
	var request_data = {};
	var dataType = 'json';
	
	var that_user_id = $('#that_user_id').val();
	request_data['number_items'] = $('.article-teaser').length; 
	request_data['that_user_id'] = $('.that_user_id').val();
	$.post(url, request_data, function(response_data) {
		$('#newsfeed').append(response_data['html']);
		console.log(response_data['article']);
	}, dataType);
};

