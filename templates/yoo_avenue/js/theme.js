/* Copyright (C) YOOtheme GmbH, YOOtheme Proprietary Use License (http://www.yootheme.com/license) */

jQuery(function($) {

	var config = $('html').data('config') || {};

	// Social buttons
	$('article[data-permalink]').socialButtons(config);

	// Rotate banner
	
	$('.wk-gallery-avenue .caption').bind("DOMSubtreeModified",function(){
		$('.wk-gallery-avenue .caption').removeClass('rotate-slide');
		setTimeout(function(){$('.wk-gallery-avenue .caption').addClass('rotate-slide');}, 800);
		$('.wk-gallery-avenue .caption a.cta_but').click(function(){
			$(".header-container .c_back_but").click();
		});
	});

	/* mobile menu */
	$('#cssmenu > ul').prepend('<li class=\"mobile\"><a href=\"#\"><span class="w-icon-nav-menu"><i></i></span></a></li>');
	$('#cssmenu > ul > li > a').on("click touch", function(e) {
		console.log('touch');
  		$('#cssmenu li').removeClass('active uk-open');
  		$(this).closest('li').addClass('active uk-open');	
  		var checkElement = $(this).next();
  		if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
    		$(this).closest('li').removeClass('active uk-open');
    		checkElement.slideUp('normal');
  		}
  		if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
    		$('#cssmenu ul ul:visible').slideUp('normal');
    		checkElement.slideDown('normal');
  		}
  		if( $(this).parent().hasClass('mobile') ) {
    		e.preventDefault();
    		$('#cssmenu').toggleClass('expand');
  		}
  		if($(this).closest('li').find('ul').children().length == 0) {
    		return true;
  		} else {
    		return false;	
  		}		
	});

});