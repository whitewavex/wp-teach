                <div class="col-lg-4">
                    <div class="sidebar">
                        <div class="widget">
                            <h4 class="widget__header">Мандрівка країною здоров’я</h4>
                            <ul class="widget__list">
                            <?php $posts = new WP_Query( array(
                                'category_name' => 'trainings',
                                'post_type' => 'post',
                                'order' => 'ASC'
                            )); ?>
                            <?php if ( $posts->have_posts() ) :  while ( $posts->have_posts() ) : $posts->the_post(); ?>
                               
                                <li class="widget__item">
                                    <a href="#<?php echo get_post_meta($post->ID, 'id', true); ?>" class="widget__link"><?php the_title(); ?></a>
                                </li>
                                
                            <?php endwhile; ?>
                            <?php endif; ?>
                            
                            </ul>
                        </div>
                    </div>
                </div>