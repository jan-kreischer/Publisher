<div id="user" class="user">	
	<div>
		@if(!empty($subscriber_count))
			<div id="subscribe_section" class="btn-group pull-right">
				<button class="btn btn-default" disabled="disabled">
					Subscribers
				</button>
				<button class="btn btn-prim" id="subscriber_count" disabled="disabled">
					{{$subscriber_count}}
				</button>
				
			</div>
		@endif
	</div>	
	<div id="userimage_section" class="userimage-section">
		<img src="{{$userimage_path}}" id="userimage" class="userimage">
		<span class="username-section" id="username_section">
			<h3 id="username" class="username">
				{{$that_user->name()}}
			</h3>	
			<span class="glyphicon glyphicon-camera pull-right"></span>
		</span>
	</div>
	 
	{{ Form::file('userimage', array('id'=>'user_image_upload_select','class'=>'btin')) }}
</div>

	<!-- Setup for BASIC -->
	<script src="/includes/js/jquery.ui.widget.js"></script>
	<script src="http://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
	<script src="/includes/js/jquery.iframe-transport.js"></script>
	<script src="/includes/js/jquery.fileupload.js"></script>
	<!-- END Setup for BASIC -->
	
	<script>
	
		$(document).ready(function() {
			var button = $('#user_image_upload_button');
			var select = $('#user_image_upload_select');
			var dropzone = $('#user_image');
			button.click(function(event) {
				event.preventDefault();	
				select.trigger('click');
			});
			

			select.fileupload({
				type : 'POST',
				url : 'userimage',
				dataType : 'json',
				paramName: 'userimage',
		        autoUpload : true,
		        formAcceptCharset: 'utf8',
		        sequentialUploads: true,
		        maxNumberOfFiles : 8,
		        maxFileSize : 2000000,
		        minFileSize : undefined,
		        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
		        previewCrop: true,
		        dropZone: $(dropzone),
		        
			}).bind('fileuploadadd', function (e, data) {

			}).bind('fileuploadprocessalways', function(e,data){

			}).bind('fileuploadfail', function(e, data) {

			}).bind('fileuploaddone', function(e, data) {
				var response_data = data.result;
				if(response_data.success) {
					$('#userimage').attr({src: response_data.userimage});
				};
			});
		});
	</script>