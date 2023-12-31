@extends('templates.default')

@section('title')
@stop

@section('css')
@stop

@section('js')
@stop

@section('content')
	<div id="user_image_upload_button">
	<div id="user_image">
		User_Image
	</div>
	</div>
	<div id="user_image_upload_section">
		User image upload section
		 <!-- {{ Form::open(['action'=>'TestController@postTest3', 'method'=>'post', 'files'=>true, 'id'=>'user_image_upload_form']) }}-->
			{{ Form::file('userimage', array('id'=>'user_image_upload_select','class'=>'btin')) }}
		 <!--<input type="submit">-->
		 <!--{{ Form::close(); }}-->
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
				url : 'test3',
				dataType : 'json',
				paramName: 'userimage',
		        autoUpload : true,
		        formAcceptCharset: 'utf8',
		        singleFileUploads: true,
		        sequentialUploads: true,
		        maxNumberOfFiles : 8,
		        maxFileSize : 8000000,
		        minFileSize : undefined,
		        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
		        sequentialUploads: true,
		        previewMaxWidth: 100,
		        previewMaxHeight: 100,
		        previewCrop: true,
		        dropZone: $(dropzone),
		        
			}).bind('fileuploadadd', function (e, data) {
		        /*data.context = $('<i>').attr('class', 'fa fa-check')
		        	.appendTo('body')
		            .click(function () {
		                data.context = $('<p/>').text('Uploading...').replaceAll($(this));
		                data.submit();
		            });*/
			}).bind('fileuploadprocessalways', function(e,data){

			}).bind('fileuploadfail', function() {

			}).bind('fileuploaddone', function(e, data) {
				//data.context.text('Upload finished.');
				var response_data = data.result;
				if(response_data.success) {
				};
			});
		});
	</script>
@stop