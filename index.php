<?php 
    get_header();
    echo "<div class='container p-3'>";
    if ( have_posts() ) :
        while ( have_posts() ) : the_post();
            echo '<div class="row"><h3>';
            the_title();
            echo '</h3></div>';
            echo '<div class="row">';
            the_content();
            echo '</div>';
        endwhile;
    else:
        _e( 'Nie znaleziono strony.', 'textdomain' );
    endif;
    echo "</div>";
    get_footer(); 
?>