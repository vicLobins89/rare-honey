/*
 * Scripts File
 * Author: Vic Lobins
 *
*/


/*
 * Get Viewport Dimensions
 * returns object with viewport dimensions to match css in width and height properties
 * ( source: http://andylangton.co.uk/blog/development/get-viewport-size-width-and-height-javascript )
*/
function updateViewportDimensions() {
	var w=window,d=document,e=d.documentElement,g=d.getElementsByTagName('body')[0],x=w.innerWidth||e.clientWidth||g.clientWidth,y=w.innerHeight||e.clientHeight||g.clientHeight;
	return { width:x,height:y };
}
// setting the viewport width
var viewport = updateViewportDimensions();


/*
 * Throttle Resize-triggered Events
 * Wrap your actions in this function to throttle the frequency of firing them off, for better performance, esp. on mobile.
 * ( source: http://stackoverflow.com/questions/2854407/javascript-jquery-window-resize-how-to-fire-after-the-resize-is-completed )
*/
var waitForFinalEvent = (function () {
	var timers = {};
	return function (callback, ms, uniqueId) {
		if (!uniqueId) { uniqueId = "Don't call this twice without a uniqueId"; }
		if (timers[uniqueId]) { clearTimeout (timers[uniqueId]); }
		timers[uniqueId] = setTimeout(callback, ms);
	};
})();

// how long to wait before deciding the resize has stopped, in ms. Around 50-100 should work ok.
var timeToWaitForLast = 100;


function loadGravatars() {
  // set the viewport using the function above
  viewport = updateViewportDimensions();
  // if the viewport is tablet or larger, we load in the gravatars
  if (viewport.width >= 768) {
  jQuery('.comment img[data-gravatar]').each(function(){
    jQuery(this).attr('src',jQuery(this).attr('data-gravatar'));
  });
	}
} // end function


// VIDEO CONTROLS
var myVideo = document.getElementById("home_video");
var closeButton = document.getElementById("close-btn");
function playVideo() {
	myVideo.style.display = "block";
	closeButton.style.display = "block";
	myVideo.currentTime = 0;
	myVideo.play();
}
function pauseVideo() {
	myVideo.pause();
	myVideo.style.display = "none";
	closeButton.style.display = "none";
}

function playVideoTwo() {
	var myVid = document.getElementById("play_vid");
	var playButton = document.getElementById("play_btn");
	myVid.play();
	playButton.style.display = 'none';
	myVid.setAttribute("controls","controls");
}

function playVideoThree() {
	var myVid = document.getElementById("play_vid_2");
	var playButton = document.getElementById("play_btn_2");
	myVid.play();
	playButton.style.display = 'none';
	myVid.setAttribute("controls","controls");
}


