<div class="trainings">
    <div class="container">
        <h3 class="header trainings__header"><?php single_cat_title(); ?></h3>
        <div class="dots">
            <div class="dot dots__item"></div>
            <div class="dot dots__item"></div>
            <div class="dot dots__item"></div>
            <div class="dot dots__item"></div>
        </div>
        <div class="row">
            <?php get_sidebar(); ?>
            <div class="col-lg-8">
                <div class="main">
                    <?php $posts = new WP_Query( array(
                        'category_name' => 'trainings',
                        'post_type' => 'post',
                        'order' => 'DESC'
                    )); ?>
                    <?php if ( $posts->have_posts() ) :  while ( $posts->have_posts() ) : $posts->the_post(); ?>
                    <?php global $more;
                                 $more = 1; 
                    ?>
                    <?php endwhile; ?>
                    <?php endif; ?>  
                    <div class="lessons" id="<?php echo get_post_meta($post->ID, 'id', true); ?>">
                        <h4 class="lessons__header"><?php the_title(); ?></h4>
                        <div class="lessons__content">
                            <?php the_content(); ?>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
    </div>
</div>
<script>

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

</script>