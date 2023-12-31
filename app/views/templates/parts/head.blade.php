<!DOCTYPE HTML>
<html lang="en">
	<head>
		<title>
			Publisr | @yield('title')
		</title>
		
		<link rel="shortcut icon" href="/includes/img/megaphone.svg" type="svg"/>
		<link rel="icon" href="/includes/img/megaphone.svg" type="svg"/>
		<!-- <link rel="shortcut icon" href="/includes/img/favicon.png" type="image/png"/>-->
		<!-- <link rel="icon" href="/includes/img/favicon.png" type="image/png"/>-->
		
		<!-- 40 c length -->
		<meta name="csrf_token" id="csrf_token" content="{{ csrf_token() }}">
		<meta charset="UTF-8"/>
		<meta name="robots" content="index,follow">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=0">
		<meta name="">
		
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		@yield('css')
		{{ HTML::style('includes/css/all.css'); }}
		
		<!-- ------------ -->
		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script>
			//jQuery-Fallback
			window.jQuery || document.write('<script src="//publisr.com/includes/js/jquery-1.11.2.min.js"><\/script>');
		</script>
		<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/9.5.2/jquery.fileupload.min.js"></script>-->
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
		@yield ('js')
	</head>
</head>
<body>