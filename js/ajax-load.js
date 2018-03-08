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
    
});