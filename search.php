<?php get_header(); ?>
    <div class="not-found">
        <div class="container">
            <h3 class="not-found__header header">Результати пошуку</h3>
            <div class="dots">
                <div class="dot dots__item"></div>
                <div class="dot dots__item"></div>
                <div class="dot dots__item"></div>
                <div class="dot dots__item"></div>
            </div>
            
                <?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
                    <div class="public">
                        <h4 class="public__header"><?php the_title(); ?></h4>
                        <div class="public__content">
                           <?php the_content(''); ?>
                        </div>
                        <a href="<?php the_permalink(); ?>" class="button public__button">Прочитати</a>
                        <p class="public__author">Автор: <?php the_author(); ?></p>
                    </div>
                <?php endwhile; ?>
                <?php else: ?>
                    <h4 class="not-found__header public__header">По вашому запиту нічого не знайдено</h4>
                    </div>
                        <img class="not-found__img" src="<?php bloginfo('template_url');?>/images/search.png" alt="">
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="load container">
           
            <?php
                $args = array(
                    'show_all'     => false, // показаны все страницы участвующие в пагинации
                    'end_size'     => 1,     // количество страниц на концах
                    'mid_size'     => 1,     // количество страниц вокруг текущей
                    'prev_next'    => true,  // выводить ли боковые ссылки "предыдущая/следующая страница".
                    'prev_text'    => __('Попередня сторінка'),
                    'next_text'    => __('Наступна сторінка'),
                    'add_args'     => false, // Массив аргументов (переменных запроса), которые нужно добавить к ссылкам.
                    'add_fragment' => '',     // Текст который добавиться ко всем ссылкам.
                    'screen_reader_text' =>  ' '
                );
                the_posts_pagination($args); 
            ?>

    </div>
<?php get_footer(); ?>