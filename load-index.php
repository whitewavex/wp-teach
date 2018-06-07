<?php $welcome = new WP_Query(array('pagename' => 'welcome', 'order' => 'ASC')) ?>

<?php if ($welcome->have_posts()) :  while ($welcome->have_posts()) : $welcome->the_post(); ?>

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
                <?php if(has_post_thumbnail()): ?>
                    <?php
                        $size = array( 477, 363 );
                        $attr = array( 'class' => 'info__img float-md-left' );
                        the_post_thumbnail( $size, $attr ); 
                    ?>
                <?php else: ?>
                    <img src="<?php bloginfo('template_url');?>/images/no_image.jpg" alt="Вітаємо!"/>
                <?php endif; ?>
                    <?php the_content(); ?>
            </div>
        </div>
    </div>

<?php endwhile; ?>
<?php endif; ?>

<div class="our-team container">
    <h3 class="header our-team__header">Наша команда</h3>
    <div class="dots">
        <div class="dot dots__item"></div>
        <div class="dot dots__item"></div>
        <div class="dot dots__item"></div>
        <div class="dot dots__item"></div>
    </div>
    <div class="row ">

<?php $team = new WP_Query(array('post_type' => 'team', 'order' => 'ASC')) ?>

<?php if( $team->have_posts() ) : while ( $team->have_posts() ) : $team->the_post(); ?>
        <div class="col-lg-4 col-md-6 col-12">
            <div class="person">
                <h4 class="person__title"><?php echo get_post_meta($post->ID, 'person-title', true); ?></h4>
                <?php
                    $size = array( 156, 156 );
                    the_post_thumbnail( $size ); 
                ?>
                <h4 class="person__header"><?php the_title(); ?></h4>
                <?php the_content(); ?>
            </div>
        </div>

<?php endwhile; ?>
<?php else: ?>
<?php endif; ?>
    </div>
</div>