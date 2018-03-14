<?php 

// REGISTER MENU
register_nav_menus( array(
    'pages' => 'Головне меню',
    'categories' => 'Меню категорій'
));

// ADD CLASS LINKS CATEGORIES
function add_class_to_categories_menu_anchors( $atts, $item, $args ) {
    if ($args-> theme_location == 'categories') {
      $atts ['class'] = 'categories__link';
    }
    return $atts;
}

add_filter( 'nav_menu_link_attributes', 'add_class_to_categories_menu_anchors', 10, 3 );

// ADD CLASS LINKS PAGES

function add_class_to_nav_menu_anchors( $atts, $item, $args ) {
    if ( $args -> menu_class == 'navigation__list' ) {
      $atts ['class'] = 'navigation__link';
    }
    return $atts;
}

add_filter( 'nav_menu_link_attributes', 'add_class_to_nav_menu_anchors', 10, 3 );

// ADD CLASS ITEMS PAGES
function nav_items_class ( $classes, $item, $args ) {
    if( $args -> menu_class == 'navigation__list' ) {
        $classes[] = 'navigation__item';
    }
    return $classes;
}

add_filter ('nav_menu_css_class', 'nav_items_class', 10, 3);

// ADD CLASS LINKS PAGES MOBILE
function add_class_to_burger_menu_anchors( $atts, $item, $args ) {
    if ( $args -> menu_class == 'burger-menu__list' ) {
      $atts ['class'] = 'burger-menu__link';
    }
    return $atts;
}

add_filter( 'nav_menu_link_attributes', 'add_class_to_burger_menu_anchors', 10, 3 );

// ADD CLASS ITEMS PAGES
function burger_items_class ( $classes, $item, $args ) {   
    if( $args -> menu_class == 'burger-menu__list' ) {
        $classes[] = 'burger-menu__item';
    }
    return $classes;
}

add_filter ('nav_menu_css_class', 'burger_items_class', 10, 3);

// ADD THUMBNAILS
add_theme_support( 'post-thumbnails' );

// OUR TEAM

add_action( 'init', 'our_team' );

function our_team() {
    $args = array(
        'public' => true,
        'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
        'menu_icon' => get_template_directory_uri() . '/images/team.png',
        'labels' => array(
            'name' => 'Наша команда',
            'all_items' => 'Всі учасники',
            'add_new' => 'Додати учасника',
            'add_new_item' => 'Новий учасник',
            'edit_item' => 'Редагувати учасника',
            'search_items' => 'Пошук учасників',
            'featured_image' => 'Фото'
        )
    );
    register_post_type( 'team', $args );
}

// AJAX LOAD TRAININGS

add_action('wp_ajax_get_training', 'ajax_show_selected_training');
add_action('wp_ajax_nopriv_get_training', 'ajax_show_selected_training');

function ajax_show_selected_training() {
    $link = !empty( $_POST['link'] ) ? esc_attr( $_POST['link'] ) : false;
    $post_ID = url_to_postid( $link );
    
    if( ! $post_ID ) {
        die( 'Запис не знайдено');
    }
    
    query_posts( array(
        'p' => $post_ID
    ));
?>
  
<?php global $post; ?>
<?php while ( have_posts() ) : the_post(); ?>
<div class="lessons" id="<?php echo get_post_meta($post->ID, 'id', true); ?>">
    <h4 class="lessons__header"><?php the_title(); ?></h4>
    <div class="lessons__content">
        <?php the_content(); ?>
    </div>
</div>
<?php endwhile; ?>
    
<?php
    wp_die();
}

// AJAX LOAD CARTOONS

add_action('wp_ajax_load_cartoons', 'true_load_cartoons');
add_action('wp_ajax_nopriv_load_cartoons', 'true_load_cartoons');

function true_load_cartoons(){
    
    global $post;
 
	$args = unserialize( stripslashes( $_POST['query'] ) );
	$args['paged'] = $_POST['page'] + 1;
	$args['post_status'] = 'publish';
 
	query_posts( $args );

	if( have_posts() ) : ?>
 
        <div class="row">
    
		<?php while( have_posts() ): the_post(); ?>
 
			<div class="col-lg-4 col-md-6 d-flex align-items-stretch">
                <div class="post posts__item">
                    <?php
                        $size = 'post-thumbnail';
                        $attr = 'class = post__img';
                        the_post_thumbnail( $size , $attr ); 
                    ?>
                    <div class="post__info">
                        <h4 class="post__header"><?php the_title(); ?></h4>
                        <a data-fancybox data-src="#<?php echo get_post_meta($post->ID, 'id', true); ?>" href="javascript:;" class="button button_info post__button">Психолого-педагогічний ефект</a>
                        <a data-fancybox data-type="iframe" data-src="<?php echo get_post_meta($post->ID, 'video', true); ?>" href="javascript:;" class="button button_play post__button">Перейти до перегляду</a>
                        <a href="<?php echo get_post_meta($post->ID, 'download', true); ?>" class="button post__button">Завантажити</a>
                    </div>
                    <div class="content" style="display: none;" id="<?php echo get_post_meta($post->ID, 'id', true); ?>">
                        <h3><?php the_title(); ?></h3>
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
 
		<?php endwhile; ?>
		
		</div>
 
	<?php endif;
    
	wp_die();
}

