<?php get_header(); ?>
    <div class="trainings">
        <div class="container">
            <h3 class="header trainings__header"><?php single_cat_title(); ?></h3>
            <div class="dots">
                <div class="dot dots__item"></div>
                <div class="dot dots__item"></div>
                <div class="dot dots__item"></div>
                <div class="dot dots__item"></div>
            </div>
            <div class="row">
                <?php get_sidebar(); ?>
                <div class="col-lg-8">
                    <main class="main">
                        <?php $posts = new WP_Query( array(
                            'category_name' => 'trainings',
                            'post_type' => 'post',
                            'order' => 'ASC'
                        )); ?>
                        <?php if ( $posts->have_posts() ) :  while ( $posts->have_posts() ) : $posts->the_post(); ?>
                            <div class="lessons" id="<?php echo get_post_meta($post->ID, 'id', true); ?>">
                                <h4 class="lessons__header"><?php the_title(); ?></h4>
                                <div class="lessons__content">
                                    <?php the_content(''); ?>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="button public__button">Прочитати</a>
                            </div>
                        <?php endwhile; ?>
                        <?php endif; ?>                      
<!--
                        <div class="comments main__comments">
                            <h4 class="comments__header">Оставить комментарий</h4>
                            <p class="comments__note">Ваш email не будет опубликован. Обязательные поля отмечены *</p>
                            <form class="comments__form">
                                <div class="row">
                                    <div class="col-md-4 col-sm-8 col-9">
                                        <input type="text" class="comments__field" placeholder="Ваше ім'я *">
                                    </div>
                                    <div class="col-md-4 col-sm-8 col-9">
                                        <input type="email" class="comments__field" placeholder="Ваш e-mail *">
                                    </div>
                                    <div class="col-md-4 col-sm-8 col-9">
                                        <input type="url" class="comments__field" placeholder="Адреса вашого сайту">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <textarea cols="30" rows="10" class="comments__field comments__field_message" placeholder="Текст повідомлення..."></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4 col-9">
                                        <input type="submit" class="button comments__field comments__field_sm" value="Відправити">
                                    </div>
                                </div>
                            </form>
                            <h4 class="comments__title">Коментарі</h4>
                            <div class="comment">
                                <div class="row">
                                    <div class="col-md-2 col-sm-3">
                                        <img src="images/comment_1.jpg" alt="">
                                    </div>
                                    <div class="col-md-10 col-sm-9">
                                        <h5 class="comment__header">Олександр</h5>
                                        <p class="comment__text">Ни как не могу её прочитать до конца. В книге вложен огромный опыт. Такое ощущение, что её писала целая команда знатоков этой темы. В книге много примеров изложено. И не только для применения в интернет проектах, но и в реальной жизни. Читаешь и думаешь, да это так и есть, как написано.</p>
                                        <button class="button comment__button">Відповісти</button>
                                        <div class="comment">
                                            <div class="row">
                                                <div class="col-md-2 col-sm-3">
                                                    <img src="images/comment_2.jpg" alt="">
                                                </div>
                                                <div class="col-md-10 col-sm-9">
                                                    <h5 class="comment__header">Андрій</h5>
                                                    <p class="comment__text">Ни как не могу её прочитать до конца. В книге вложен огромный опыт. Такое ощущение, что её писала целая команда знатоков этой темы. В книге много примеров изложено. И не только для применения в интернет проектах, но и в реальной жизни. Читаешь и думаешь, да это так и есть, как написано.</p>
                                                    <button class="button comment__button">Відповісти</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="comment">
                                <div class="row">
                                    <div class="col-md-2 col-sm-3">
                                        <img src="images/comment_2.jpg" alt="">
                                    </div>
                                    <div class="col-md-10 col-sm-9">
                                        <h5 class="comment__header">Андрій</h5>
                                        <p class="comment__text">Ни как не могу её прочитать до конца. В книге вложен огромный опыт. Такое ощущение, что её писала целая команда знатоков этой темы. В книге много примеров изложено. И не только для применения в интернет проектах, но и в реальной жизни. Читаешь и думаешь, да это так и есть, как написано.</p>
                                        <button class="button comment__button">Відповісти</button>
                                    </div>
                                </div>
                            </div>
                        </div>
-->
                    </main>
                </div>
            </div>
        </div>
    </div>
<?php get_footer(); ?>