<?php get_header(); ?>
<main>
    <div class="articles">
        <div id="accordion" class="container">
            <h3 class="header articles__header"><?php single_cat_title(); ?></h3>
            <div class="dots">
                <div class="dot dots__item"></div>
                <div class="dot dots__item"></div>
                <div class="dot dots__item"></div>
                <div class="dot dots__item"></div>
            </div>
            
            <?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
            
            <?php 
                global $more;
                $more = 1;
            ?>
            
            <div class="card article articles__item">
                <div class="card-header article__header" id="<?php echo get_post_meta($post->ID, 'id', true); ?>">
                    <h5 class="mb-0">
                        <button class="btn btn-link article__link" data-toggle="collapse" data-target="#<?php echo get_post_meta($post->ID, 'target', true); ?>" aria-expanded="false" aria-controls="<?php echo get_post_meta($post->ID, 'target', true); ?>">
                            <?php the_title(); ?>
                            <i class="fa fa-chevron-left article__icon" aria-hidden="true"></i>
                        </button>
                    </h5>
                </div>
                <div id="<?php echo get_post_meta($post->ID, 'target', true); ?>" class="collapse article__info" aria-labelledby="<?php echo get_post_meta($post->ID, 'id', true); ?>" data-parent="#accordion">
                    <div class="card-body article__text">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
            <?php endif; ?>
            
        </div>
    </div>
</main>
<?php get_footer(); ?>