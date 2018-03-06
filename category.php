<?php get_header(); ?>
    <main class="publications">
        <div class="publications__container">
            <div class="container">
                <h3 class="header publications__header">Публікації</h3>
                <div class="dots">
                    <div class="dot dots__item"></div>
                    <div class="dot dots__item"></div>
                    <div class="dot dots__item"></div>
                    <div class="dot dots__item"></div>
                </div>
                
                <?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
                
                <?php $categories = get_the_category(); ?>
                
                <div class="public">
                    <h4 class="public__header public__header_rounded"><?php the_title(); ?></h4>
                    <div class="public__content">
                       <?php the_post_thumbnail(); ?>
                       <?php the_content(''); ?>
                    </div>
                    <a href="<?php the_permalink(); ?>" class="button public__button">Переглянути запис</a>
                    <p class="public__category">Категорія: 
                    <?php 
                        foreach( $categories as $category ){ 
                            if( $category->category_description != '' ) {
                                continue;
                            } 
                            else {
                                $cat_name = $category->cat_name;
                                $cat_link = get_category_link( $category->cat_ID );
                                echo '<a class="public__link" href="' . $cat_link . '">' . $cat_name . '</a>'; 
                            }
                        }
                    ?>
                    </p>
                </div>
                
                <?php endwhile; ?>
                <?php endif; ?>
                
<!--
                <div class="load container">
                    <a href="#" class="button load__button">
                        <span class="load__text">Завантажити ще</span>
                        <i class="load__icon fa fa-refresh" aria-hidden="true"></i>
                    </a>
                </div>
-->
            </div>
        </div>
    </main>
<?php get_footer(); ?>