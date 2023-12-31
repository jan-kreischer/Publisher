@extends('templates.default')

@section('title')
@stop

@section('css')
	<link rel="stylesheet" href="includes/css/dropzone.css" media="all">
@stop

@section('js')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.js"></script>
@stop

@section('content')
	@include('user.parts.articleimage')
@stop