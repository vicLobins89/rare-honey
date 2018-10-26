(function($) {
	
	function resizeArticle() {
		var elementWidth = $('.work-post, .news-post').width();
		var elementHeight = Math.round((elementWidth/16)*9);
		$('.work-post, .news-post').height(elementHeight);
	}
	
	var footerHeight = $('footer.footer').height();
	var processing;
	var totalPages = $('.page-numbers:not(ul, .next)').size();
	var page = 2;
	
	var postId = [];
	$('article').each(function(){
		var ids = $(this).data('id');
		postId.push(ids);
	});
	
	/*function find_page_number( element ) {
		element.remove();
		return parseInt( element.html() );
	}*/
	
	// SCROLL TO LOAD MORE
	$(window).on('scroll', function(){
		if (processing)
            return false;
		
		if ( $('body:not(.post-type-archive-work_post, .tax-work_cat)').is('.blog, .archive') && $(window).scrollTop() >= $(document).height() - $(window).height() - footerHeight ) {
			if ( page <= totalPages ) {
				processing = true;;

				$.ajax({
					url: ajaxpagination.ajaxurl,
					type: 'post',
					data: {
						action: 'ajax_pagination',
						query_vars: ajaxpagination.query_vars,
						page: page,
						id: JSON.stringify(postId)
					},
					beforeSend: function() {
						$(document).scrollTop();
						$('#main').append( '<div id="loader"><img src="/wp-content/themes/rare-honey/library/images/ring-alt.svg" /></div>' );
					},
					success: function( html ) {
						$('#main #loader').remove();
						$('#main').append( html );
						processing = false;
						resizeArticle();
					}
				});
				
				page ++;
			}
		}
	});
	
	
	// CLICK TO LOAD MORE
	/*$(document).on( 'click', 'a.page-numbers', function( event ) {
		event.preventDefault();
		
		page = find_page_number( $(this).clone() );

		$.ajax({
			url: ajaxpagination.ajaxurl,
			type: 'post',
			data: {
				action: 'ajax_pagination',
				query_vars: ajaxpagination.query_vars,
				page: page
			},
			beforeSend: function() {
				$('#main nav').remove();
				$(document).scrollTop();
				$('#main').append( '<div class="page-content" id="loader">Loading New Posts...</div>' );
			},
			success: function( html ) {
				$('#main #loader').remove();
				$('.other-stories').append( html );
			}
		})
	})*/
	
})(jQuery);