<?php 

require_once get_template_directory().'/FuturisticMenuWalker.php';

add_filter('show_admin_bar', '__return_false');

function fttt_theme_setup(){
    add_theme_support('title-tag');
    add_filter('document_title_separator', function($arg){return '|';});
}

add_action('after_setup_theme', 'fttt_theme_setup');


function fttt_theme_add_styles_and_scripts(){
    wp_enqueue_style('theme_style', get_template_directory_uri().'/style.css');
    wp_enqueue_script('bootstrap_script', get_template_directory_uri().'/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js');
}

add_action('wp_enqueue_scripts', 'fttt_theme_add_styles_and_scripts');

function fttt_theme_register_menus(){
    register_nav_menus(
        array(
            'header-menu' => __( 'Główne menu')
        )
    );
}

add_action('init', 'fttt_theme_register_menus');

function fttt_register_taxonomies(){
    $labels = array(
        'name' => 'Service Icons',
        'singular_name' => 'Service Icon',
        'menu_name' => 'Service Icons'
    );

    $args = array(
        'labels' => $labels,
        'public' => false,
        'show_ui' => true,
        'show_admin_column' => true,
        'hierarchical' => false,
        'query_var' => true,
        'rewrite' => array('slug' => 'service-icon')
    );

    register_taxonomy('service-icon', 'post', $args);
}

add_action('init', 'fttt_register_taxonomies');
?>