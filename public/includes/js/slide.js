function slide(position, speed) {
	position = position || 0;
	speed = speed || '400';
	
	if(parseFloat(position) == position) {
		$('html, body').animate({ scrollTop: position}, 'slow');
	}
	else {
		$('html, body').animate({ scrollTop: ($(position).offset().top)}, 'slow');
	}
}