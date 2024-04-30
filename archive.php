<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */
// Redirect to the specified URL
$redirect_url = 'https://www.abemec.nl/occasionss/';
wp_redirect($redirect_url);
exit;
get_header();
?>
<section class="section">
    <div class="container">

        <?php custom_breadcrumbs(); ?>

        <div class="row">
            <div class="d-lg-block col-lg-3 col-xl-2" data-module-filter-filters>
        <?php
//        wp_nav_menu( [ 'menu' => 'Occasion categorie menu_page_url( $menu_slug, $echo ); (prog)' ] );
        the_occasion_filters();
        ?>
                <script type="text/javascript">
                    jQuery( document ).ready(function() {


                        jQuery('#filter').submit(filter_form);

                        jQuery( "#filter select, input" ).on( "change", filter_form);
                        if ( jQuery( "#filter select, input" ).filter(function(a){ return a.value != ''; }).length > 0 ) {
                            filter_form();
                        }
                    function filter_form() {
                            var filter = jQuery('#filter');

                            var s = jQuery('.oc-search-input').val();
                            jQuery('#occ_search').val(s);



                            jQuery.ajax({
//                                url:filter.attr('action'),

                                url:"<?php echo site_url() ?>/wp-admin/admin-ajax.php",
                                data:filter.serialize(), // form data
                                type:filter.attr('method'), // POST

                                cache: false,

                                beforeSend:function(xhr){
                                    filter.find('button').text('Processing...'); // changing the button label

                                },
                                success:function(data){
                                    filter.find('button').text('Apply filter'); // changing the button label back
                                    var url = window.location.pathname;
                                    url += '?' + filter.serialize();

                                    window.history.pushState(null, '', url);
                                    jQuery('#products').html(data.posts); // insert data
                                    if (data.post_count != "") {
                                        //jQuery('input#search').attr('placeholder', 'Zoek in alle '+data.post_count+' occasions');
                                    }
                                    if (data.merk_input != "") {
                                        jQuery('select#merk').html('');
                                        jQuery('select#merk').html(data.merk_input);

                                    }
                                }
                            });
                            return false;
            }
                    });


                </script>
    </div>
    <div class="col-lg-9 col-xl-10" >
            <style>
input.oc-search-input {height: 3rem;background: #ededed;border: 0;}
input.oc-search-input::placeholder {color: #007a3d;font-style: italic;}
.oc-search {background: #ffe100;font-size: 14px;padding: 0 20px;text-transform: uppercase;color: #007a3d;font-weight: bold;}
.form-inline {display: flex;margin-bottom: 14px;}
.oc-search-input-container {position: relative;width: 100%;}
.oc-search-input-clear {position: absolute;width: 25px;height: 25px;text-align: center;right: 10px;top: 15px;cursor: pointer;color: #666;}
.oc-search-input-clear:active, .oc-search-input-clear:visited, .oc-search-input-clear:hover {color: #666;}
div#products img.occasions_loader {margin: 0 auto;}
.occasions_loader_wrapper { width: 100%; text-align: center; min-height: 400px; display: flex; align-items: center; }
            </style>
        <?php 

        $args_new_ar = array(
            'post_type' => 'occasion',
            'posts_per_page' => '-1',
            'meta_key'          => 'top',
            'orderby' => 'top',
            'order' => 'DESC',
            'meta_query' => array(
               array(
                   'key' => 'top',
                   'value' => 'Ja',
                   'compare' => '=',
               )
           )
        );
        $wpQuery_new = new WP_Query($args_new_ar);



        if ( $wpQuery_new->have_posts() ) :

        $args_new_ar_seach = array(
            'post_type' => 'occasion',
        );
        $wpQuery = new WP_Query($args_new_ar_seach);
        $count = $wpQuery->found_posts;

        ?>

<!--            <form method="get" action="--><?php //echo home_url( '/' ); ?><!--">-->
                <div class="form-inline">
                    <div class="oc-search-input-container">
                        <input class="oc-search-input" type="text" value="<?php echo $_GET['search'] ?>"
                               placeholder="Zoek in alle <?php echo $count ?> occasions" name="search" id="search">
                        <a class="oc-search-input-clear" href="<?= get_post_type_archive_link('occasion'); ?>">X</a>
                    </div>
                    <input type="hidden" value="occasion" name="type" >
                    <button class="oc-search">Zoeken</button>
                </div>
<!--            </form>-->
    <div class="row" id="products">



        <?php /*while ( $wpQuery_new->have_posts() ) : $wpQuery_new->the_post(); ?>
            <?php get_template_part('template-parts/occassions', 'overview'); ?>
        <?php endwhile;*/ ?>
        <div class="occasions_loader_wrapper">
            <source media="(min-width: 576px)" srcset="<?php echo wp_upload_dir()['url'] . '/loader.gif' ?>">
            <img class="occasions_loader" src="<?php echo wp_upload_dir()['url'] . '/loader.gif' ?>" alt="" style=" width: 45px; ">
        </div>
    <?php //the_posts_pagination(); ?>
<?php endif; ?>

    </div>
    </div>
    </div>
</section>

<?php
get_footer();
