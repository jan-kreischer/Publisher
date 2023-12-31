@extends('templates.default')

@section('title')
	{{{$that_user->first_name . ' ' . $that_user->last_name}}}
@stop

@section('css')
	<link rel="stylesheet" href="includes/css/dropzone.css" media="all">
	<link rel="stylesheet" href="includes/css/bootstrap-select.min.css" media="all">
@stop

@section('js')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.js"></script>
	<script src="includes/js/bootstrap-select.min.js"></script>
	{{HTML::script(Config::get('c.js.path') . '/rate.js', [], TRUE);}}
@stop

@section('content')
<div class="row">
	{{$that_user->hidden_user_id()}}
	<div id="" class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-box">
		@if($view['is_private'] == TRUE)
			@include('user.parts.article_editor_section')
		@endif
		
		@include('user.parts.newsfeed')
		
		<div class="col-" id="article_count" title="load more&hellip;">
			<i class="fa fa-file-text-o"></i>
			{{$that_user->articles_count()}} Articles
		</div>
	</div>
	
	<div id="" class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-box">
		<div class="col- well" id="user">
			@include('user.parts.user_image_section')
		</div>
		
		<div class="col- well" id="info_section">
			@include('user.parts.info_section')
		</div>
		
		<div class="col- well" id="subscriber_section">
			@include('user.parts.subscribers')
		</div>
		
		<div class="col- well" id="subscriptions_section">
			@include('user.parts.authors')
		</div>
			
		<div class="col- well" id="user_advertising">
			@include('templates.parts.advertising')
		</div>

		<div class="col-">
			@include('templates.parts.info')
		</div>

	</div>

{{HTML::script(Config::get('c.js.path') . '/slide.js');}}
<script>
	$(document).ready(function($){
		var article_form = $('#article_form');
	    article_form.on('submit', function(e){ 
			e.preventDefault();	
	
			var url = article_form.attr('action');
			var request_data = {};
			var dataType = 'json';
			
			article_form.find(':input').each(function(){
				var name = $(this).prop('name');
				var value = $(this).val();
				if(name && value) {
			    	request_data[name] = value;
				}
			});
			
			$.post(url, request_data, function(response_data, textStatus, jqXHR) {
				if(textStatus === 'success'){
					$('#article_title').val('');
					$('#article_content').val('');
					$('#article_visibility').val('public');
					window.location.href = response_data['href'];
				}
				else {
					console.log('REQUEST_DATA:' + request_data);
					console.log('RESPONSE_DATA:' + response_data);
				}
			}, dataType);
	    });
	});
</script>

<script>
//script  to open file select dialog
/*
$(document).ready(function() {
	
	var button = '#profile_picture_upload_button';
	var form = '#profile_picture_upload_form';
	var select = '#profile_picture_upload_select';

	$(button).click(function(event) {
		event.preventDefault();	
		$(select).trigger('click');
	});
		/*

		$(file_select).change(function(event) {
			var request_data = event.target.files[0];
			console.log(request_data);
			//var request_data = $(file_select).files['0'];
			/*
			console.log(request_data);
		    $(form).submit(function(e) {
				event.preventDefault();
			});
			console.log(request_data);
			$.post('/upload', request_data, function(response_data) {
				console.log(response_data)
				if(response_data.success === true){
					console.log('success');
				}			
			});/*
			loadImage(request_data, function(img) {
				console.log(img)
			},{
				maxWidth: 1000,
				maxHeight: 1000
			});
		    /*$.ajax({
	             type: "POST",
	             url: "/upload",
	             data: request_data,
	             success: function (response_data) {
	                 console.log(response_data);
	             }
	         });	    
		});
	});
});*/
</script>

@stop