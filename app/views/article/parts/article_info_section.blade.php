<!-- Onclick element with id #show_info -->
<div id="article_info_section" class="col- well">
	<div id="tags_section">
		<b>
			Tags: 
		</b>
		@foreach($tags as $tag)
			{{$tag->output()}}
		@endforeach
	</div>
</div>

<script>
	/*$("#show_info").click(function(e){
		e.preventDefault();
	    $("#article_info_section").slideToggle();
	});*/
</script>