@if($view['is_public'])
	<div id="subscribe_section" class="btn-group pull-right">

		<button class="btn btn-default" title="subscribe to that user">
			Subscribe
		</button>
		<button class="btn btn-prim" class="subscriber-count" disabled="disabled">
			{{$that_user->subscribers_count()}}
		</button>
	</div>
@endif

@if($view['is_protected'])
	
	{{ Form::open(['url' => 'subscribe', 'method' => 'POST',
	'id' => 'subscribe_form',]); }}
	
	{{$that_user->hidden_user_id()}}
	
	<div id="subscribe_section" class="btn-group pull-right">
		{{ Form::submit('subscribe', ['class' => 'btn btn-default', 'id'=>'subscribe_button', 'title' => 'subscribe to that user']); }}
		
		<button class="btn btn-prim subscriber-count" disabled="disabled">
			{{ $that_user->subscribers_count(); }}
		</button>
	</div>
	{{ Form::close(); }}

	<script>
	$(document).ready(function($){
		var form = $('#subscribe_form');
		var button = $('#subscribe_button');
		
	    form.on('submit', function(e){ 
			e.preventDefault();	
			var url = form.attr('action');
			var request_data = {};
			var dataType = 'json';
			
			form.find(':input').each(function(){
				var name = $(this).prop('name');
				var value = $(this).val();
				if(name && value) {
			    	request_data[name] = value;
				}
			});
			console.log(request_data);
			
			$.post(url, request_data, function(response_data, textStatus, jqXHR) {
				console.log(response_data);
				if(textStatus === 'success'){
					if(response_data['action'] == 'subscribed') {
						button.val('subscribed');
					}
					if(response_data['action'] == 'unsubscribed') {
						button.val('subscribe');
					}
					$('.subscriber-count').text(response_data['subscriber_count']);
				}
				else {
					console.log('REQUEST_DATA:' + request_data);
					console.log('RESPONSE_DATA:' + response_data);
				}
			}, dataType);
	    });
	});
	</script>	
@endif

@if($view['is_private'])
	<div id="subscribe_section" class="btn-group pull-right">
		<button class="btn btn-default" disabled="disabled">
			Subscribers
		</button>
		<button class="btn btn-prim" class="subscriber-count" disabled="disabled">
			{{$that_user->subscribers_count()}}
		</button>
	</div>
@endif

