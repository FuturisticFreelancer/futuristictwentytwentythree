<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
        <?php wp_head(); ?>
    </head>
    <body>
        <div class="front-page-container">
            <?php get_sidebar('lang'); ?>
            <!-- Nawigacja -->
            <nav class="futuristic-nav">
                <div class="nav-div">
                    <a href="<?php echo esc_url(home_url('/', 'http' )); ?>" class="navbar-brand"><?php echo get_bloginfo('name'); ?></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <?php 
                        wp_nav_menu([
                            'theme_location' => 'header-menu',
                            'menu_class' => 'navbar-nav ms-auto mb-lg-0 me-5 has-medium-font-size',
                            'container' => 'div',
                            'container_class' => 'collapse navbar-collapse',
                            'container_id' => 'navigation',
                            'walker' => new Futuristic_Menu_Walker()
                        ]);
                    ?>
                </div>
            </nav>