jQuery(document).ready(function($) {
	
	// FUNCTIONS
	
	// RGB to Hex
	function convertRGBtoHex(rgbValue) {
		var parts = rgbValue.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
		delete (parts[0]);
		for (var i = 1; i <= 3; ++i) {
			parts[i] = parseInt(parts[i]).toString(16);
			if (parts[i].length == 1) parts[i] = '0' + parts[i];
		}
		var hexString ='#'+parts.join('').toUpperCase();
		return hexString;
	}
	
	// Skew resize
	function resizeSkew() {
		var skewColumnEl = $('.skew-2col .wpb_column:first-child');
		var skewHeight = skewColumnEl.outerHeight();
		$('.skew').css({
			'border-top-width': skewHeight,
			'border-right-width': skewHeight/3
		});
	}
	
	// Work Categories
	function positionCatLine() {
		var catPosition = $('.cat-active').offset().left,
			catWidth = ($('.cat-active').outerWidth()/2),
			catPosWidth = ($('.cat-position').outerWidth()/2),
			containerFromLeft = $('.cat-nav').offset().left;
		
		$('.cat-position').css('left', ((catPosition-containerFromLeft)-catPosWidth+catWidth));
	}
	
	function resizeArticle() {
		var elementWidth = $('.news-post').width();
		var elementHeight = Math.round((elementWidth/16)*9);
		$('.news-post').height(elementHeight);
	}
	
	// Admin bar adjust
	function adminBarAdjust() {
		if( $('#wpadminbar').length ) {
			var adminBarHeight = $('#wpadminbar').outerHeight();
			$('.main-menu, .header').css('top', adminBarHeight);
		}
	}
	
	// Cycler
	function cyclerStag() {
		$.each( $('.cycler.staggered'), function(i, el){
			var $active = $(el).find('.active');
			var $next = ($active.next().length > 0) ? $active.next() : $(el).find('img:first');
			$next.css('z-index',2);
			$active.stop(true, true).delay(i * 350).fadeOut(500,function(){
				$active.css('z-index',1).show().removeClass('active');
				$next.css('z-index',3).addClass('active');
			});
		});
	}
	setInterval(cyclerStag, 3000);
	
	
	// Vid on scroll
	
	if( $('video.on-scroll').length ){
		$(window).scroll(function(){
			$('video.on-scroll').each(function(i, el){
				var video = $(el).get(0);
				var elHeight = $(el).outerHeight();
				var elTop = $(el).offset().top;
				function playVid() {
					$(el).parent().find('.controls').show();
					if( $(el).hasClass('ended') ) {
						video.pause();
					} else {
						video.play();
					}
					if( $(el).hasClass('play-once') ) {
						$(el).on('ended', function(){
							$(el).addClass('ended');
						});
					}
				}

				if( $(document).scrollTop() + (viewport.height/2) >= elTop + (elHeight/3) && $(document).scrollTop() <= ( elTop + (elHeight-200) ) ) {
					playVid();
				} else if( $(document).scrollTop() + viewport.height >= elTop + elHeight && $(document).scrollTop() + viewport.height === $(document).height() ) {
					playVid();
				} else {
					$(el).parent().find('.play_btn').addClass('is-paused');
					$(el).parent().find('.play_btn').removeClass('is-playing');
					video.pause();
				}

				$(el).on('timeupdate', function() {
					var currentPos = video.currentTime;
					var maxduration = video.duration;
					var percentage = 100 * currentPos / maxduration;
					$(this).next('.timeBar').css('width', 'calc(' + percentage + '% - 30px)');
				});
			});
		});
	}

	$('.play_btn').on('click', function(){
		var video = $('#' + $(this).data('video-id')).get(0);
		$(this).find('.btn-inner').hide();
		$(this).find('.controls').show();
		if(video.paused) {
			$(this).addClass('is-playing');
			$(this).removeClass('is-paused');
			video.play();
		} else {
			$(this).addClass('is-paused');
			$(this).removeClass('is-playing');
			video.pause();
		}

		$('#' + $(this).data('video-id')).on('timeupdate', function() {
			var currentPos = video.currentTime;
			var maxduration = video.duration;
			var percentage = 100 * currentPos / maxduration;
			$(this).next('.timeBar').css('width', 'calc(' + percentage + '% - 30px)');
		});

		return false;
	});
	
	
	// MAIN SCRIPTS
	
	$('.faded-bg').append('<div class="overlay"></div>');
	
	// Nav
	$('.nav > li.menu-item-has-children').prepend('<div class="plus"></div>');
	$('.menu-button').on('click', function(){
		$(this).toggleClass('menu-active');
		$(this).next('.nav').toggleClass('menu-active');
		$(this).find('i').toggleClass('fa-bars fa-times');
		$('#container, .header, .main-menu, body').toggleClass('menu-active');
	});
	$('.menu-item .plus').click(function(){
		$('.sub-menu:not(.submenu-active)').removeClass('submenu-active');
		$(this).toggleClass('submenu-active');
		$(this).siblings('.sub-menu').toggleClass('submenu-active');
	});
	adminBarAdjust();
	
	// Work Categories
	$('.work-cat-button').on('click', function(e){
		e.preventDefault();
		$('.work-cat-button').removeClass('cat-active');
		$(this).toggleClass('cat-active');
		
		$('.load-more').hide();
		
		$('.work-post, .client-logo').addClass('hide');
		var category = $(this).data('cat');
		if( category !== 'all' ) {
			$('.work-desc').removeClass('active');
			$('.work-desc.'+category).addClass('active');
			
			setTimeout(function(){
				$('.work-post, .client-logo').addClass('hidden');
				$('.' + category).removeClass('hidden');
				setTimeout(function(){
					$('.' + category).removeClass('hide');
				}, 50);
			}, 600);
		} else {
			$('.work-desc').removeClass('active');
			
			setTimeout(function(){
				$('.work-post, .client-logo').removeClass('hidden');
				setTimeout(function(){
					$('.work-post, .client-logo').removeClass('hide');
				}, 50);
			}, 600);
		}
		
		if( viewport.width < 768 ) {
			if( $('#wpadminbar').length ) {
				var adminBarHeight = $('#wpadminbar').outerHeight();
				$('html, body').animate({scrollTop: $('.cat-nav').offset().top-adminBarHeight-70}, 500);
			} else {
				$('html, body').animate({scrollTop: $('.cat-nav').offset().top-70}, 500);
			}
		}
		
		if( $('.cat-position').length ) {
			positionCatLine();
		}
	});
	
	if( $('.cat-position').length ) { 
		positionCatLine();
	}
//	resizeArticle();
	
	var $workThumb = $('article.work-post'),
		thumbLength = 9;
	
	if( $workThumb.length ) {
		 $workThumb.each(function(i, el){
			if( $workThumb.length >= thumbLength-1 ) {
				$workThumb.slice(9).addClass('hide hidden');
			}
		});
		
		var clicks = 0;
		$('button.load-more').on('click', function(){
			clicks ++;
			
			$workThumb.each(function(i, el){
				setTimeout(function(){
					$workThumb.slice(thumbLength*clicks, thumbLength*(clicks+1)).removeClass('hidden');
					setTimeout(function(){
						$workThumb.slice(thumbLength*clicks, thumbLength*(clicks+1)).removeClass('hide');
					}, 50);
				}, 200);
			});
			
			if( $workThumb.length <= thumbLength*(clicks+1) ) {
				$(this).hide();
			}
		});
	}
	
	
	// Skew columns
	var skewColumnEl = $('.skew-2col .wpb_column:first-child');
	skewColumnEl.append('<div class="skew"></div>');
	var skewBG = skewColumnEl.next().find('.vc_column-inner').css('background-color');
	if( $('.skew').length ) {
		$('.skew').css('border-right-color', convertRGBtoHex(skewBG));
	}
	resizeSkew();
	
	
	// Page referer
	var httpReferer = $('input[name="_wp_http_referer"]').val();
	$('#_wp_http_referer-6828').val('honey.co.uk'+httpReferer).parents('.um-field-_wp_http_referer').css({
		'maxHeight': 0,
		'overflow': 'hidden',
		'visibility': 'hidden',
		'opacity': 0
	});
	
	$(window).on('load resize', function(){
		var imgHeight = $('.vert-align-img img').height();
		$('.vert-align').innerHeight(imgHeight);
		
		var clientLogoWidth = $('.client-logo').outerWidth();
		var calculateHeight = (clientLogoWidth / 125) * 81;
		$('.client-logo').css('max-height', calculateHeight);
		
		var profileWidth = $('#team .vc_row').outerWidth();
		var calculateProfileHeight = (profileWidth / 222) * 139;
		$('#team .vc_row').css('max-height', calculateProfileHeight);
		
		if( $('body').is('.boxed-layout') ) {
			var containerFromLeft = $('#container').offset().left;
			$('nav.main-menu').css('left', containerFromLeft);
		}
	});
	
	// RESIZE SCRIPTS
	
	$(window).resize(function(){
		viewport = updateViewportDimensions();
		
		// nav
		adminBarAdjust();
		
		// work cat
		if( $('.cat-position').length ) { 
			positionCatLine();
		}
//		resizeArticle();
		
		// skew
		resizeSkew();
	});

}); /* end of as page load scripts */
