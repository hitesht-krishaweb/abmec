<?php

add_action('wp_ajax_myfilter', 'io_filter_function'); // wp_ajax_{ACTION HERE}
add_action('wp_ajax_nopriv_myfilter', 'io_filter_function');

function io_filter_function()
{
    $minprice = $_GET["prijsmin"];
    $maxprice = $_GET["prijsmax"];

    $minDraaiuren = $_GET["draaiurenMin"];
    $maxDraaiuren = $_GET["draaiurenMax"];

    $minBouwjaar = $_GET["bouwjaarMin"];
    $maxBouwjaar = $_GET["bouwjaarMax"];

    $merk = $_GET["merk"];
    
    $filiaal = $_GET["filiaal"];

    $dateFilter = $_GET['post-filters']['date'];

    $args = array(
        /*'orderby' => 'title', // we will sort posts by date
        'order' => 'ASC', // ASC or DESC*/
        'post_type' => 'occasion',
        'posts_per_page' => '-1',
        'meta_key'          => 'top',
        /*'orderby' => 'top',
        'order' => 'DESC',*/
        'orderby' => array( 'top' => 'DESC', 'title' => 'ASC' ),
    );

    if (isset($_GET['main-category']) && $_GET['main-category']) {
        $args_tax_query = array(
            array(
                'taxonomy' => 'occasion-categorie',
                'field' => 'slug',
                'terms' => sanitize_title($_GET['main-category'])
            )
        );
    }
    
    if (isset($_GET['merk']) && $_GET['merk']) {
        $args_tax_query_merk = array(
            array(
                'taxonomy' => 'merk',
                'field' => 'slug',
                'terms' => sanitize_title($_GET['merk'])
            )
        );
    }

    if($_GET['main-category'] == 'Tractor') {
        $args_tax_query = array(
            array(
                'taxonomy' => 'occasion-categorie',
                'field' => 'slug',
                'terms' => array (
                    'tractoren',
                    'tractoren-accesoires'
                )
            )
        );
    }

    if($_GET['main-category'] == 'Verreikers en shovels') {
        $args_tax_query = array(
            array(
                'taxonomy' => 'occasion-categorie',
                'field' => 'slug',
                'terms' => array (
                    'verreikers',
                    'laadapparatuur',
                    'knikladers'
                )
            )
        );
    }

    if($_GET['main-category'] == 'Werktuigen') {
        $args_tax_query = array(
            array(
                'taxonomy' => 'occasion-categorie',
                'field' => 'slug',
                'terms' => array (
                    'bedrijfsverzorging',
                    'beregening',
                    'grondbewerking',
                    'hooibouw',
                    'kip--en-silagewagens',
                    'mestverwerking',
                    'oogstmachines',
                    'zaai--en-pootmachines',
                    'spuiten',
                    'sloten-en-bermenonderhoud',
                    'tuinbouwmachines',
                    'fruitteeltmachines',
                    'tuin-en-park-machines',
                    'voertechniek',
                    'diverse-werktuigen'
                )
            )
        );
    }

    if ($_GET['spec1'] && isset($_GET['spec1'])) {
        $args_tax_query = array(
            array(
                'taxonomy' => 'occasion-categorie',
                'field' => 'slug',
                'terms' => sanitize_title($_GET['spec1'])
            )
        );
    }

    if ($_GET['spec2'] && isset($_GET['spec2'])) {
        $args_tax_query = array(
            array(
                'taxonomy' => 'occasion-categorie',
                'field' => 'slug',
                'terms' => sanitize_title($_GET['spec2'])
            )
        );
    }
        $args_tax_query_relation = array(
            'relation' => 'AND',
        );



    // create $args['meta_query'] array if one of the following fields is filled
    if (isset($minprice) && $minprice ||
        isset($maxprice) && $maxprice ||
        isset($minDraaiuren) && $minDraaiuren ||
        isset($maxDraaiuren) && $maxDraaiuren ||
        isset($minBouwjaar) && $minBouwjaar ||
        isset($maxBouwjaar) && $maxBouwjaar ||
        isset($filiaal) && $filiaal ||
        isset($_GET['search']) && $_GET['search']
    ) {
        $args['meta_query'] = array('relation' => 'AND'); // AND means that all conditions of meta_query should be true
    }
    // if both minimum price and maximum price are specified we will use BETWEEN comparison

    if(isset($_GET['search']) && $_GET['search']) {
        $args['meta_query'][] = array('value' => $_GET['search'], array('key' => 'naam', 'key' => 'art_code'), 'compare' => 'LIKE');
        $s_index = sizeof($args['meta_query']) - 2; // Save this so we can exclude it in a new query
    }

    // price filter
    if (isset($minprice) && $minprice && isset($maxprice) && $maxprice) {
        $args['meta_query'][] = array(
            'key' => 'prijsexcl',
            'value' => array($minprice, $maxprice),
            'type' => 'numeric',
            'compare' => 'between'
        );
    } else {
        // if only min price is set
        if (isset($minprice) && $minprice) {
            $args['meta_query'][] = array(
                'key' => 'prijsexcl',
                'value' => (int)$minprice,
                'type' => 'numeric',
                'compare' => '>'
            );
        }

        // if only max price is set
        if (isset($maxprice) && $maxprice) {
            $result = 'max';
            $args['meta_query'][] = array(
                'key' => 'prijsexcl',
                'value' => $maxprice,
                'type' => 'numeric',
                'compare' => '<'
            );
        }
    }

    // draaiuren filter

    if (isset($minDraaiuren) && $minDraaiuren && isset($maxDraaiuren) && $maxDraaiuren) {
        $args['meta_query'][] = array(
            'key' => 'draaiuren',
            'value' => array($minDraaiuren, $maxDraaiuren),
            'type' => 'numeric',
            'compare' => 'between'
        );
    } else {
        if (isset($minDraaiuren) && $minDraaiuren) {

            $args['meta_query'][] = array(
                'key' => 'draaiuren',
                'value' => $minDraaiuren,
                'type' => 'numeric',
                'compare' => '>'
            );
        }
        if (isset($maxDraaiuren) && $maxDraaiuren)
            $args['meta_query'][] = array(
                'key' => 'draaiuren',
                'value' => $maxDraaiuren,
                'type' => 'numeric',
                'compare' => '<'
            );
    }

    // bouwjaar filter

    if (isset($minBouwjaar) && $minBouwjaar && isset($maxBouwjaar) && $maxBouwjaar) {
        $args['meta_query'][] = array(
            'key' => 'bouwjaar',
            'value' => array($minBouwjaar, $maxBouwjaar),
            'type' => 'numeric',
            'compare' => 'between'
        );
    } else {
        if (isset($minBouwjaar) && $minBouwjaar) {
            $args['meta_query'][] = array(
                'key' => 'bouwjaar',
                'value' => $minBouwjaar,
                'type' => 'numeric',
                'compare' => '>'
            );
        }

        if (isset($maxBouwjaar) && $maxBouwjaar) {
            $args['meta_query'][] = array(
                'key' => 'bouwjaar',
                'value' => $maxBouwjaar,
                'type' => 'numeric',
                'compare' => '<'
            );
        }
    }

    if (isset($filiaal) && $filiaal) {
        $args['meta_query'][] = array(
            'key' => 'contact_filiaal',
            'value' => $filiaal,
            'compare' => 'LIKE'
        );
    }

    // Date filter

    if(isset($dateFilter) && $dateFilter) {
        switch($dateFilter) {
            case 'today':
                $args['date_query'][] = array(
                    'after' => 'today'
                );
                break;
            case 'yesterday':
                $args['date_query'][] = array(
                    'after' => 'today - 1 day',
                    'inclusive' => true,
                );
                break;
            case 'one-week':
                $args['date_query'][] = array(
                    'after' => 'last week'
                );
                break;
            default:
                $args['date_query'][] = array();
        }
    }


    
    if (isset($_GET['merk']) && $_GET['merk']) {
        $pp_args = $args;
        $pp_args['tax_query'] = $args_tax_query;
        if (isset($_GET['main-category']) && $_GET['main-category']) {
            $args_tax_query_merk_As = array_merge($args_tax_query_relation, $args_tax_query);
            $args['tax_query'] = array_merge($args_tax_query_merk_As,$args_tax_query_merk);
        }else{
            $args['tax_query'] = $args_tax_query_merk;
        }
    }else{
        if ($args_tax_query != "") {
            $args['tax_query'] = $args_tax_query;
        }
        $pp_args = $args;
    }

    



    // on sub category page
if (
    (isset($_GET['main-category']) && $_GET['main-category'] == "") &&
    (isset($_GET['spec1']) && $_GET['spec1'] == "") &&
    (isset($_GET['spec2']) && $_GET['spec2'] == "") &&
    (isset($_GET['merk']) && $_GET['merk'] == "") &&
    (isset($_GET['prijsmin']) && $_GET['prijsmin'] == "0") &&
    (isset($_GET['prijsmax']) && $_GET['prijsmax'] == "0") &&
    (isset($_GET['draaiurenMin']) && $_GET['draaiurenMin'] == "") &&
    (isset($_GET['draaiurenMax']) && $_GET['draaiurenMax'] == "") &&
    (isset($_GET['bouwjaarMin']) && $_GET['bouwjaarMin'] == "") &&
    (isset($_GET['bouwjaarMax']) && $_GET['bouwjaarMax'] == "") &&
    (isset($_GET['filiaal']) && $_GET['filiaal'] == "") &&
    (isset($_GET['search']) && $_GET['search'] == "") &&
    (!isset($_GET['post-filters']['date']) && $_GET['post-filters']['date'] == "")
) {
    $args_new = array(
        'post_type' => 'occasion',
        'posts_per_page' => '-1',
        'meta_key'          => 'top',
        /*'orderby' => 'top',
        'order' => 'DESC',*/
        'orderby' => array( 'top' => 'DESC', 'title' => 'ASC' ),
        'meta_query' => array(
           array(
               'key' => 'top',
               'value' => 'Ja',
               'compare' => '=',
           )
       )
    );
}else{
    $args_new = $args;
}

/*echo "<pre>";
print_r($args);
print_r($args_new);
echo "</pre>";*/
    $query = new WP_Query($args_new);
    ob_start();
    // Hack to make it possible to have an OR relation
    if ( isset($_POST['search']) && $_POST['search'] ) {
        unset($args['meta_query'][$s_index]);
        $args['search'] = $_POST['search'];
        $args['post__not_in'] = wp_list_pluck( $query->posts, 'ID' );
        $query_two = new WP_Query($args);

        $query->posts = array_merge($query->posts, $query_two->posts);
        $query->post_count = $query->post_count + $query_two->post_count;
    }

    //$merk_Data = array();

    if ($query->have_posts()) {
        while ($query->have_posts()): $query->the_post();
            get_template_part('template-parts/occassions', 'overview');

            /*$categories = get_the_terms( $post->ID, 'merk' );
            foreach( $categories as $category ) {
                $merk_Data[] = $category->name;
            }*/

        endwhile;
        wp_reset_postdata();
    } else {
        echo 'No posts found';
    }
    
    $posts = ob_get_clean();


    /*echo "<pre>";
    print_r($args_new);
    print_r($pp_args);
    echo "</pre>"; */ 

    ob_start();
    $pp_query = new WP_Query($pp_args);
    // Hack to make it possible to have an OR relation
    if ( isset($_POST['search']) && $_POST['search'] ) {
        unset($pp_args['meta_query'][$s_index]);
        $pp_args['search'] = $_POST['search'];
        $pp_args['post__not_in'] = wp_list_pluck( $pp_query->posts, 'ID' );
        $pp_query_two = new WP_Query($pp_args);

        $pp_query->posts = array_merge($pp_query->posts, $pp_query_two->posts);
        $pp_query->post_count = $pp_query->post_count + $pp_query_two->post_count;
    }

    $merk_Data = array();

    if ($pp_query->have_posts()) {
        while ($pp_query->have_posts()): $pp_query->the_post();
            $categories = get_the_terms( $post->ID, 'merk' );
            foreach( $categories as $category ) {
                $merk_Data[] = $category->name;
            }
            
        endwhile;
        wp_reset_postdata();
    }

    if (
        (isset($_GET['main-category']) && $_GET['main-category'] == "") &&
        (isset($_GET['spec1']) && $_GET['spec1'] == "") &&
        (isset($_GET['spec2']) && $_GET['spec2'] == "") &&
        (isset($_GET['merk']) && $_GET['merk'] == "") &&
        (isset($_GET['prijsmin']) && $_GET['prijsmin'] == "0") &&
        (isset($_GET['prijsmax']) && $_GET['prijsmax'] == "0") &&
        (isset($_GET['draaiurenMin']) && $_GET['draaiurenMin'] == "") &&
        (isset($_GET['draaiurenMax']) && $_GET['draaiurenMax'] == "") &&
        (isset($_GET['bouwjaarMin']) && $_GET['bouwjaarMin'] == "") &&
        (isset($_GET['bouwjaarMax']) && $_GET['bouwjaarMax'] == "") &&
        (isset($_GET['filiaal']) && $_GET['filiaal'] == "") &&
        (isset($_GET['search']) && $_GET['search'] == "")
    ) {
            echo "";
            $post_count = '';
    }else{
        echo '<option value="">--- Maak een keuze ---</option>';
        $final_merk_Data = array_unique($merk_Data);

        if (in_array($_GET['merk'], $final_merk_Data)) { 
            foreach( $final_merk_Data as $category ) {
                $retVal = ($_GET['merk'] == $category) ? 'selected="selected"' : '' ;
                echo  '<option '.$retVal.' value="'.$category.'">'.$category.'</option>';
            }
        }else{ 
            if (isset($_GET['merk']) && $_GET['merk']) {
                echo '<option selected="selected" value="'.$_GET['merk'].'">'.$_GET['merk'].'</option>';
            }
            foreach( $final_merk_Data as $category ) {
                //$retVal = ($_GET['merk'] == $category) ? 'selected="selected"' : '' ;
                echo  '<option '.$retVal.' value="'.$category.'">'.$category.'</option>';
            }
        } 

        $post_count = $query->found_posts;

    }
    $merk_input = ob_get_clean();

    
    $return = array(
        'posts' => $posts,
        'merk_input' => $merk_input,
        'post_count' => $post_count,
    );
    wp_reset_postdata();
    wp_send_json($return);
    die();
}