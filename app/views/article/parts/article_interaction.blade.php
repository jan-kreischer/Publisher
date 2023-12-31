<div class="article-interaction below">
		<span class="pull-left">
			{{$article->article_rating()}}
		</span>
		&nbsp;&nbsp;&middot;&nbsp;
		<span data-toggle="modal" data-target="#tag_modal" title="tag article">
			<i class="fa fa-plus ptr icon {{side()}}" id="tag"></i>
			<span>
				Tag
			</span>
		</span>
			
		<span class="pull-right"/ title="article views">
			{{$article->article_views()}}
		</span>
</div>

	<div id="tag_modal" class="modal fade" role="dialog">
		<div class="modal-dialog">
	
	    <div class="modal-content">
	      {{ Form::open(['method'=>'POST', 'id'=>'tag_form', 'url'=>'tag', 'class' => 'form-vertical', 'autocomplete'=>'off']) }}
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Tag</h4>
	      </div>
	      
	      <div class="modal-body">
	      	<div class="input-group"> 
		      	{{ Form::text('tag_content', '', ['id'=>'tag_content', 'class'=>'form-control']); }}
		      	<input type="hidden" name="article_id" value="{{$article->article_id}}"/>
				<input type="hidden" name="article_str" value="{{$article->article_str}}"/>
		      	<span class="input-group-btn">
		      		{{ Form::submit('submit', ['class' => 'btn btn-default', 'id'=>'tag_button', 'data-dismiss'=>'modal']) }}
		      	</span>
	      	</div>
	      </div>
	      	
	      <div class="modal-footer">
	      </div>
	    </div>
	    {{ Form::close() }}
	
		</div>
	</div>

	{{HTML::script(Config::get('c.js.path').'/tag.js', [], TRUE)}}
