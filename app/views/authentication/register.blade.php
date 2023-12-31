@extends('templates.default')

@section('content')

<div class="row-fluid">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 well">
		<legend>Please Register</legend>
		{{ Form::open(array('method'=>'post', 'class' => 'form-vertical', 'autocomplete'=>'off', 'role'=>'form')) }}
			@include('errors.flash')
		
			<div class="form-group">
				{{ Form::label('first_name', 'FirstName', array('class' => 'control-label')) }}
				{{ Form::text('first_name', null, array('class'=>'form-control', 'placeholder' => '', 'autofocus'=>'autofocus')); }}
			</div>
			
			<div class="form-group">
				{{ Form::label('last_name', 'LastName', array('class' => 'control-label')) }}
				{{ Form::text('last_name', null, array('class'=>'form-control', 'placeholder' => '')); }}
			</div>
			
			<div class="form-group">
				{{ Form::label('email_address', 'EmailAddress', array('class' => 'control-label')) }}
				{{ Form::text('email_address', null, array('id'=>'email_address','class'=>'form-control', 'placeholder' => '')); }}
			</div>
			
			<div class="form-group">
				{{ Form::label('password', 'Password', array('class' => 'control-label')) }}
				{{ Form::password('password', array('id'=>'password','class'=>'form-control', 'placeholder' => '')) }}
			</div>
			
			<div class="form-group">
				{{ Form::label('gender', 'Gender', array('class' => 'control-label')) }}
				<br>
				<label class="radio-inline"><input type="radio" name="gender" value="m" checked="checked">male</label>
				<label class="radio-inline"><input type="radio" name="gender" value="f">female</label>
			</div>
						
			<p>
				<small>
					By signing up you agree to our <a href="/policy">Terms 
					and Policy</a>
				</small>
			<p>
			
			<div class="form-group">
				{{ Form::submit('Sign-Up', array('class' => 'btn btn-prim')) }}
				{{ Form::reset('Sign-In', array('class' => 'btn btn-sec')) }}
			</div>
		{{ Form::close() }}
	</div>
</div>

@stop