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

add_action('wp_ajax_get_training', 'ajax_show_selected_post');
add_action('wp_ajax_nopriv_get_training', 'ajax_show_selected_post');

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