$(document).ready(function() {
    
    // AJAX TRAININGS
   
    var container_main = $('.main');
    
    $('.link-training').click(function(event) {
        event.preventDefault();
        
        var link_post = $(this).attr('href');
        
        ajax_training(link_post);
    }); // end click
    
    function ajax_training(link_post) {
        
        container_main.animate({
            'opacity': 0
        }, 300, post() );
        
        function post() {
            
            var data = {
                action: 'get_training',
                link: link_post 
            };
            
            $.post( myAjax.ajaxurl, data, function(response) {
                    container_main.html(response).animate({
                        'opacity': 1
                    }, 300);
                }
            ); // end $.post
        }
        
    } // end ajax_training
    
    // AJAX CARTOONS
    
    $('#load-cartoons').click(function(event) {
        event.preventDefault();
        
        var icon = $(this).find('.load__icon');
        
        icon.addClass('fa-spin');
        
        var data = {
			'action': 'load_cartoons',
			'query': true_posts,
			'page' : current_page
		};
        
        $.post( myAjax.ajaxurl, data, function(response) {
            
            if( response ) { 
				$('.load').before(response);
				current_page++;
				if (current_page == max_pages) $('.load').remove();
            } 
            else {
					$('.load').remove();
				}
            
            icon.removeClass('fa-spin');
        }); // end post
        
    });
    
    // AJAX PRESENTATION
    
    $('#load-presentations').click(function(event) {
        event.preventDefault();
        
        var icon = $(this).find('.load__icon');
        
        icon.addClass('fa-spin');
        
        var data = {
			'action': 'load-presentations',
			'query': true_posts,
			'page' : current_page
		};
        
        $.post( myAjax.ajaxurl, data, function(response) {
            
            if( response ) { 
				$('.load').before(response);
				current_page++;
				if (current_page == max_pages) $('.load').remove();
            } 
            else {
					$('.load').remove();
				}
            
            icon.removeClass('fa-spin');
        }); // end post
        
    });
    
});