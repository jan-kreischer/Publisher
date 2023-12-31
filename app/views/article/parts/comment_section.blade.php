<div class="col- well" id="comment_section">
	{{ Form::open([
		    'url' => 'comment',
		    'method' => 'POST',
		    'id' => 'form_comment_article',
		    'autocomplete' => 'off',
	   ]); 
	}}
	<div class="input-group"> 
		{{ Form::text('comment_content', '', array('id'=>'comment_inp', 'class'=>'form-control ' . side(),'placeholder' => '', 'value'=>'', 'maxlength'=>Config::get('c.comment.comment_maxlength'))); }}	
		<span class="input-group-btn">
		{{ Form::submit( 'Comment', array('id'=> 'comment_btn', 'class' => 'btn btn-default ' . side(), 'name'=>'submited', 'value'=>'')); }}
		</span>
	</div>
	
	{{ Form::close(); }}
	
	@if(!empty($comments))
		@foreach($comments as $comment)
			<?php  $commenter = $comment->commenter; ?>
			<div class="comment">
			{{$commenter->userimage_output()}}
					
			<span class="comment-left">

				<span class="comment-commenter">
					{{$commenter->a()}}:
				</span>
				
				 
				<span class="comment-content">
					{{e($comment->comment)}}
				</span>
				
			</span>
				
				<span class="comment-right pull-right">
					
					<div class="comment-timestamp">
						<small>
							{{date("d. F Y · H:i",$comment->created_at->timestamp)}}
						</small>
					</div>
					
					<div class="comment-interaction pull-right">
						<i class="fa fa-chevron-up"></i>
						<i class="fa fa-chevron-down"></i>
						<i class="fa fa-reply"></i>
					</div>
				</span>
			</div>
		@endforeach				
	@endif

	<div id="comment_count" title="load more..." class="ptr">
		<i class="fa fa-comments"></i>
		<small>
			{{$article->comment_count()}} Comments
		</small>
	</div>
</div>