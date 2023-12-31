@extends('templates.default')

@section('title')
@stop

@section('css')
@stop

@section('js')
@stop

@section('content')
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 well">
			<h2>Contact</h2>
			<p>Suggest, Ask, Hint or Tip, to improve (y)our Service</p>
			
			{{ Form::open(['url'=>'contact', 'class' => 'form-vertical', 'autocomplete'=>'off']) }}
			
			<div class="form-group"> 
				{{ Form::text('contact_email', '', array('id'=>'contact_email', 'class'=>'form-control','placeholder' => 'Your Email', 'title'=>'Your Email', 'value'=>'')); }}
			</div>
			
			<div class="form-group">
				{{Form::textarea('article_content', '', 
				['id'=>'contact_content', 'class' => 'form-control', 'placeholder'=>'', 'title'=>'Your Message', 'value'=>'']); }}
			</div>
			
			<div class="form-group">
				{{ Form::submit('Contact', array('class' => 'btn btn-prim')) }}
			</div>
			
			{{ Form::close() }}
		</div>
	</div>
@stop