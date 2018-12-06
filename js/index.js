/*var zouzou = function(speed){
	$('.toggled').slideDown(speed, function(){
		$('.toggled').slideUp(speed, function(){
			zouzou(speed);
		});
	});
}*/

$('.toggler').click(function(){
	
	/*if(!$('.toggled').is(':visible')){
		$('.toggled').css('display', 'block');
	} else {
		$('.toggled').css('display', 'none');
	}*/
	
	/*if(!$('.toggled').is(':visible')){
		$('.toggled').show();
	} else {
		$('.toggled').hide();
	}*/
	
	//$('.toggled').toggle();
	
	$('.toggled').slideToggle();
	
	return false;
});


$('button.reset').click(function(){
	
	window.location.href = window.location.href;
	return false;
});

var disco = function(){
	var colors = ['#CC0000', '#CC00CC', '#00CCCC', '#0000CC', '#00CC00', '#CCCC00'];
	$('ul.breadcrumb li').each(function(){
		$(this).css('color', colors[ Math.floor(colors.length * Math.random()) ]);
	});
}

setInterval(disco, 1000);
