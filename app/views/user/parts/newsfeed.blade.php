<div id="newsfeed">
@foreach ($recent_articles as $recent_article)
	{{$recent_article->article_preview();}}
@endforeach
</div>
<script src="includes/js/delete.js"></script>