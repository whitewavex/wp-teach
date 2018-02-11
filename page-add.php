<?php
/*
Template Name: Adds
*/
?>
   <?php get_header(); ?>
    <main>
    
        <?php if (have_posts()) :  while (have_posts()) : the_post(); ?>

            <div class="welcome">
                <div class="container">
                    <h3 class="header welcome__header"><?php the_title(); ?></h3>
                    <div class="dots">
                        <div class="dot dots__item"></div>
                        <div class="dot dots__item"></div>
                        <div class="dot dots__item"></div>
                        <div class="dot dots__item"></div>
                    </div>
                    <div class="info welcome__info">
                        <div class="info__content float-md-left">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
            </div>

        <?php endwhile; ?>
        <?php endif; ?>

    </main>
<?php get_footer(); ?>