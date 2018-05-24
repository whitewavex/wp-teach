<!DOCTYPE html>
    <html lang="uk">
    <head>
        <meta charset="UTF-8">
        <title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="<?php bloginfo(template_url) ?>/libs/bootstrap.min.css">
        <link rel="stylesheet" href="<?php bloginfo(template_url) ?>/libs/jquery.fancybox.min.css">
        <link rel="stylesheet" href="<?php bloginfo(stylesheet_url) ?>">
        <?php wp_head(); ?>
    </head>
    <body class="page">
        <header class="header-block">
            <div class="header-up">
                <div class="container">
                    <div class="nav-mobile header-up__nav-mobile float-left">
                        <a href="#" class="nav-line nav-mobile__nav-line top"></a>
                        <a href="#" class="nav-line nav-mobile__nav-line middle"></a>
                        <a href="#" class="nav-line nav-mobile__nav-line bottom"></a>
                    </div>
                    <form class="search float-right" role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) )  ?>">
                        <input name="s" class="search__text" type="search" value="Пошук..." onFocus="if(this.value=='Пошук...')this.value=''" onBlur="if(this.value=='')this.value='Пошук...'">
                        <button class="search__btn">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="header-cover">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="title header-cover__title col-xl-8 col-lg-10 col-sm-12">
                            <h1 class="text-center"><?php bloginfo('name'); ?></h1>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-8 text-center">
                            <div class="menu header-cover__menu">
                                <i class="fa fa-bars menu__icon" aria-hidden="true"></i>
                                <h3 class="menu__header">Меню</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="categories header__categories d-flex justify-content-around align-items-center">
                <div class="categories__header">
                    <h3>Оберіть категорію</h3>
                </div>
                <div class="categories__items">
                    <?php 
                        
                        $args = array(
                            'theme_location'  => 'categories', 
                            'container'       => false,
                            'echo'            => false,
                            'items_wrap'      => '%3$s',
                            'depth'           => 0
                        );

                        echo strip_tags(wp_nav_menu( $args ), '<a>' );
                    
                    ?>
                    <a href="<?php echo get_permalink( 123 ); ?>" class="categories__link">Додатки</a>

                </div>
                
                <div class="categories__close">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </div>
            </div>
            <div class="overlay"></div>
            <div class="navigation">
            
            <?php
                
                $args = array(
                    'theme_location'  => 'pages',
                    'container'       => 'div',
                    'container_class' => 'container',
                    'menu_class'      => 'navigation__list',
                    'items_wrap'      => '<ul class="%2$s">%3$s</ul>'
                );
                
                wp_nav_menu( $args );
                
            ?>

            </div>
            <div class="burger-menu">
            
            <?php 
            
                $args = array(
                    'theme_location'  => 'pages',
                    'container'       => 'div',
                    'container_class' => 'burger-menu__nav',
                    'menu_class'      => 'burger-menu__list',
                    'items_wrap'      => '<ul class="%2$s">%3$s</ul>'
                );
                
                wp_nav_menu( $args );
                
            ?>
            
            </div>
        </header>