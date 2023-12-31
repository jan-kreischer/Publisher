<?php
return [
	//all paths are relative to document root
	'userimages' => '/uploads/userimages',
	'articleimages' => '/uploads/articleimages',
	/*'js' => '/includes/js',*/
	'css' => '/includes/css',
	'css_path' => '/includes/css',
	'max_articleimages' => 8,
	
	'js' => [
		'path' => '/includes/js',
	],
		
	'cssj' => [
		'path' => '/includes/css',
	],
		
	'user' => [
		'user_id' => [
			'rules' => 'numeric',
		],
		'email_address' => 	[
			'rules' => 'required|email|min:8|max:32|unique:users,email_address',
		],
	],
		
	'tag' => [
			'tag_template' => "<span class=\"tag\"><a href=\"%s\" class=\"tag-link\"><span class=\"tag-content\">#%s</span></a>,&nbsp;</span>",
			'tag_count' => 8,
			'minlength' => '1',
			'maxlength' => '255',
			'tag_content' => [
				'rules' => 'required|min:1|max:255',	
			],
	],
	
	'userimage' => [
		'path' => '/uploads/userimages',
	],
	
	'articleimage' => [
		'path' => '/uploads/articleimages',
	],
		
	'comment' => [
		'maxlength' => '255',
		'minlength' => '1',
		'comment_template' => 'Jan Bauer'
	],
		
	'article' => [
		'republishing_template' => "<span class=\"republishing-section\" title=\"republish\">
								<i class=\"fa fa-retweet %s\"></i>
								<span>
								%u
								</span>
							</span>",
			
		'comment_template' => "%s<span class=\"comment-section\" title=\"comment\">
								<i class=\"fa fa-comments %s\"></i>
								<span>
								%u
								</span>
							</span></a>",
			
		'view_template' =>	"%s<span class=\"view-section\" title=\"view\">
								<i class=\"fa fa-eye %s\"></i>
								<span>
								%u
								</span>
							</span></a>",

			//<i class=\"fa fa-cog ptr\"></i>
		
		'article_preview' => [
			'template' => "
			<div class=\"col- well\">
				%s
				<div class=\"article-teaser\">
					<div class=\"above\">
						&nbsp;
						<div class=\"pull-left\">by&nbsp;
							%s
						</div>
								
						<div class=\"pull-right\"> 
							%s
						</div>
					</div>
				
					<div class=\"article-preview\">" . 
						"<div class=\"article-title\">
							<h3>
								%s 
							</h3>
						</div>
						<div class=\"article-content\">
							%s
						</div>
					</div>
				
					<div class=\"below\">
						<div class=\"article-interaction\">
							&nbsp;
							<div class=\"pull-left\">
								%s 
							</div>
							<div class=\"pull-right\"> 
								%s
								&nbsp;&middot;&nbsp;
								%s
								&nbsp;&middot;&nbsp;
								%s
							</div>
						</div>
					</div>
				</div>
			</div>",	
		],
		
		'article_options' => [
			'template' => 
				"<div class=\"dropdown\">
  							<span class=\"dropdown-toggle\"  data-toggle=\"dropdown\">
								<i class=\"fa fa-cog ptr\"></i>
							</span>
							<ul class=\"dropdown-menu pull-right\">
								<li><a class=\"article-hide\"href=\"#\">hide</a></li>
								<li><a class=\"article-edit\" href=\"#\">edit</a></li>
								<li><a class=\"article-delete\" href=\"#\">delete</a></li>
							</ul>
						</div>",
		],
							
		'article_interaction' => [
			'template' => 
				"<span class=\"article-interaction\">
					<span class=\"article_up_count\"><i class=\"fa fa-chevron-up\"></i>&nbsp;%u</span>
					&nbsp;&middot;&nbsp;
					<span class=\"article_down_count\"><i class=\"fa fa-chevron-down\"></i>&nbsp;%u</span>
					&nbsp;&middot;&nbsp;
					<span class=\"article_comment_count\"><i class=\"fa fa-comment\"></i>&nbsp;%u</span>
					&nbsp;&middot;&nbsp;
					<span class=\"article_view_count\"><i class=\"fa fa-eye\"></i>&nbsp;%u</span>
				</span>",
		],
			
		'article_rating' => [
			'template' =>	
				"<span class=\"article-rating rating-section\">
					%s
					<span class=\"rating-button up ptr\" title=\"rate article up\" data-rating=\"up\" data-rating-type=\"article\">
						<i class=\"fa fa-chevron-up %s\"></i>
						<span>
							%u
						</span>
					</span>
					&nbsp;&middot;&nbsp;
					<span class=\"rating-button down ptr\" title=\"rate article down\" data-rating=\"down\" data-rating-type=\"article\">
						<i class=\"fa fa-chevron-down %s\"></i>
						<span>
							%u
						</span>
					</span>
				</span>",
		],
			
		'article_id' => [
			'rules' => '',
			'length' => '',
			'template' => '<input class="article-id" type="hidden" value="%u"/>',
		],
		'article_str' => [
			'length' => '16',
			'template' => '<input type="hidden" id="article_str" name="article_str" value="%s"/>',
		],
		
		'article_timestamp' => [
			'template' => '<input type="hidden" id="article_timestamp" name="article_timestamp" value="%u"/>',
		],
			
		'article_content' => [
			'minlength' => 1,
			'maxlength' => 65535,
			'rules' => 'required|min:1|max:65535',
		],
			
		'article_title' => [
			'minlength' => 1,
			'maxlength' => 255,
			'rules' => 'required|min:1|max:255',
		],
	],
		
	'category' => [
		'category_template' => "<span class=\"category\"><a href=\"%s\" class=\"category-link\"><span class=\"category-name\">%s</span></a>&nbsp;</span>",	
	],
		
	'paths' => [
		'img' => '/includes/img'	
	],
		
	'rating' => [
		'rating_template'	=> '',
		'rating_value' => [
			'rules' => '',	
		],
		
		'rating_type' => [
				
		],
	],
	'subscription' => [
			'subscription_url' => '/subscribe',
	],
];