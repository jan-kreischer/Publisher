
<!-- {{ Form::open(['class'=>'dropzone', 'url'=>'articleimage','method'=>'POST', 'files'=>TRUE, 'id'=>'articleimage_upload_form']) }}
	<div class="fallback">
	  {{ Form::file('articleimage', ['id'=>'articleimage_upload_input']) }}
	</div>
{{ Form::close() }}-->


<div class="form-group dropzone-previews" id="articleimage_section">

</div>


<script>
$(document).ready(function() {
	var articleimage_ctr = 1;
	var options = {
		maxFiles: 8,
		url: 'articleimage',
		method: 'POST',
		maxFilesize: 2,
		clickable: true,
		uploadMultiple: false,
		previewsContainer: "#articleimage_section",
		headers: { 'csrf_token': $("meta[name='csrf_token']").attr("content") },
		paramName: 'articleimage',
		/*previewTemplate: '<p></p>',*/
		maxfilesexceeded: function(file)
		{
			alert('You already uploaded the maximum number of files per article!');
		},
		success: function (file, response_data) {
			console.log(response_data);
			console.log(file.accepted);
			console.log(response_data["articleimage_id"]);
			//console.log(response_data.articleimage_src);
			$('<input>').attr({'type':'hidden', 'name':'articleimage_id_' + articleimage_ctr, 'value': response_data["articleimage_id"]}).appendTo('#articleimage_section');
			articleimage_ctr++;
		},
		
		/*accept: function() {},*/
		/*init: function() {
			this.on('success', function(file, response_data) {
				console.log(response_data);
			});
		},*/
	};
	
	$('#articleimage_button').dropzone(options);
});
</script>