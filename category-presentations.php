<?php get_header(); ?>
    <main class="posts">
        <div class="posts__block">
            <div class="container">
                <h3 class="header posts__header">Презентації</h3>
                <div class="dots">
                    <div class="dot dots__item"></div>
                    <div class="dot dots__item"></div>
                    <div class="dot dots__item"></div>
                    <div class="dot dots__item"></div>
                </div>
                <div class="row">
                    <?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
                        <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                            <div class="post posts__item">
                                <?php
                                    $size = 'post-thumbnail';
                                    $attr = 'class = post__img';
                                    the_post_thumbnail( $size , $attr ); 
                                ?>
                                <div class="post__info">
                                    <h4 class="post__header"><?php the_title(); ?></h4>
                                    <a target="_blank" href="<?php echo get_post_meta($post->ID, 'show', true); ?>" class="button button_play post__button">Перейти до перегляду</a>
                                    <a href="<?php echo get_post_meta($post->ID, 'download', true); ?>" class="button post__button">Завантажити</a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
                <?php global $wp_query; ?>
                <?php if (  $wp_query->max_num_pages > 1 ) : ?>
                    <script>
                        var true_posts = '<?php echo serialize($wp_query->query_vars); ?>';
                        var current_page = <?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
                        var max_pages = '<?php echo $wp_query->max_num_pages; ?>';
                    </script>
                    <div class="load container">
                        <a href="#" id="load-presentations" class="button load__button">
                            <span class="load__text">Завантажити ще</span>
                            <i class="load__icon fa fa-refresh" aria-hidden="true"></i>
                        </a>
                    </div>
                <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </main>
<?php get_footer(); ?>