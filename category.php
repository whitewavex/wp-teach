<?php get_header(); ?>
    <main class="publications">
        <div class="publications__container">
            <div class="container">
                <h3 class="header publications__header"><?php single_cat_title(); ?></h3>
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
    </main>
<?php get_footer(); ?>