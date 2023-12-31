<script src="/includes/js/progressbar.min.js"></script>
<script>
$(document).ready(function(){
	var options = {
		bg: 'orange',
		target: document.getElementById('progress_bar'),
		id: 'progress_bar'
	};

	var progress_bar = new Progressbar(options);

	$.ajaxSetup({
		/*url: 'ajax', 
		type: 'POST',*/
		success: function(response_data){console.log(response_data);},
		headers: {
        	'csrf_token': $('meta[name="csrf_token"]').attr('content')
  		}
    });
	$(document).ajaxStart(function(){
		progress_bar.go(0);
		progress_bar.go(38);
	});
	$(document).ajaxSend(function(){
		progress_bar.go(62);
	});
	$(document).ajaxComplete(function(event, jqXHR, PlainObjects){
		var response_data = $.parseJSON(jqXHR.responseText);
		if(response_data['success'] == true)
		{
			progress_bar.go(100);
		}

		else
		{
			progress_bar.go(0);
		}

		
		if(response_data['href']) {
			window.location.href = response_data['href'];
		}
	});
	
	$(document).ajaxError(function(){
		progress_bar.go(0);
	});
	
	$('main form:first *:input[type!=hidden]:first').focus();

	var selectors = ['.subscriber', 'subscriber-img'];

	$(window).resize(function() {
		square();
	});
	
	
	var square = function() 
	{
		$('.square').height($('.square').width());
	}

	square();

	
});
</script>

{{HTML::script(Config::get('c.js.path') . '/throttle_and_debounce.min.js', [], TRUE)}}
{{HTML::script(Config::get('c.js.path') . '/load.js', [], TRUE)}}

	<footer>
	</footer>
</body>
</html>