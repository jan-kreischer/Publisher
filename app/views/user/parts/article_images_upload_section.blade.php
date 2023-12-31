	<a href="#" id="article_image_upload_button" class="btn btn-success"> 
		<i class="fa fa-plus ptr"></i>
		<span>Images</span>
	</a>
	
	{{ 
		Form::open(['action'=>'AJAXController@ajaxSwitch',
		'method'=>'post', 'files'=>true, 'id'=>'article_image_upload_form']) 
	}}
	
	{{ Form::file('article_images[]', ['id'=>'article_image_upload_input', 'multiple'=>'multiple', 'class'=>'hidden']); }}
	{{ Form::close(); }}
	
	<script>

	$(document).ready(function() {
			var button = $('#article_image_upload_button');
			var form = $('#article_image_upload_form');
			var input = $('#article_image_upload_input');
			var preview = $('#article_image_upload_preview');
			
			$(button).click(function(e){
				e.preventDefault();
				$('#article_images_upload_dropzone').toggle();
				input.trigger('click');	
		});
	});
	</script>
	

	
	<script>
		//script  to open file select dialog
		/*$(document).ready(function() {
			var button = '#article_images_upload_button';
			var form = '#article_images_upload_form';
			var file_select = '#article_images_upload_select';
			var dropzone = '#article_images_preview_section';
			//var submit_button = '#publish';
		
			$(dropzone).click(function(event) {
				event.preventDefault();	
				$(file_select).trigger('click');
			});
		});*/
		
				//$(submit_button).click(function(event) {
					/*var request_data = {};
					request_data['']
					request_data = event.target.files[0];
					console.log(request_data);*/
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
					});
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