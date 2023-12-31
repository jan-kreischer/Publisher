<div class="col- well">
	<div id="article_editor">
	@include('errors.flash')
	{{ 
		Form::open([
		    'url' => 'article',
		    'id' => 'article_form',
		    'accept-charset' => 'UTF-8',
		    'name' => 'article',
		    'autocomplete' => 'off',
		]);
	}}

	<div class="form-group"> 
		{{
			Form::text('article_title', '', [
				'maxlength'=> Config::get('c.article.article_title.maxlength'),
				'id'=>'article_title',
				'class'=>'form-control input-lg',
				'placeholder' => '',
				'title'=>'Article Title',
				'value'=>'',
				'required'=>'required',
				'autocomplete'=>'off',
			 ]);
		}}
	</div>
	
	@include('user.parts.articleimage')
	
	<div class="form-group">
		{{
			Form::textarea('article_content', '', [
			'maxlength'=> Config::get('c.article.article_content.maxlength'),
			'id'=>'article_content',
			'class' => 'form-control',
			'placeholder'=>'',
			'title'=>'Article Content',
			'value'=>'',
			'data-autoresize',
			'required'=>'required',
			'autocomplete'=> 'off',
			'autocorrect'=> 'off',
			'autocapitalize'=> 'off',
			'spellcheck'=> 'false',
			]);
		 }}
	</div>
	
	<script>
		$.each(jQuery('textarea[data-autoresize]'), function() {
		    var offsetY = this.offsetHeight - this.clientHeight;
		 	
		    var resizeTextarea = function(el) {
			    var posY = $('body').scrollTop();
		        $(el).css('height', 'auto').css('height', el.scrollHeight + offsetY);
		        window.scroll(0, posY);
		    };
		    $(this).on('keyup input', function() { resizeTextarea(this); }).removeAttr('data-autoresize');
		});

		function scrollto(element)
		{ 
			$('html, body').animate({ scrollTop: ($(element).offset().top)}, 'slow'); 
		};	
	</script>
			
	<div class="form-group">
		<div id="article_info">
		</div>
	</div>
		
	<div class="form-group">
		<span>
			{{ Form::submit( 'Publish&nbsp;', ['class' => 'btn btn-prim', 'name'=>'publish', 'id'=>'publish']); }}
			<a href="#" id="articleimage_button" class="btn btn-sec"><span class="glyphicon glyphicon-camera"></span> Image</a>
		</span>

	    <span class="pull-right">
		    <select class="bootstrap-select show-menu-arrow" id="article_visibility" name="article_visibility" data-show-icon="true" title="Visiblity" data-header="Visibility" data-width="auto">
				    	<option value="public" data-icon="fa fa-globe" selected="selected">&nbsp;public</option>
				    	<option value="protected" data-icon="fa fa-shield">&nbsp;protected</option>
				    	<option value="private" data-icon="fa fa-lock" ">&nbsp;private</option>
		    </select> 	
		    
			<?php
		    $categories = Category::lists('category_name', 'category_id');
		    ?>
		    
			{{ 
			Form::select('category_id', $categories, 0,	
				[
				'class' => 'bootstrap-select show-menu-arrow',
				'id' => 'category',
				'data-width' => 'auto',
				'data-header'=> 'Category',
				]							
				);	
			}}
			
			<script>
		    $(document).ready(function(){
			    $('.bootstrap-select').selectpicker();
			});
			</script>
			
		</span>
	   	</div>
		
	{{ 
		Form::close(); 
	}}
	</div>
</div>