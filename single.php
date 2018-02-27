<?php get_header(); ?>
    <div class="publications">
        <div class="publications__container">
            <div class="container">
               
                <?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
                
                <?php 
                    
                    $categories = get_the_category();
                    $previous_post = get_previous_post(true); 
                    $next_post = get_next_post(true);
                    $video = get_post_meta($post->ID, 'video', true);
                    $presentation = get_post_meta($post->ID, 'show', true);
                
                ?>
                
                <div class="row justify-content-between publications__arrows arrows">
                    <div class="col-xl-4 col-lg-5 col-md-6 col-sm-6 col-6 arrows__back">
                        <?php
                        
                            if( $previous_post ) {
                                echo '<a href="' . get_permalink( $previous_post ) . '" class="arrow"><i class="fa fa-arrow-left"></i><span class="arrows__text">попередній запис</span></a>';
                            }
                    
                        ?>
                    </div>
                    <div class="col-xl-4 col-lg-5 col-md-6 col-sm-6 col-6 arrows__next">
                        <?php
                        
                            if( $next_post ) {
                                echo '<a href="' . get_permalink( $next_post ) . '" class="arrow"><span class="arrows__text">наступний запис</span><i class="fa fa-arrow-right"></i></a>';
                            }
                    
                        ?>
                    </div>
                </div>
                <div class="dots">
                    <div class="dot dots__item"></div>
                    <div class="dot dots__item"></div>
                    <div class="dot dots__item"></div>
                    <div class="dot dots__item"></div>
                </div>
                <main class="public">
                    <h3 class="public__header public__header_rounded"><?php the_title(); ?></h3>
                    <div class="public__content">
                        <?php 
                        
                            if( $video ) {
                                echo '<iframe class="public__video" src="' . $video . '" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
                            }
                        
                            if( $presentation ) {
                                echo '<a target="_blank" href="' . $presentation . '">Перейти до перегляду презентації</a><hr>';
                            }
                        
                        ?>
                        <?php the_content(); ?>
                    </div>
                    <div class=" public__footer">
                        <div class="date public__date">
                            <i class="fa fa-calendar-check-o"></i>
                            <span><?php the_date(); ?></span>
                        </div>
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
                </main>
                
                <?php endwhile; ?>
                <?php endif; ?>
                
                <div class="comments main__comments">
                    <h4 class="comments__header">Оставить комментарий</h4>
                    <p class="comments__note">Ваш email не будет опубликован. Обязательные поля отмечены *</p>
                    <form class="comments__form">
                        <div class="row">
                            <div class="col-lg-3 col-md-4 col-sm-8 col-9 offset-lg-1">
                                <input type="text" class="comments__field" placeholder="Ваше ім'я *">
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-8 col-9">
                                <input type="email" class="comments__field" placeholder="Ваш e-mail *">
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-8 col-9">
                                <input type="url" class="comments__field" placeholder="Адреса вашого сайту">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-9 offset-lg-1">
                                <textarea cols="30" rows="10" class="comments__field comments__field_message" placeholder="Текст повідомлення..."></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 col-sm-8 col-9 offset-lg-1">
                                <input type="submit" class="button comments__field comments__field_sm" value="Відправити">
                            </div>
                        </div>
                    </form>
                    <h4 class="comments__title">Коментарі</h4>
                    <div class="comment">
                        <div class="row">
                            <div class="col-lg-1 col-sm-2">
                                <img src="<?php bloginfo(template_url) ?>/images/comment_1.jpg" alt="">
                            </div>
                            <div class="col-lg-11 col-sm-10">
                                <h5 class="comment__header">Олександр</h5>
                                <p class="comment__text">Ни как не могу её прочитать до конца. В книге вложен огромный опыт. Такое ощущение, что её писала целая команда знатоков этой темы. В книге много примеров изложено. И не только для применения в интернет проектах, но и в реальной жизни. Читаешь и думаешь, да это так и есть, как написано.</p>
                                <button class="button comment__button">Відповісти</button>
                                <div class="comment">
                                    <div class="row">
                                        <div class="col-lg-1 col-sm-3">
                                            <img src="<?php bloginfo(template_url) ?>/images/comment_2.jpg" alt="">
                                        </div>
                                        <div class="col-lg-11 col-sm-9">
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
                            <div class="col-lg-1 col-sm-2">
                                <img src="<?php bloginfo(template_url) ?>/images/comment_2.jpg" alt="">
                            </div>
                            <div class="col-lg-11 col-sm-10">
                                <h5 class="comment__header">Андрій</h5>
                                <p class="comment__text">Ни как не могу её прочитать до конца. В книге вложен огромный опыт. Такое ощущение, что её писала целая команда знатоков этой темы. В книге много примеров изложено. И не только для применения в интернет проектах, но и в реальной жизни. Читаешь и думаешь, да это так и есть, как написано.</p>
                                <button class="button comment__button">Відповісти</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php get_footer(); ?>