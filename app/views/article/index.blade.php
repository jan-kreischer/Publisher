@extends('templates.default')

@section('title')
	{{'Article - ' . $article->article_title}}
@stop

@section('css')

@stop

@section('js')

@stop

@section('content')
	<input type="hidden" id="article_id" name="article_id" value="{{$article->article_id}}"/>
	<input type="hidden" id="article_str" name="article_str" value="{{$article->article_str}}"/>
	<main class="row" id="{{$article->article_str}}">
		<article>
		<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-box">
			<div class="col- well">
				<div class="above">&nbsp;
				{{$article->hidden_article_id()}}
					<div class="pull-left">
						{{$article->category->output()}}
					</div>
					<div class="pull-right">
						{{date('d.m.Y',(strtotime($article->created_at)))}}
					</div>
				</div>
				<div id="article">
					<h2 id="article_title">{{$article->article_title}}</h2>
					@include('article.parts.article_images_slider_section')
					<p id="article_content">{{$article->article_content()}}</p> 
				</div>
				@include('article.parts.article_interaction')
			</div>
			
			@include('article.parts.article_info_section')

			@include('article.parts.comment_section')
		</div>
		
		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-box">
			<div class="col- well">
				@include('article.parts.that_user')
			</div>
			
			<div class="col- well" id="recent_articles">
				<h4>Recent Articles</h4>
				<!-- @include('user.parts.section_recent_articles') -->	
			</div>
			
			<div class="col- well">
				@include('article.parts.related_articles')
			</div>
			
			
		</div>
		
		</article>
	</main><!-- END .row -->
	
	{{HTML::script(Config::get('c.js.path') . '/rate.js', [], TRUE);}}
@stop