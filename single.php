<?php get_header(); ?>
<main>
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
                
                <script>
                    var title_next_post = '<?php echo $next_post->post_title ?>';
                    var title_previous_post = '<?php echo $previous_post->post_title; ?>';
                </script>
                <div class="row justify-content-between publications__arrows arrows">
                    <div class="col-xl-4 col-lg-5 col-md-6 col-sm-6 col-6 arrows__back">
                        <?php
                        
                            if( $previous_post ) {
                                echo '<a href="' . get_permalink( $previous_post ) . '" id="previous_post" class="arrow"><i class="fa fa-arrow-left"></i><span class="arrows__text">попередній запис</span></a>';
                            }
                    
                        ?>
                    </div>
                    <div class="col-xl-4 col-lg-5 col-md-6 col-sm-6 col-6 arrows__next">
                        <?php
                        
                            if( $next_post ) {
                                echo '<a href="' . get_permalink( $next_post ) . '" id="next_post" class="arrow"><span class="arrows__text">наступний запис</span><i class="fa fa-arrow-right"></i></a>';
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
                <div class="public">
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
                </div>
                
                <?php comments_template(); ?>
                
                <?php endwhile; ?>
                <?php endif; ?>
                
            </div>
        </div>
    </div>
</main>
<?php get_footer(); ?>