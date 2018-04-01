$(document).ready(function() {
    
    // AJAX PAGES
    
    var page_container = $('main');
    
    $('.navigation__link').click( function(event) {
        event.preventDefault();
        
        var link_page = $(this).attr('href');
        var title_cat = $(this).text();
        
        document.title = title_cat;
        history.pushState({page_title: title_cat}, title_cat, link_page);
        
        ajax_page(link_page);
    } );
    
    window.addEventListener('popstate', function(event) {
       document.title = event.state.page_title;
        ajax_page(location.href);
    }, false);
    
    function ajax_page(link_page) {
        
        page_container.animate({
            'opacity': 0
        }, 300, page() );
        
        function page() {
            
            var data = {
                action: 'get_page',
                link: link_page 
            };
            
            $.post( myAjax.ajaxurl, data, function(response) {
                    page_container.html(response).animate({
                        'opacity': 1
                    }, 300);
                }
            ); // end $.post
        }
    }
    
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
    
    // AJAX SINGLE
    
    var single_container = $('main');
    
    $('.arrow').click( function(event) {
        event.preventDefault();
        
        var link_post = $(this).attr('href');
        var title_post;
        
        if( $(this).attr('id') == 'next_post' ) {
            title_post = title_next_post;
        }
        if( $(this).attr('id') == 'previous_post' ) {
            title_post = title_previous_post;
        }
        
        document.title = title_post;
        history.pushState({page_title: title_post}, title_post, link_post);
        
        ajax_post(link_post);
    }); // end click
    
    window.addEventListener('popstate', function(event) {
       document.title = event.state.page_title;
        ajax_page(location.href);
    }, false);
    
    function ajax_post(link_post) {
        
        single_container.animate({
            'opacity': 0 
        }, 300, post() );
        
        function post() {
            
            var data = {
                action: 'get_post',
                link: link_post
            };
            
            $.post( myAjax.ajaxurl, data, function(response) {
                single_container.html(response).animate({
                    'opacity': 1
                }, 300);
            }); // end post
        }
    }
    
    // AJAX CATEGORY
    
    $('#load-posts').click(function(event) {
        event.preventDefault();

        var icon = $(this).find('.load__icon');

        icon.addClass('fa-spin');

        var data = {
            'action': 'load_posts',
            'query': true_posts,
            'page' : current_posts
        };

        $.post( myAjax.ajaxurl, data, function(response) {

            if( response ) { 
                $('.load').before(response);
                current_posts++;
                if (current_posts == max_posts) $('.load').remove();
            } 
            else {
                $('.load').remove();
            }

            icon.removeClass('fa-spin');
        }); // end post
        
    });
    
    // AJAX SEARCH
    
    $('#load-search').click(function(event) {
        event.preventDefault();

        var icon = $(this).find('.load__icon');

        icon.addClass('fa-spin');

        var data = {
            'action': 'load_search',
            'query': true_search,
            'page' : current_search
        };

        $.post( myAjax.ajaxurl, data, function(response) {

            if( response ) { 
                $('.load').before(response);
                current_search++;
                if (current_search == max_search) $('.load').remove();
            } 
            else {
                $('.load').remove();
            }

            icon.removeClass('fa-spin');
        }); // end post

    });
    
});