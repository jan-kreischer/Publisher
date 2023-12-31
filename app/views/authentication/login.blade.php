@extends('templates.default')

@section('content')	
	<div class="row-fluid">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 well">
			<legend>Please Login</legend>
			{{ Form::open(array('method'=>'post','class' => 'form-vertical', 'autocomplete'=>'off', 'role'=>'form')) }}
				@include('errors.flash')
				
				<div class="form-group">
					{{ Form::label('email_address', 'Email Address', array('class' => 'control-label')) }}
					{{ Form::text('email_address', '', array('id'=>'email_address', 'class'=>'form-control', 'placeholder' => '', 'autofocus'=>'on')); }}
				</div>
				
				<div class="form-group">
					{{ Form::label('password', 'Password', array('class' => 'control-label')) }}
					{{ Form::password('password', array('class'=>'form-control', 'placeholder' => '')) }}
				</div>
				<div class="form-group">
					{{ Form::checkbox('remember_me', 1, TRUE, ['class' => 'field']) }}	
					Remember Me?	
				</div>
				
				<div class="form-group">
					{{ Form::submit('Sign-In', array('class' => 'btn btn-prim')) }}
					{{ HTML::link('/register', 'Sign-Up', array('class' => 'btn btn-sec')) }}
				</div>
			{{ Form::close() }}
		</div><!-- END .col -->
	</div><!-- END .row -->
@stop