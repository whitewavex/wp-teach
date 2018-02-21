$(document).ready(function() {
   
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
            
            $.post( myTrainings.ajaxurl, data, function(response) {
                    container_main.html(response).animate({
                        'opacity': 1
                    }, 300);
                }
            ); // end $.post
        }
        
    } // end ajax_training
    
});