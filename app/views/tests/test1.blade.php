@extends('templates.default')

@section('title')
@stop

@section('css')
	
@stop

@section('js')
@stop

@section('content')

	<a href="#" id="article_images_upload_button" class="btn btn-success"> 
		<i class="fa fa-plus"></i>
		<span>Images</span>
	</a>

<!-- {{ Form::open(array('action'=>'ArticleController@ajaxPostArticleImages','method'=>'post', 'files'=>true, 'id'=>'article_images_upload_form')) }}-->

<div class="form-group">
  {{ Form::file('article_images[]', array('id'=>'article_images_upload_select','class'=>'', 'multiple'=>'multiple')) }}
</div>
   <!-- {{ Form::submit('Submit', array('id'=>'article_images_upload_submit','class'=>'btn btn-primary')) }}-->

<!-- {{ Form::close() }}-->
<div id="article_images_preview_section">

</div>

<div id="article_images_upload_dropzone" class="well">

</div>

<!-- 
	<!-- Setup for BASIC -->
	<script src="/includes/js/jquery.ui.widget.js"></script>
	<script src="http://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
	<script src="/includes/js/jquery.iframe-transport.js"></script>
	<script src="/includes/js/jquery.fileupload.js"></script>
	<!-- END Setup for BASIC -->
	<script>
	$(document).ready(function () {
		var button = '#article_images_upload_button';
		var select = '#article_images_upload_select';
		var preview = '#article_images_preview_section';
		var form = '#article_images_upload_form';
		var submit = '#article_images_upload_submit';
		var dropzone = '#article_images_upload_dropzone';

		$(button).click(function(event) {
			event.preventDefault();	
			$(select).trigger('click');
		});
		
		$('#article_images_upload_select').fileupload({
			type : 'POST',
			url : 'test1',
			dataType : 'json',
	        autoUpload : false,
	        maxNumberOfFiles : 8,
	        maxFileSize : 8000000,
	        minFileSize : undefined,
	        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
	        autoUpload: true,
	        sequentialUploads: true,
	        previewMaxWidth: 100,
	        previewMaxHeight: 100,
	        previewCrop: true,
	        dropZone: $(dropzone),
	        
		}).bind('fileuploadadd', function (e, data) {
			console.log(data);
	        data.context = $('<i>').attr('class', 'fa fa-check')
	        	.appendTo(preview)
	            .click(function () {
	                data.context = $('<p/>').text('Uploading...').replaceAll($(this));
	                data.submit();
	            });
		}).bind('fileuploadprocessalways', function(e,data){

		}).bind('fileuploadfail', function() {

		}).bind('fileuploaddone', function(e, data) {
			data.context.text('Upload finished.');
		});
	});
	</script>
@stop