// AJAX LOAD PRESENTATIONS

add_action('wp_ajax_load-presentations', 'true_load_presentations');
add_action('wp_ajax_nopriv_load-presentations', 'true_load_presentations');

function true_load_presentations(){
    
    global $post;
 
	$args = unserialize( stripslashes( $_POST['query'] ) );
	$args['paged'] = $_POST['page'] + 1;
	$args['post_status'] = 'publish';
    
    $presentations = new WP_Query( $args );

	if( $presentations->have_posts() ) : ?>
 
        <div class="row">
    
		<?php while( $presentations->have_posts() ): $presentations->the_post(); ?>
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
		
		</div>
 
	<?php endif;
    
	wp_die();
}

// AJAX LOAD PAGES

add_action('wp_ajax_get_page', 'ajax_show_selected_page');
add_action('wp_ajax_nopriv_get_page', 'ajax_show_selected_page');

function ajax_show_selected_page() {
    $link = !empty( $_POST['link'] ) ? esc_attr( $_POST['link'] ) : false;
    $slug = $link ? wp_basename( $link ) : false;
    $cat = get_category_by_slug( $slug );
    
    if( ! $cat ) {  
        include 'load-index.php';
        wp_die();
    }
    
    query_posts( array(
        'post_per_page' => get_option( 'post_per_page' ),
        'post_status' => 'publish',
        'category_name' => $cat->slug
    ));
    
    if( $slug == 'cartoons' ) {
        require 'load-cartoons.php';
    }
    if( $slug == 'presentations' ) {
        require 'load-presentations.php';
    }
    if( $slug == 'exercises' ) {
        require 'load-exercises.php';
    }
    if( $slug == 'trainings' ) {
        require 'load-trainings.php';
    }
    
    wp_die();
}

// AJAX LOAD POST

add_action('wp_ajax_get_post', 'ajax_show_selected_post');
add_action('wp_ajax_nopriv_get_post', 'ajax_show_selected_post');

function ajax_show_selected_post() {
    $link = !empty( $_POST['link'] ) ? esc_attr( $_POST['link'] ) : false;
    $post_ID = url_to_postid( $link );
    
    if( ! $post_ID ) {
        die( 'Запис не знайдено');
    }
    
    query_posts( array(
        'p' => $post_ID
    ));
?>
   
<div class="publications">
        <div class="publications__container">
            <div class="container">
              
                <?php global $post; ?>
               
                <?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
                
                <?php 
                    
                    $categories = get_the_category();
                    $previous_post = get_previous_post(); 
                    $next_post = get_next_post();
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
    <script>

    // AJAX SINGLE
    
    var single_container = $('main');
    
    $('.arrow').click( function(event) {
        event.preventDefault();
        
        var link_post = $(this).attr('href');
        
        ajax_post(link_post);
    }); // end click
    
    function ajax_post(link_post) {
        
        single_container.animate({
            'opacity': 0 
        }, 300, post() );
        
        function post() {
            
            var data = {
                action: 'get_post',
                link: link_post
            };
            
            $.post( myAjax.ajaxurl, data, function(response) {
                single_container.html(response).animate({
                    'opacity': 1
                }, 300);
            }); // end post
        }
    } 
    
    </script>
    
<?php
    wp_die();
}

// AJAX LOAD SEARCH

add_action('wp_ajax_load_search', 'true_load_search');
add_action('wp_ajax_nopriv_load_search', 'true_load_search');

