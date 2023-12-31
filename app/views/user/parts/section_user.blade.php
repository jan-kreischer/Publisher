<div id="user_personal_info_section">	
	<div>
		@include('templates.parts.subscribe_button')
		<i class="fa fa-cog pull-right" style="display: inline;"></i>
		<h3 id="username">
			{{$that_user->a();}}
		</h3>	
	</div>
	
	<span class="glyphicons glyphicons-camera"></span>
		
	<div id="user_image_section">
		<!-- <a href="#" class="thumbnail">-->
			<img src="{{$that_user->userimage_src();}}" id="userimage">
		<!--</a>-->	
	</div>
	 
	{{ Form::file('userimage', array('id'=>'user_image_upload_select','class'=>'btin')) }}
</div>

	<!-- Setup for BASIC -->
	<!-- <script src="/includes/js/jquery.ui.widget.js"></script>
	<script src="http://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
	<script src="/includes/js/jquery.iframe-transport.js"></script>
	<script src="/includes/js/jquery.fileupload.js"></script>-->
	<!-- END Setup for BASIC -->
	
	<script>
	
		/*$(document).ready(function() {
			var button = $('#userimage_button');
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
		});*/
	</script>
	
<script>
	$(document).ready(function() {
		var userimage_ctr = 1;
		var options = {
			maxFiles: 2,
			url: 'userimage',
			method: 'POST',
			maxFilesize: 2,
			clickable: true,
			uploadMultiple: false,
			previewsContainer: "",
			headers: { 'csrf_token': $("meta[name='csrf_token']").attr("content") },
			paramName: 'userimage',
			maxfilesexceeded: function(file)
			{
			},
			
			success: function (file, response_data) 
			{
			},
		};
		
		$('#user_image_section').dropzone(options);
	});
</script>