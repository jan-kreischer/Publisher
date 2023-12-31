@if(!($errors->isEmpty()))
	<div class="alert alert-danger alert-block">
		<a class="close" data-dismiss="alert">
			×
		</a>
		<b class="alert-heading">
			Error!
		</b>
		@foreach ($errors->all() as $error) 
			<br/>{{$error}}
		@endforeach
	</div>
@endif
				
@if(Session::has('alert_error'))
	<div class="alert alert-danger alert-block">
		<a class="close" data-dismiss="alert">
			×
		</a>
		<b class="alert-heading">
			Error!
		</b>
		<br/>   	
		{{{ Session::get('alert_error') }}}
	</div>

@elseif(Session::has('alert_warning'))
	<div class="alert alert-warning alert-block">
		<a class="close" data-dismiss="alert">
			×
		</a>
		<b class="alert-heading">
			Warning!
		</b>
		<br/>   	
		{{{ Session::get('alert_warning') }}}
	</div>
				
@elseif(Session::has('alert_info'))
	<div class="alert alert-info alert-block">
		<a class="close" data-dismiss="alert">
			×
		</a>
		<b class="alert-heading">
			Info!
		</b>
		<br/>   	
		{{{ Session::get('alert_info') }}}
	</div>
	
@elseif(Session::has('alert_success'))
	<div class="alert alert-success alert-block">
		<a class="close" data-dismiss="alert">
			×
		</a>
		<b class="alert-heading">
			Success!
		</b>
		<br/>   	
		{{{ Session::get('alert_success') }}}
	</div>
@endif