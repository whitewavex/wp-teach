<?php get_header(); ?>
<main>
    <div class="not-found">
        <div class="container">
           
        <?php if (have_posts()) : ?>  
            <h3 class="not-found__header header">Результати пошуку</h3>
            <div class="dots">
                <div class="dot dots__item"></div>
                <div class="dot dots__item"></div>
                <div class="dot dots__item"></div>
                <div class="dot dots__item"></div>
            </div>
        <?php while (have_posts()) : the_post(); ?>
        <?php $categories = get_the_category(); ?>
            <div class="public">
                <h4 class="public__header public__header_rounded"><?php the_title(); ?></h4>
                <div class="public__content">
                   <?php the_post_thumbnail(); ?>
                   <?php the_content(''); ?>
                </div>
                <a href="<?php the_permalink(); ?>" class="button public__button">Переглянути</a>
                <p class="public__category"> 
                <?php 
                    foreach( $categories as $category ){ 
                        if( $category->category_description != '' ) {
                            continue;
                        } 
                        else {
                            $cat_name = $category->cat_name;
                            $cat_link = get_category_link( $category->cat_ID );
                            echo 'Категорія: <a class="public__link" href="' . $cat_link . '">' . $cat_name . '</a>'; 
                        }
                    }
                ?>
                </p>
            </div>
            <?php endwhile; ?>
            </div>
            <?php global $wp_query; ?>
            <?php if (  $wp_query->max_num_pages > 1 ) : ?>
                <script>
                    var true_search = '<?php echo implode($wp_query->query_vars); ?>';
                    var current_search = <?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
                    var max_search = '<?php echo $wp_query->max_num_pages; ?>';
                </script>
                <div id="load-search" class="load container">
                    <a href="" class="button load__button">
                        <span class="load__text">Завантажити ще</span>
                        <i class="load__icon fa fa-refresh" aria-hidden="true"></i>
                    </a>
                </div>
            <?php endif; ?>
            <?php else: ?>
            <h3 class="not-found__header header">По Вашому запиту нічого не знайдено</h3>
                <div class="dots">
                    <div class="dot dots__item"></div>
                    <div class="dot dots__item"></div>
                    <div class="dot dots__item"></div>
                    <div class="dot dots__item"></div>
                </div>
            <div>
                <img class="not-found__img" src="<?php bloginfo('template_url');?>/images/search.png" alt="">
            </div>

            <?php endif; ?>
        </div>
    </div>
</main>
<?php get_footer(); ?>