function true_load_search(){
    
    global $post;
 
	$args = explode( stripslashes( $_POST['query'] ) );
	$args['paged'] = $_POST['page'] + 1;
	$args['post_status'] = 'publish';
 
	query_posts( $args );

    ?>
    <div class="container">
        <?php while (have_posts()) : the_post(); ?>
        <?php $categories = get_the_category(); ?>
            <div class="public">
                <h4 class="public__header public__header_rounded"><?php the_title(); ?></h4>
                <div class="public__content">
                   <?php the_post_thumbnail(); ?>
                   <?php the_content(''); ?>
                </div>
                <a href="<?php the_permalink(); ?>" class="button public__button">Переглянути</a>
                <p class="public__category"> 
                <?php 
                    foreach( $categories as $category ){ 
                        if( $category->category_description != '' ) {
                            continue;
                        } 
                        else {
                            $cat_name = $category->cat_name;
                            $cat_link = get_category_link( $category->cat_ID );
                            echo 'Категорія: <a class="public__link" href="' . $cat_link . '">' . $cat_name . '</a>'; 
                        }
                    }
                ?>
                </p>
            </div>
            <?php endwhile; ?>
            </div>
            <?php global $wp_query; ?>
            <?php if (  $wp_query->max_num_pages > 1 ) : ?>
                <script>
                    var true_search = '<?php echo implode($wp_query->query_vars); ?>';
                    var current_search = <?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
                    var max_search = '<?php echo $wp_query->max_num_pages; ?>';
                    if (current_search == max_search) $('.load').remove();
                </script>
        <?php endif; ?>
    </div>
        
    <?php
    
	wp_die();
}

// AJAX LOAD POSTS

add_action('wp_ajax_load_posts', 'true_load_posts');
add_action('wp_ajax_nopriv_load_posts', 'true_load_posts');

function true_load_posts(){
    
    global $post;
 
	$args = unserialize( stripslashes( $_POST['query'] ) );
	$args['paged'] = $_POST['page'] + 1;
	$args['post_status'] = 'publish';
 
	query_posts( $args );

    ?>
    <div class="container">
        <?php while (have_posts()) : the_post(); ?>
        <?php $categories = get_the_category(); ?>
            <div class="public">
                <h4 class="public__header public__header_rounded"><?php the_title(); ?></h4>
                <div class="public__content">
                   <?php the_post_thumbnail(); ?>
                   <?php the_content(''); ?>
                </div>
                <a href="<?php the_permalink(); ?>" class="button public__button">Прочитати</a>
                <p class="public__category"> 
                <?php 
                    foreach( $categories as $category ){ 
                        if( $category->category_description != '' ) {
                            continue;
                        } 
                        else {
                            $cat_name = $category->cat_name;
                            $cat_link = get_category_link( $category->cat_ID );
                            echo 'Категорія: <a class="public__link" href="' . $cat_link . '">' . $cat_name . '</a>'; 
                        }
                    }
                ?>
                </p>
            </div>
            <?php endwhile; ?>
            </div>
            <?php global $wp_query; ?>
            <?php if (  $wp_query->max_num_pages > 1 ) : ?>
                <script>
                    var true_search = '<?php echo implode($wp_query->query_vars); ?>';
                    var current_search = <?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
                    var max_search = '<?php echo $wp_query->max_num_pages; ?>';
                    if (current_search == max_search) $('.load').remove();
                </script>
        <?php endif; ?>
    </div>
        
    <?php
    
	wp_die();
}

// ADD SCRIPTS

add_action('wp_enqueue_scripts', 'my_assets');

function my_assets() {
    
    wp_enqueue_script('ajax-load', get_template_directory_uri() . '/js/ajax-load.js', array(), null, true);
    
    wp_localize_script('ajax-load', 'myAjax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
    ));
}

// MY COMMENTS

    add_filter('comment_reply_link', 'replace_reply_link_class');

    function replace_reply_link_class($class){
        $class = str_replace("class='comment-reply-link", "class='button comment__button", $class);
        return $class;
    }

  function my_comments($comment, $args, $depth){
    $GLOBALS['comment'] = $comment; ?>
      <div <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
        <div class="row" id="comment-<?php comment_ID(); ?>">
          <div class="comment-author vcard col-lg-1 col-sm-2">
            <?php echo get_avatar($comment,$size='64'); ?>
  
            <?php //printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?>
          </div>
          <?php if ($comment->comment_approved == '0') : ?>
            <em><?php _e('Your comment is awaiting moderation.') ?></em>
            <br />
          <?php endif; ?>
          <div class="col-lg-11 col-sm-10">
          <?php printf(__('<h3 class="comment__header fn">%s</h3>'), get_comment_author_link()) ?>
          
          <?php comment_text() ?>
          
          <div class="reply">
            <?php comment_reply_link(array('depth' => $depth, 'max_depth' => $args['max_depth'])) ?>
          </div>
          </div>
        </div>
  <?php }

?>