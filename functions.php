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

// SIDEBAR

//register_sidebar(array(
//	'name'          => 'Бічна колонка',
//    'description'   => 'Місце для розташування віджетів',
//	'id'            => 'sidebar',
//	'before_widget' => '<div class="widget">',
//	'after_widget'  => '</div>',
//	'before_title'  => '<h4 class="widget__header">',
//	'after_title'   => '</h4>',));

?>