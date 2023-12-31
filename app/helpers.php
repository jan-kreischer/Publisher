<?php 
//check if the view is from a foreign, logged in, or self user
//returns array $view
//that user id must be given to check wheater the site can be
//viewed private
function view_visibility ($that_user_id = NULL) {
	//default visiblity
	//all are false
	
	$view = [
		'is_public' => FALSE,
		'is_protected' => FALSE,
		'is_private' => FALSE,
		//----------
		'is_outsider' => FALSE,
		'is_insider' => FALSE,
	];
	
	//if user is not logged in bzw is a guest
	//the visiblity is the public one
	if(Auth::guest()) {
		$view['is_outsider'] = TRUE;
		$view['is_public'] = TRUE;
	}
	
	else if(Auth::check()) {
		$view['is_insider'] = TRUE;
		
		$this_user_id = Auth::user()->user_id;
		if(!empty($that_user_id) & $this_user_id == $that_user_id) {
			$view['is_private'] = TRUE;
		}
		else {
			$view['is_protected'] = TRUE;
		}
	}	
	return $view;
}

function side() {
	global $view;
	if ($view['is_public'] || $view['is_private']) {
		return 'insider';
	}
	else {
		return 'outsider';
	}
}

function parse_markup($subject) {
	//parse subject for patterns and substitute with the replacements
	$patterns = [
			'\[h\]', '\[/h\]',
			'\[b\]', '\[/b\]',
			'\[u\]', '\[/u\]',
			'\[i\]', '\[/i\]',
			'\[p\]', '\[/p\]',
			'\[br\]',
	];
	
	$replacements = [
			'<h4>', '</h4>',
			'<b>', '</b>',
			'<u>', '</u>',
			'<i>', '</i>',
			'<p>', '</p>',
			'<br/>', 
			
	];
	
	for($i = 0; $i < sizeof($patterns); $i++) {
		$subject = preg_replace('~' . $patterns[$i] . '~', $replacements[$i], $subject);
	}
	
	return $subject;
}