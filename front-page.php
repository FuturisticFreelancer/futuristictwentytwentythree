<?php 
    get_header();
    if( get_option( 'page_on_front' ) ) {
        echo apply_filters( 'the_content', get_post( get_option( 'page_on_front' ) )->post_content );
    }
    get_footer(); 
?>