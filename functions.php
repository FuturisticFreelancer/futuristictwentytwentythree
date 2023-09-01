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

function fttt_theme_add_admin_styles_and_scripts(){
    wp_enqueue_style('admin_style', get_template_directory_uri().'/node_modules/bootstrap-icons/font/bootstrap-icons.css');
}

add_action('admin_enqueue_scripts', 'fttt_theme_add_admin_styles_and_scripts');

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
        'name' => __('Service Icons'),
        'singular_name' => __('Service Icon'),
        'menu_name' => __('Service Icons')
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

function fttt_custom_meta_boxes(){
    add_meta_box(
        'fttt_service_icon', 
        __('Ikona usługi'), 
        'fttt_service_icon_callback',
        'post', 
        'side', 
        'high'
    );
}

add_action('add_meta_boxes', 'fttt_custom_meta_boxes');

function fttt_service_icon_callback($post){
    $selected_terms = wp_get_post_terms($post->ID, 'service-icon', array('fields' => 'ids'));
    $terms = get_terms('service-icon', array('hide_empty' => false));
    echo '<label>'.__('Icon:').'</label><br>';
    echo '<input type="radio" name="fttt_service_icon" value="-1" ';
    echo empty($selected_terms) ? 'checked' : '';
    echo ' />'.__('None').'<br>';
    foreach($terms as $term){
        if(!empty($selected_terms) && $term->term_id == $selected_terms[0]){
            $checked = true;
        }else{
            $checked = false;
        }
        echo '<input type="radio" name="fttt_service_icon" value="'.$term->term_id.'" ';
        echo $checked ? 'checked' : '';
        echo ' /><i class="'.$term->name.'"></i> '.__('Wordpress').'<br>';
    }
}

function save_custom_meta_box($post_id){
    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
        return;
    }

    if(!current_user_can('edit_post', $post_id)){
        return;
    }

    if(!isset($_POST['fttt_service_icon']) && !is_array($_POST['fttt_service_icon'])){
        return;
    }

    $selected_terms = array_map('intval', $_POST['fttt_service_icon']);
    wp_set_post_terms($post_id, $selected_terms, 'service-icon');
}
?>