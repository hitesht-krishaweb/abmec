<?php get_header(); ?>

<?php //if (have_posts()): ?>
    <section class="section">
        <div class="breadcrumbs">
            <div class="container">
                <?php custom_breadcrumbs(); ?>
            </div>
        </div>

        <article>
            <div class="container">
                <div class="row">
                    <?php if ($_GET['type'] == 'occasion') : ?>


                    <?php
                    $args = [
                        'posts_per_page' => 100,
                        'post_type' => 'occasion',
                        's' => $_GET['s']
                    ];

                    $allsearch = new WP_Query($args);

                    if (!$allsearch->have_posts()) {
                        //$allsearch = null;
                        $args2 = array(
                            'post_type' => 'occasion',
                            'posts_per_page' => 100,
                            'meta_query' => array(
                                array(
                                    'value' => $_GET['s'],
                                    'key' => 'art_code',
                                    'compare' => 'LIKE'

                            )
                            ));
                        wp_reset_query();
                        wp_reset_postdata();
                        $allsearch = new WP_Query($args2);
                    }

                    $allsearch->set('posts_per_page', -1);
                    // echo $allsearch->found_posts > 1 ? $allsearch->found_posts . ' resultaten' : $allsearch->found_posts . ' resultaat.';
                    ?>

                    <div class="d-lg-block col-lg-3 col-xl-2" data-module-filter-filters>
                        <?php
                        //        wp_nav_menu( [ 'menu' => 'Occasion categorie menu (prog)' ] );
                        the_occasion_filters();
                        ?>
                        <script type="text/javascript">
                            jQuery(document).ready(function () {


                                jQuery('#filter').submit(filter_form);
                                jQuery("#filter select, input").on("change", filter_form);

                                function filter_form() {
                                    var filter = jQuery('#filter');


                                    jQuery.ajax({
//                                url:filter.attr('action'),

                                        url: "<?php echo site_url() ?>/wp-admin/admin-ajax.php",
                                        data: filter.serialize(), // form data
                                        type: filter.attr('method'), // POST
                                        beforeSend: function (xhr) {
                                            filter.find('button').text('Processing...'); // changing the button label
                                        },
                                        success: function (data) {
                                            filter.find('button').text('Apply filter'); // changing the button label back
                                            jQuery('#products').html(data); // insert data
                                        }
                                    });
                                    return false;


                                }
                            });


                        </script>

                    </div>
                    <div class="col-lg-9 col-xl-10">
                        <style>

                            .oc-search-input-container {
                                position: relative;
                                width: 100%;
                            }

                            .oc-search-input-clear {
                                position: absolute;
                                width: 25px;
                                height: 25px;
                                text-align: center;
                                right: 10px;
                                top: 15px;
                                cursor: pointer;
                                color: #666;
                            }

                            .oc-search-input-clear:active, .oc-search-input-clear:visited, .oc-search-input-clear:hover {
                                color: #666;
                            }

                            input.oc-search-input {
                                height: 3rem;
                                background: #ededed;
                                border: 0;
                            }

                            input.oc-search-input::placeholder {
                                color: #007a3d;
                                font-style: italic;
                            }

                            .oc-search {
                                background: #ffe100;
                                font-size: 14px;
                                padding: 0 20px;
                                text-transform: uppercase;
                                color: #007a3d;
                                font-weight: bold;
                            }

                            .form-inline {
                                display: flex;
                                margin-bottom: 14px;
                            }

                        </style>
                        <?php
                        $wpQuery = new WP_Query(['post_type' => 'occasion']);
                        $count = $wpQuery->found_posts;

                        ?>


                        <form method="get" action="<?php echo home_url('/'); ?>">
                            <div class="form-inline">
                                <div class="oc-search-input-container">
                                    <input class="oc-search-input" type="text" value="<?php the_search_query(); ?>"
                                       placeholder="Zoek in onze <?php echo $count ?> occasions..." name="s" id="s">
                                    <a class="oc-search-input-clear" href="<?= get_post_type_archive_link('occasion'); ?>">X</a>
                                </div>
                                <input type="hidden" value="occasion" name="type">
                                <button class="oc-search">Zoeken</button>
                            </div>
                        </form>

                        <div class="row" id="products">
                            <?php while ($allsearch->have_posts()): $allsearch->the_post(); ?>
                                <?php get_template_part('template-parts/occassions', 'overview'); ?>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php else: ?>

                <?php $args = [
                    'posts_per_page' => 100,
                    'post_type' => array('vestiging', 'page', 'post'),
                    's' => $_GET['s']
                ]; ?>

                <?php $normalQuery = new WP_Query($args); ?>

                <?php if ($normalQuery->have_posts()): ?>
                    <ul>
                        <?php while ($normalQuery->have_posts()): $normalQuery->the_post(); ?>
                            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                            <?php the_excerpt(); ?>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>
            <?php endif; ?>
        </article>
    </section>
<?php //endif; ?>
<?php
get_footer();
