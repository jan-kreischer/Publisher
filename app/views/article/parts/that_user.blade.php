<div id="that_user_section">	
	<div>
	@include('templates.parts.subscribe_button')
	<a href='{{URL::to("user/$that_user->user_id")}}'>
	<h4 id="username">
		{{$that_user->first_name . ' ' . $that_user->last_name }}
	</h4>
	</a>	
	</div>
			
	<div id="user_image_section">
		<i class="fa fa-plus fa-2x" id="user_image_upload_button"></i>
		<img src="{{$that_user->userimage_src();}}" id="userimage">
		{{$that_user->userimage_output();}}
	</div>
</div>