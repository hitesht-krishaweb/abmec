<?php

function io_load_more_scripts() {
    global $wp_query;
    wp_register_script( 'io_loadmore', get_stylesheet_directory_uri() . '/src/js/loadmore.js', array('jquery') );

    wp_localize_script( 'io_loadmore', 'io_loadmore_params', array(
        'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',
        'posts' => json_encode( $wp_query->query_vars ),
        'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
        'max_page' => $wp_query->max_num_pages,
    ) );

    wp_enqueue_script( 'io_loadmore' );
}

add_action( 'wp_enqueue_scripts', 'io_load_more_scripts' );


add_action('wp_ajax_loadmore', 'io_loadmore_ajax_handler');
add_action('wp_ajax_nopriv_loadmore', 'io_loadmore_ajax_handler');

function io_loadmore_ajax_handler(){
    $args = json_decode( stripslashes( $_POST['query'] ), true );

    $args['paged'] = $_POST['page'] + 1;
    $args['post_status'] = 'publish';
    $args['post__not_in'] = get_option( 'sticky_posts' );

    query_posts( $args );

    if( have_posts() ) :

        while( have_posts() ): the_post();
        echo '<div class="row">';
            get_template_part('template-parts/news', 'item');
            echo '</div>';
        endwhile;

    endif;
    die;
}

?>