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

add_action('wp_enqueue_scripts', 'my_assets');

function my_assets() {
    
    wp_enqueue_script('ajax-trainings', get_template_directory_uri() . '/js/ajax-traininigs.js', array(), null, true);
    
    wp_localize_script('ajax-trainings', 'myTrainings', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
    ));
}

?>