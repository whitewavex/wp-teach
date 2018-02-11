<?php get_header(); ?>
    <div class="not-found">
        <div class="container">
            <h3 class="not-found__header header">Вибачте, але такої сторінки не існує</h3>
            <div class="dots">
                <div class="dot dots__item"></div>
                <div class="dot dots__item"></div>
                <div class="dot dots__item"></div>
                <div class="dot dots__item"></div>
            </div>
            <img class="not-found__img" src="<?php bloginfo('template_url');?>/images/404.png" alt="">
        </div>
    </div>
<?php get_footer(); ?>