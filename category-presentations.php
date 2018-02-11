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
                    <?php endif; ?>
                </div>
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
        </div>
    </main>
<?php get_footer(); ?>