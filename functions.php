<?php
/**
 * Created by: Ken van der Eerden
 * Date: 24/09/2019
 * Time: 14:50
 */

@ini_set( 'upload_max_size' , '640M' );
@ini_set( 'post_max_size', '640m');

require_once(get_theme_file_path('/src/Lib/Autoload.php'));
require_once(get_theme_file_path('/functions/filters.php'));
require_once(get_theme_file_path('/functions/loadmore.php'));
require_once(get_theme_file_path('/functions/breadcrumbs.php'));

$theme = new Custom_Theme\Autoload;
$theme->register();
$theme->add_namespace('Custom_Theme', get_template_directory() . '/src/Lib');


add_action('after_setup_theme', 'register_custom_nav_menus');
function register_custom_nav_menus()
{
    register_nav_menus(array(
        'top_menu' => 'Top Menu',
        'main_menu' => 'Main Menu',
        'quick_links' => 'Quick Menu',
        'footer_menu' => 'Footer Menu',
        'footer_bottom_menu' => 'Footer Bottom Menu'
    ));
}

$menuLocations = get_nav_menu_locations();

function getMenuItems( $menu_name ) {
    $menu_items  = array();
    $previous_id = 0;
    foreach ( wp_get_nav_menu_items( $menu_name ) as $item ) {
        if ( $item->menu_item_parent == 0 ) {
            // Parent item
            array_push(
                $menu_items,
                array(
                    'title'     => $item->title,
                    'link'      => $item->url,
                    'children'  => getMenuChildren($item->ID),
                    'css_class' => get_field( 'menu_item_class', $item ),
                )
            );
            $previous_id = $item->ID;
        }
    }
    return $menu_items;
}

function getMenuChildren($parent_id) {
    $children = array();
    foreach (wp_get_nav_menu_items( 'Hoofdmenu' ) as $item) {
        if ($item->menu_item_parent == $parent_id) {
            // Child item
            $child = array(
                'title' => $item->title,
                'link'  => $item->url,
                'children' => getMenuChildren($item->ID),
            );
            array_push($children, $child);
        }
    }
    return $children;
}

add_theme_support('post-thumbnails');

function getThemeUrl()
{
    return get_template_directory_uri();
}

///
/// Setup Wordpress
///

register_post_type('occasion', [
    'labels' => [
        'name' => 'Occasion',
        'singular_name' => 'Occasion',
        'menu_name' => 'Occasions',
    ],
    'public' => true,
    'publicly_queryable' => true,
    'menu_icon' => 'dashicons-cart',
    'has_archive' => true,
    'rewrite' => ['slug' => 'occasions'],
    // see https://codex.wordpress.org/Function_Reference/register_post_type#supports
    'supports' => [
        'title',
        'editor',
        'thumbnail',
        'custom-fields'
    ],
]);

register_taxonomy('occasion-categorie', ['occasion'], [
    'hierarchical' => true,
    'labels' => [
        'singular_name' => 'Occasion categorie',
        'name' => 'Occasion categorieën',
        'menu_name' => 'Occasion categorieën',
    ],
    'show_ui' => true,
    'show_admin_column' => true,
    'rewrite' => ['slug' => 'occasion-categorie'],
]);

register_taxonomy('merk', ['occasion'], [
    'hierarchical' => true,
    'labels' => [
        'singular_name' => 'Merk',
        'name' => 'Merk',
        'menu_name' => 'Merk',
    ],
    'show_ui' => true,
    'show_admin_column' => true,
    'rewrite' => ['slug' => 'merk'],
]);

register_post_type('vestiging', [
    'labels' => [
        'name' => 'Vestigingen',
        'singular_name' => 'Vestiging',
        'menu_name' => 'Vestigingen',
        'add_new_item' => 'Vestiging toevoegen',
        'add_new' => 'Vestiging toevoegen'
    ],
    'public' => true,
    'publicly_queryable' => true,
    'menu_icon' => 'dashicons-store',
    'has_archive' => false,
    'rewrite' => ['slug' => 'vestigingen'],
    // see https://codex.wordpress.org/Function_Reference/register_post_type#supports
    'supports' => [
        'title',
        'custom-fields'
    ],
]);

register_taxonomy('vestigingen', ['vestiging'], [
    'hierarchical' => 'true',
    'labels' => [
        'singular_name' => 'Vestiging',
        'name' => 'Vestigingen',
        'menu_name' => 'Vestigingen'
    ],
    'show_ui' => true,
    'show_admin_column' => true,
    'rewrite' => ['slug' => 'vestigingen']


]);


register_post_type('agenda', [
    'labels' => [
        'name' => 'Agenda',
        'singular_name' => 'Agenda',
        'menu_name' => 'Agendas',
    ],
    'public' => true,
    'publicly_queryable' => true,
    'menu_icon' => 'dashicons-image-filter',
    'has_archive' => true,
    'rewrite' => ['slug' => 'agendas'],
    'supports' => [
        'title',
        'editor',
        'thumbnail',
        'custom-fields'
    ],
]);

///
/// Setup Queries
///

add_filter('pre_get_posts', function ($query) {
    if (is_admin() || !$query->is_main_query())
        return $query;

    //TODO fix, does not work
    if (!empty($_POST['post-filters']['date'])) {
        $getPostsAfter = [
            'today' => strtotime('today'),
            'yesterday' => strtotime('-1 day'),
            'one-week' => strtotime('-1 week'),
            'all' => 0,
        ][$_POST['post-filters']['date']];

        $query->set('date_query', [
            [
                'year' => date('Y', $getPostsAfter),
                'month' => date('m', $getPostsAfter),
                'day' => date('d', $getPostsAfter),
                'compare' => '>=',
            ]
        ]);

        echo '<!--' . __FILE__ . '--><pre>' . basename(__FILE__) . ':' . __LINE__ . PHP_EOL;
        var_dump($getPostsAfter, date('Y-m-d', $getPostsAfter), $query->get('date_query'));
        echo '</pre>';
    }
    if (!empty($_POST['meta-filters'])) {
        $metaQuery = [];
        // input looks like <input name="meta-filter[prijsexcl][NUMERIC][>=]" />
        foreach ($_POST['meta-filters'] as $metaKey => $metaFilter) {
            foreach ($metaFilter as $type => $compares) {
                foreach ($compares as $compare => $value) {
                    if ($value === '') continue;
                    // see https://codex.wordpress.org/Class_Reference/WP_Meta_Query
                    $metaQuery[] = [
                        'key' => $metaKey,
                        'type' => $type,
                        'compare' => $compare,
                        'value' => $value,
                    ];
                }
            }
        }
        $query->set('meta_query', $metaQuery);
    }

    return $query;
});


if ($_GET['doSync1'] ?? false) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    sync_categories();
    echo 'done';
    exit;
}
if ($_GET['doSync2'] ?? false) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    sync_occasions();
    echo 'done';
    exit;
}


///
/// Setup Shortcodes
///

function the_occasion_filters()
{
    global $wpdb;

    //global $wp_query;
    //$wp_query->posts
    //$post_ids = wp_list_pluck( $latest->posts, 'ID' );

    $metaFilters = [
        'prijsexcl' => 'minmax',
        'draaiuren' => 'minmax',
        'bouwjaar' => 'minmax',
        'contact_filiaal' => 'dropdown'
    ];
    ?>

    <script>
        function hideFilters() {
            var form = document.getElementById('filter');
            if (form.style.display === "block") {
                form.style.display = "none";
            } else {
                form.style.display = "block";
            }
        }

    </script>

    <style>
        @media (max-width: 540px) {
            #filter {
                display: none;
            }
        }

        @media (min-width: 540px) {
            #filter {
                display: block;
            }
        }
    </style>
    <div class="d-lg-none" style="margin-bottom: 1rem;">
        <button class="button" onclick="hideFilters()">Filters</button>
    </div>


    <form action="" id="filter" method="get">
        <?php
        /** @var array $occasionCategorieStructuur */
        require 'occasion-categorie-structuur.php';
        ?>

        <?php $cats = array_keys($occasionCategorieStructuur) ?>

        <script>
            //Store country as a javascript object
            var countries = <?php echo json_encode($occasionCategorieStructuur); ?>;
            var states = [];

            jQuery(document).ready(function ($) {
                var country_val = undefined;
                $('select[name="spec1"]').hide();
                $('select[name="spec2"]').hide();



                function mainCategoryChange(self) {
                    $('select[name="spec1"]').hide();
                    $('select[name="spec1"]').prop('selectedIndex', 0);
                    $('select[name="spec2"]').hide();
                    $('select[name="spec2"]').prop('selectedIndex', 0);


                    country_val = $(self).val();

                    if ((countries[country_val] && countries[country_val].length > 0) || $.isPlainObject(countries[country_val])) {
                        $('select[name="spec1"]').show();
                        //var options = '<option value="<?php //$_GET['spec1'] ?>//">--- Maak een keuze ---</option>';
                        var options = '<option value="">--- Maak een keuze ---</option>';
                        for (var i in countries[country_val]) {
                            var state;
                            if ( isNaN(parseInt(i)) )  {
                                state = i;
                            } else {
                                state = countries[country_val][i];
                            }
                            states += state + ',';
                            //var res = state.split(',');
                            if (!$.isArray(state)) {
                                options += '<option class="spec1_value" value="' + state + '"' + (state == "<?= htmlentities($_GET['spec1']) ?>" ? ' selected' : '') + '>' + state + '</option>';
                            }

                        }
                    }
                    $('select[name="spec1"]').html(options);
                    }

                $('select[name="spec1"]').change(function() {
                    $('select#merk option:first-child').attr('selected','selected');

                    $('.spec2_value').remove();
                    $('select[name="spec2"]').hide();

                    var spec1 = $('select[name="spec1"]').val();

                    if ($.isArray(countries[country_val][spec1])) {
                        $('select[name="spec2"]').show();
                        var options = '<option value="">--- Maak een keuze ---</option>';
                        var res = countries[country_val][spec1];
                        for (var item in res) {
                            options += '<option class="spec2_value" value = "' + res[item] + '"' + (res[item] == "<?= htmlentities($_GET['spec2']) ?>" ? ' selected' : '') + '>' + res[item] + '</option>';
                        }

                        $('select[name="spec2"]').html(options);
                    }
                });

                $('select[name="main-category"]').change(function () {
                    $('select#merk option:first-child').attr('selected','selected');
                    
                    mainCategoryChange(this);
                });

                if($('select[name="main-category"]').val() != '') {
                    mainCategoryChange($('select[name="main-category"]')[0]);
                }


            });
        </script>

        <!--First Dropdown-->

        <div class="filter__group">
            <h3 class="filter__group__title">Categorie</h3>
            <div class="filter__group__content">
                <div class="form__group">
                    <div class="country">


                        <select name="main-category">
                            <option value="">--- Maak een keuze ---</option>
                            <?php foreach ($cats as $category): ?>
                                <option value="<?php echo htmlentities($category); ?>"<?= $category == $_GET['main-category'] ? ' selected' : '' ?>><?php echo htmlentities($category) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <!-- <div class="pp-arrow">►</div> -->
                    </div>
                    <!--Second Dropdown-->
                    <div class="states">
                        <select name="spec1">
                            <option value="<?php echo htmlentities($_GET['spec1']) ?>">--- Maak een keuze ---</option>
                        </select>
                        <div class="pp-arrow">►</div>
                    </div>

                    <div class="spec2">
                        <select name="spec2">
                            <option value="<?php echo htmlentities($_GET['spec2']) ?>">--- Maak een keuze ---</option>
                        </select>
                        <div class="pp-arrow">►</div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $merk_term = get_terms(array('taxonomy' => 'merk','hide_empty' => false));
        /*echo "<pre>";
        print_r($merk_term);
        echo "</pre>";*/
        ?>
        <div class="form__group">
            <h3 class="filter__group__title">Merk</h3>
            <div class="filter__group__content">
                <select name="merk" id="merk">
                    <option value="">--- Maak een keuze ---</option>
                    <?php foreach ($merk_term as $option) { ?>
                        <option value="<?=htmlentities($option->name) ?>" <?=($_GET['merk'] ?? false) == $option->name ? 'selected' : '' ?> ><?= htmlentities($option->name) ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        

        <?php foreach ($metaFilters as $filterName => $filterType) {
            switch ($filterType) {
                case 'minmax':
                {
                    //TODO only options for posts from currently filtered
                    $minmax = $wpdb->get_row(
                        "SELECT MIN(`casted_value`) AS 'min', MAX(`casted_value`) AS 'max' FROM ("
                        . "SELECT CAST( `meta_value` AS DECIMAL(9,2) ) AS 'casted_value' "
                        . "FROM `wp_postmeta` WHERE `meta_key` = '$filterName'"
                        . ") q"
                    );


                    // see https://codex.wordpress.org/Class_Reference/WP_Meta_Query
                    $postedMin = $_POST['meta-filters'][$filterName]['NUMERIC']['>='] ?? null;
                    $postedMax = $_POST['meta-filters'][$filterName]['NUMERIC']['<='] ?? null;
                    ?>

                    <?php if ($filterName == 'bouwjaar' || $filterName == 'draaiuren'): ?>

                    <?php $options = $wpdb->get_col(
                        "SELECT `meta_value` FROM `wp_postmeta` WHERE `meta_key` = '$filterName' GROUP BY `meta_value` ORDER BY `meta_value`"
                    ); ?>

                    <?php sort($options); ?>
                    <div class="filter__group">
                        <h3 class="filter__group__title"><?php echo ucwords($filterName) ?></h3>
                        <div class="filter__group__content">
                            <div class="form__group">

                                <label for="<?= $filterName ?>Min">Van</label>
                                <select name="<?= $filterName ?>Min"
                                        id="<?= $filterName ?>Min" value="12">
                                    <option value="">Van</option>
                                    <?php foreach ($options as $option): ?>
                                        <option value="<?= $option ?>" <?=($_GET["{$filterName}Min"] ?? false) == $option ? 'selected' : '';?>><?= $option ?></option>
                                    <?php endforeach; ?>
                                </select>

                            </div>
                            <div class="form__group">
                                <label for="<?= $filterName ?>Max">Tot</label>
                                <select name="<?= $filterName ?>Max"
                                        id="<?= $filterName ?>Max">
                                    <option value="">Tot</option>
                                    <?php $options = array_reverse($options); ?>
                                    <?php foreach ($options as $option): ?>
                                        <option value="<?= $option ?>" <?=($_GET["{$filterName}Max"] ?? false) == $option ? 'selected' : '';?>><?= $option ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                <?php elseif ($filterName == 'prijsexcl'): ?>
                    <div class="filter__group">
                        <h3 class="filter__group__title">Prijs</h3>
                        <div class="filter__group__content">
                            <div class="form__group">
                                <?php
                                $steps = [];

                                for ($step = 0; $step <= $minmax->max; $step += 1000) {
                                    $steps[] = $step;
                                }
                                ?>
                                <label for="prijsmin">Van</label>
                                <select name="prijsmin"
                                        id="prijsmin">
                                    <option value="">Van</option>
                                    <?php foreach ($steps as $step): ?>
                                        <option value="<?= $step ?>" <?=($_GET['prijsmin'] ?? false) == $step ? 'selected' : '';?>>&euro; <?= $step ?></option>
                                    <?php endforeach; ?>
                                </select>

                            </div>
                            <div class="form__group data-collapsed">
                                <label for="prijsmax">Tot</label>
                                <select name="prijsmax"
                                        id="prijsmax">
                                    <?php $steps = array_reverse($steps); ?>
                                    <option value="">Tot</option>
                                    <?php foreach ($steps as $step): ?>
                                        <option value="<?= $step ?>" <?=($_GET['prijsmax'] ?? false) == $step ? 'selected' : ''?>>&euro; <?= $step ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                    <?php break;
                }
                case 'dropdown':
                {
                    //TODO only options for posts from currently filtered
                    $options = $wpdb->get_col(
                        "SELECT `meta_value` FROM `wp_postmeta` WHERE `meta_key` = '$filterName' GROUP BY `meta_value` ORDER BY `meta_value`"
                    );
                    // see https://codex.wordpress.org/Class_Reference/WP_Meta_Query
                    ?>
                    <div class="form__group">
                        <h3 class="filter__group__title">Filiaal</h3>
                        <div class="filter__group__content">
                            <select name="filiaal" id="filiaal">
                                <option value="">--- Maak een keuze ---</option>
                                <?php foreach ($options as $option) { ?>
                                    <option value="<?= $option ?>" <?= ($_GET['filiaal'] ?? false) == $option ? 'selected' : '' ?> ><?= htmlentities($option) ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <?php break;
                }
            }
        } ?>
        <div class="filter__group">
            <h3 class="filter__group__title">Aangeboden sinds</h3>
            <div class="filter__group__content">
                <div class="form__group">


                    <label class="radio">Vandaag<input type="radio" class="radio__input" name="post-filters[date]"
                                                       value="today" <?= ($_GET['post-filters']['date'] ?? false) === 'today' ? 'checked' : '' ?>>
                        <span class="radio__indicator"></span>
                    </label>
                    <label class="radio">Gisteren<input type="radio" class="radio__input" name="post-filters[date]"
                                                        value="yesterday" <?= ($_GET['post-filters']['date'] ?? false) === 'yesterday' ? 'checked' : '' ?>>
                        <span class="radio__indicator"></span>
                    </label>
                    <label class="radio">Een week<input type="radio" class="radio__input" name="post-filters[date]"
                                                        value="one-week" <?= ($_GET['post-filters']['date'] ?? false) === 'one-week' ? 'checked' : '' ?>>
                        <span class="radio__indicator"></span>
                    </label>
                    <label class="radio">Altijd<input type="radio" class="radio__input" name="post-filters[date]"
                                                      value="all" <?= ($_GET['post-filters']['date'] ?? false) === 'all' ? 'checked' : '' ?>>
                        <span class="radio__indicator"></span>
                    </label>

                </div>
            </div>
        </div>



        <input type="hidden" name="search" value="<?php echo $_GET['search'] ?>" id="occ_search">
        <input type="hidden" name="action" value="myfilter">
    </form>
<?php }

///
/// Setup Sync
///

/**
 * @param string $termName
 * @param int $parentTermId
 * @return array
 */
function insertOrUpdateTerm($termName, $parentTermId = 0)
{
    $term = get_terms(array(
        'taxonomy' => 'occasion-categorie',
        'hide_empty' => false, // we have to add this for terms
        'name' => $termName,
        'number' => 1,
    ));
    $termProperties = array(
        'term_id' => $term[0]->term_id ?? null,
        'name' => $termName,
        'parent' => $parentTermId
    );

    // disabled because of php version incompatibility
    // list(
    //     'term_id' => $termProperties['term_id'],
    //     'term_taxonomy_id' => $termProperties['term_taxonomy_id']
    //     ) =
    $temp = $termProperties['term_id'] ?
        // update and insert return array like array('term_id '=> 12, 'term_taxonomy_id' => 34 )
        wp_update_term($termProperties['term_id'], 'occasion-categorie', $termProperties) :
        wp_insert_term($termName, 'occasion-categorie', $termProperties);

    // php version incompatibility fix?
    $termProperties['term_id'] = $temp['term_id'];
    $termProperties['term_taxonomy_id'] = $temp['term_taxonomy_id'];

    return $termProperties;
}

/**
 * @param string $termName
 * @param int $parentTermId
 * @return array
 */
function insertOrUpdatemerk($termName, $parentTermId = 0)
{
    $term = get_terms(array(
        'taxonomy' => 'merk',
        'hide_empty' => false, // we have to add this for terms
        'name' => $termName,
        'number' => 1,
    ));
    /*print_r($termName);
    print_r($term);
    exit();*/
    $termProperties = array(
        'term_id' => $term[0]->term_id ?? null,
        'name' => $termName,
        'parent' => $parentTermId
    );

    // disabled because of php version incompatibility
    // list(
    //     'term_id' => $termProperties['term_id'],
    //     'term_taxonomy_id' => $termProperties['term_taxonomy_id']
    //     ) =
    $temp = $termProperties['term_id'] ?
        // update and insert return array like array('term_id '=> 12, 'term_taxonomy_id' => 34 )
        wp_update_term($termProperties['term_id'], 'merk', $termProperties) :
        wp_insert_term($termName, 'merk', $termProperties);

    // php version incompatibility fix?
    $termProperties['term_id'] = $temp['term_id'];
    $termProperties['term_taxonomy_id'] = $temp['term_taxonomy_id'];

    return $termProperties;
}


function sync_categories()
{
    // to prevent simultaneous execution
    if($GLOBALS['doingCatSync'] ?? false) return;
    $GLOBALS['doingCatSync'] = true;

    set_time_limit(300);

    /** @var array $occasionCategorieStructuur */
    require 'occasion-categorie-structuur.php';

    $menuName = 'Occasion categorie menu (prog)';
    // if menu already exists, delete and start over
    if ($menuTerm = wp_get_nav_menu_object($menuName)) {
        wp_delete_nav_menu($menuTerm);
    }
    $menuId = wp_create_nav_menu($menuName);

    $termIdsToMenuItemIds = [];
    $setHierarchy = function ($parent, $children) use ($menuId, & $termIdsToMenuItemIds, & $setHierarchy) {
        foreach ($children as $newParent => $child) {

            // current item has children
            if (is_string($newParent)) {
                $setHierarchy($newParent, $child);
                $child = $newParent;
            }

            // on first call there is no parent
            if ($parent) {
                $parentCat = insertOrUpdateTerm($parent);
                if (!isset($termIdsToMenuItemIds[$parent])) {
                    $termIdsToMenuItemIds[$parent] = wp_update_nav_menu_item($menuId, 0, array(
                        'menu-item-title' => $parent,
                        'menu-item-type' => 'taxonomy',
                        'menu-item-object' => 'occasion-categorie',
                        'menu-item-object-id' => $parentCat['term_id'],
                        'menu-item-status' => 'publish'
                    ));
                }
            }

            $childCat = insertOrUpdateTerm($child, $parentCat['term_id'] ?? 0);
            // parent is set in above if statement if there is a parent (not on first call)
            $parentMenuItemId = $termIdsToMenuItemIds[$parent] ?? 0;
            // child could already have been created as being a parent because $setHierarchy() is called above
            $childMenuItemId = $termIdsToMenuItemIds[$child] ?? 0;
            $termIdsToMenuItemIds[$child] = wp_update_nav_menu_item($menuId, $childMenuItemId, array(
                'menu-item-parent-id' => $parentMenuItemId,
                'menu-item-title' => $child,
                'menu-item-type' => 'taxonomy',
                'menu-item-object' => 'occasion-categorie',
                'menu-item-object-id' => $childCat['term_id'],
                'menu-item-status' => 'publish'
            ));
        }
    };
    $setHierarchy(null, $occasionCategorieStructuur);

    //foreach ( $occasionCategorieStructuur as $mainCat => $subCats ) {
    //    // is main cat without children, no need to add structure to categories
    //    if ( is_int( $mainCat ) ) continue;
    //    $setHierarchy( $mainCat, $subCats );
    //}

    $GLOBALS['doingCatSync'] = false;
}

add_action('init', 'sync_images_init');

function sync_images_init() {
    global $wpdb;

    if (!isset($_GET['sync_images']) && $_GET['sync_images'] == '') {
        return;
    }


    $currentImages = scandir('_occasions/img');
    
    $occasions = $wpdb->get_results("SELECT ID FROM $wpdb->posts WHERE post_type = 'occasion'", ARRAY_A);
    // echo "<pre>";
    // print_r($currentImages);
    // echo "</pre>";
    $imageList = [];

    foreach($occasions as $occasion) {
        $images = explode('|', get_post_meta($occasion['ID'], 'IMG')[0]);
        // print_r($images);
        foreach($images as $image) {
            if ($image !== '') {
                array_push($imageList, $image);
            }
        }
    }
    
    foreach($currentImages as $image) {
        $key = array_search($image, $imageList);
        if ($key === false && $image !== '.' && $image !== '..') {
            rename("_occasions/img/$image", "_occasions_archive/$image");
            print_r("Not found $image");
            echo "<br />";
        }
    }
    
    
// echo "Second";
//     echo "<pre>";
//     print_r($imageList);
//     echo "</pre>";
    exit();
    return;
}


add_action('init', 'sync_occasions_init');

function sync_occasions_init()
{
    if (!isset($_GET['import_occasions']) && $_GET['import_occasions'] == '') {
        return;
    }

    // to prevent simultaneous execution
    if ($GLOBALS['doingOccSync'] ?? false) return;
    $GLOBALS['doingOccSync'] = true;

    ///
    /// ATTENTION: Make sure to disable the query monitor plugin,
    /// see https://wordpress.stackexchange.com/a/175791/127704
    ///

    set_time_limit(300);

    global $wpdb;

    $handledPostIds = array();

    //$xml = new SimpleXMLElement('https://occasions.abemec.nl/OccasionAppData/occasionappdata.xml', 0, true);

    // $file = 'https://abemec.nl/data.xml';
    $file = 'https://www.abemec.nl/_occasions/data/data.xml';

    //echo 'starting. <pre>' . PHP_EOL;

    // using XMLReader because the XML is too large and otherwise causes memory overflow.
    $xmlReader = new XMLReader();
    $s = $xmlReader->open($file);
    if ( ! $s ) return;

    $afbeeldingenDict = [];
    $artCodeIdDict = [];

    $xmlReader->read();

    while($xmlReader->name != 'device') { $xmlReader->read(); }
    while($xmlReader->name == 'device') {
        // while($xmlReader->name == 'device') {
            $xmlArticle = new SimpleXMLElement($xmlReader->readOuterXml());


            /*echo "<pre>";
            print_r($xmlArticle);
            echo "</pre>";*/

            //echo 'grabbing WHERE post_name = \'' . sanitize_title_for_query((string)$xmlArticle->art_code) . '\'. ' . PHP_EOL;
            // when casting a SimpleXMLElement to string its (string) value is returned, see https://php.net/simplexmlelement.tostring
            $product = $wpdb->get_row(
                "SELECT ID FROM $wpdb->posts WHERE post_name = '" . sanitize_title_for_query((string)$xmlArticle->art_code) . "'"
            );
            $productProperties = array(
                'ID' => $product->ID ?? null,
                'post_type' => 'occasion',
                'post_name' => (string)$xmlArticle->art_code,
                'post_title' => (string)$xmlArticle->naam,
                'post_status' => 'publish'
            );

            //echo 'updating post_id (' . $productProperties['ID'] . '). ' . PHP_EOL;
            $productProperties['ID'] = $productProperties['ID'] ?
                wp_update_post($productProperties) :
                wp_insert_post($productProperties);
            //echo 'updated post_id (' . $productProperties['ID'] . '). ' . PHP_EOL;
            // using this array to trash occasions that are sold (no longer in xml)
            $handledPostIds[] = (int)$productProperties['ID'];

            // $xmlPropValue is a SimpleXMLElement so be sure to cast to string when retrieving value
            
            $xmlArticl_array = (array)$xmlArticle;
            $all_meta = get_post_meta( $productProperties['ID']);

    /*file_put_contents(__DIR__ . '/cron.log', get_the_title( $productProperties['ID'] )." Start Log" . "\r\n", FILE_APPEND);
    file_put_contents(__DIR__ . '/cron.log', print_r($all_meta, true) . "\r\n", FILE_APPEND);*/



            foreach ($all_meta as $key => $value) {
                $final_key[] = $key;
            }
            foreach ($xmlArticl_array as $key => $value) {
                $final_xml_key[] = $key; 
            }

            $arr_1 = array_diff($final_key, $final_xml_key);

            foreach ($arr_1 as $value) {
                delete_post_meta_by_key( $value);
                delete_post_meta( $productProperties['ID'], $value, get_post_meta( $productProperties['ID'], $value, true ));
            }
            $arr_1 = array();
            $final_key = array();
            $final_xml_key = array();

            update_post_meta($productProperties['ID'], 'top', '');

            foreach ($xmlArticle as $xmlPropName => $xmlPropValue) {

                if ($xmlPropName == 'art_code') {
                    $artCodeIdDict[(string) $xmlPropValue] = $productProperties['ID'];
                    update_post_meta($productProperties['ID'], $xmlPropName, (string)$xmlPropValue);
                    
                    //echo 'handling props ' . (string) $xmlPropValue . ' (' . $productProperties['ID'] . '). ' . PHP_EOL;
                }else if ($xmlPropName == 'merk') {
                    update_post_meta($productProperties['ID'], $xmlPropName, (string)$xmlPropValue);
                    $MerkProperties = insertOrUpdatemerk((string)$xmlPropValue);
                    wp_set_object_terms($productProperties['ID'], $MerkProperties['term_id'], 'merk');
                    //continue;
                }else if ($xmlPropName == 'prijsexcl') {
                    //$value = (float)$xmlPropValue;
                    update_post_meta($productProperties['ID'], $xmlPropName, (string)$xmlPropValue);
                    continue;
                }else if ($xmlPropName == 'categorie') {
                    update_post_meta($productProperties['ID'], $xmlPropName, (string)$xmlPropValue);
                    $termProperties = insertOrUpdateTerm((string)$xmlPropValue);
                    // intentionally setting optional $append parameter to false because there only is 1 cat per occasion
                    wp_set_object_terms($productProperties['ID'], $termProperties['term_id'], 'occasion-categorie');
                    //echo 'linked to term ' . (string)$xmlPropValue . ' (' . $termProperties['term_id'] . '). ' . PHP_EOL;
                }else{
                    update_post_meta($productProperties['ID'], $xmlPropName, (string)$xmlPropValue);
                }


                // let op, om de menustructuur te kunnen opbouwen is het ook mogelijk dat er
                // categorieën handmatig worden toegevoegd (synced cats niet bewerkt vanwege search by name ↓) in de cms.
                // de handmatige categorieën moeten gesuffixd worden met ' -', omdat de naam niet gelijk
                // mag zijn aan de naam van een van de gesyncte categorieën
                //echo 'grabbing term ' . (string)$xmlPropValue . '. ' . PHP_EOL;

            }
            $end_meta = get_post_meta( $productProperties['ID']);

            /*file_put_contents(__DIR__ . '/cron.log', print_r($end_meta, true) . "\r\n", FILE_APPEND);
            file_put_contents(__DIR__ . '/cron.log', get_the_title( $productProperties['ID'] )." End Log" . "\r\n", FILE_APPEND);*/

            $xmlReader->next('device');
            unset($xmlArticle);
        //}
    }

    //echo 'looped articles. ' . PHP_EOL;

    if ($handledPostIds) {
        $wpdb->get_row("UPDATE $wpdb->posts SET `post_status` = 'trash' WHERE `post_type` = 'occasion' AND `ID` NOT IN(" . implode(',', $handledPostIds) . ")");
    }

    $xmlReader->close();
    $GLOBALS['doingOccSync'] = false;
}

// function sync_occasions()
// {
//     /*$to = 'dev@euforie.design';
//     $subject = 'Cron execution start';
//     $body = 'Cron execution start time'.date("Y-m-d h:i:sa");
//     $headers = array('Content-Type: text/html; charset=UTF-8');
     
//     wp_mail( $to, $subject, $body, $headers );*/

//     // to prevent simultaneous execution
//     if ($GLOBALS['doingOccSync'] ?? false) return;
//     $GLOBALS['doingOccSync'] = true;

//     ///
//     /// ATTENTION: Make sure to disable the query monitor plugin,
//     /// see https://wordpress.stackexchange.com/a/175791/127704
//     ///

//     set_time_limit(300);

//     global $wpdb;

//     $handledPostIds = array();

//     //$xml = new SimpleXMLElement('https://occasions.abemec.nl/OccasionAppData/occasionappdata.xml', 0, true);

//     // $file = 'https://abemec.nl/data.xml';
//     $file = 'https://www.abemec.nl/_occasions/data/data.xml';

//     //echo 'starting. <pre>' . PHP_EOL;

//     // using XMLReader because the XML is too large and otherwise causes memory overflow.
//     $xmlReader = new XMLReader();
//     $s = $xmlReader->open($file);
//     if ( ! $s ) return;

//     $afbeeldingenDict = [];
//     $artCodeIdDict = [];

//     $xmlReader->read();

//     while($xmlReader->name != 'device') { $xmlReader->read(); }
//     while($xmlReader->name == 'device') {
//         // while($xmlReader->name == 'device') {
//             $xmlArticle = new SimpleXMLElement($xmlReader->readOuterXml());


//             /*echo "<pre>";
//             print_r($xmlArticle);
//             echo "</pre>";*/

//             //echo 'grabbing WHERE post_name = \'' . sanitize_title_for_query((string)$xmlArticle->art_code) . '\'. ' . PHP_EOL;
//             // when casting a SimpleXMLElement to string its (string) value is returned, see https://php.net/simplexmlelement.tostring
//             $product = $wpdb->get_row(
//                 "SELECT ID FROM $wpdb->posts WHERE post_name = '" . sanitize_title_for_query((string)$xmlArticle->art_code) . "'"
//             );
//             $productProperties = array(
//                 'ID' => $product->ID ?? null,
//                 'post_type' => 'occasion',
//                 'post_name' => (string)$xmlArticle->art_code,
//                 'post_title' => (string)$xmlArticle->naam,
//                 'post_status' => 'publish'
//             );

//             //echo 'updating post_id (' . $productProperties['ID'] . '). ' . PHP_EOL;
//             $productProperties['ID'] = $productProperties['ID'] ?
//                 wp_update_post($productProperties) :
//                 wp_insert_post($productProperties);
//             //echo 'updated post_id (' . $productProperties['ID'] . '). ' . PHP_EOL;
//             // using this array to trash occasions that are sold (no longer in xml)
//             $handledPostIds[] = (int)$productProperties['ID'];

//             // $xmlPropValue is a SimpleXMLElement so be sure to cast to string when retrieving value
            
//             $xmlArticl_array = (array)$xmlArticle;
//             $all_meta = get_post_meta($productProperties['ID']);

//            /* file_put_contents(__DIR__ . '/cron.log', get_the_title( $productProperties['ID'] )." Start Log" . "\r\n", FILE_APPEND);
//             file_put_contents(__DIR__ . '/cron.log', print_r($all_meta, true) . "\r\n", FILE_APPEND);*/

//             foreach ($all_meta as $key => $value) {
//                 $final_key[] = $key;
//             }
//             foreach ($xmlArticl_array as $key => $value) {
//                 $final_xml_key[] = $key; 
//             }

//             $arr_1 = array_diff($final_key, $final_xml_key);

//             foreach ($arr_1 as $value) {
//                 delete_post_meta_by_key( $value);
//                 delete_post_meta( $productProperties['ID'], $value, get_post_meta( $productProperties['ID'], $value, true ));
//             }
//             $arr_1 = array();
//             $final_key = array();
//             $final_xml_key = array();

//             update_post_meta($productProperties['ID'], 'top', '');

//             foreach ($xmlArticle as $xmlPropName => $xmlPropValue) {

//                 if ($xmlPropName == 'art_code') {
//                     $artCodeIdDict[(string) $xmlPropValue] = $productProperties['ID'];
//                     update_post_meta($productProperties['ID'], $xmlPropName, (string)$xmlPropValue);
                    
//                     //echo 'handling props ' . (string) $xmlPropValue . ' (' . $productProperties['ID'] . '). ' . PHP_EOL;
//                 }else if ($xmlPropName == 'merk') {
//                     update_post_meta($productProperties['ID'], $xmlPropName, (string)$xmlPropValue);
//                     $MerkProperties = insertOrUpdatemerk((string)$xmlPropValue);
//                     wp_set_object_terms($productProperties['ID'], $MerkProperties['term_id'], 'merk');
//                     //continue;
//                 }else if ($xmlPropName == 'prijsexcl') {
//                     //$value = (float)$xmlPropValue;
//                     update_post_meta($productProperties['ID'], $xmlPropName, (string)$xmlPropValue);
//                     continue;
//                 }else if ($xmlPropName == 'categorie') {
//                     update_post_meta($productProperties['ID'], $xmlPropName, (string)$xmlPropValue);
//                     $termProperties = insertOrUpdateTerm((string)$xmlPropValue);
//                     // intentionally setting optional $append parameter to false because there only is 1 cat per occasion
//                     wp_set_object_terms($productProperties['ID'], $termProperties['term_id'], 'occasion-categorie');
//                     //echo 'linked to term ' . (string)$xmlPropValue . ' (' . $termProperties['term_id'] . '). ' . PHP_EOL;
//                 }else{
//                     update_post_meta($productProperties['ID'], $xmlPropName, (string)$xmlPropValue);
//                 }


//                 // let op, om de menustructuur te kunnen opbouwen is het ook mogelijk dat er
//                 // categorieën handmatig worden toegevoegd (synced cats niet bewerkt vanwege search by name ↓) in de cms.
//                 // de handmatige categorieën moeten gesuffixd worden met ' -', omdat de naam niet gelijk
//                 // mag zijn aan de naam van een van de gesyncte categorieën
//                 //echo 'grabbing term ' . (string)$xmlPropValue . '. ' . PHP_EOL;

//             }
//             $end_meta = get_post_meta( $productProperties['ID']);

//             /*file_put_contents(__DIR__ . '/cron.log', print_r($end_meta, true) . "\r\n", FILE_APPEND);
//             file_put_contents(__DIR__ . '/cron.log', get_the_title( $productProperties['ID'] )." End Log" . "\r\n", FILE_APPEND);*/

//             $xmlReader->next('device');
//             unset($xmlArticle);
//         //}
//     }

//     //echo 'looped articles. ' . PHP_EOL;

//     if ($handledPostIds) {
//         $wpdb->get_row("UPDATE $wpdb->posts SET `post_status` = 'trash' WHERE `post_type` = 'occasion' AND `ID` NOT IN(" . implode(',', $handledPostIds) . ")");
//     }

//     $xmlReader->close();
//     $GLOBALS['doingOccSync'] = false;

//     /*$to = 'dev@euforie.design';
//     $subject = 'Cron execution end';
//     $body = 'Cron execution end time'.date("Y-m-d h:i:sa");
//     $headers = array('Content-Type: text/html; charset=UTF-8');
     
//     wp_mail( $to, $subject, $body, $headers );*/

// }


function formatPrice($price)
{
    return number_format($price, 2, ',', '.');
}

add_action('pre_get_posts', 'set_post_count_on_occasions');

function set_post_count_on_occasions($query)
{
    if (is_post_type_archive('occasion') && !is_admin() && !empty($query->query['post_type'] == 'occasion')) {
        $query->set('posts_per_page', '24');
        $query->set('orderby', 'title');
        $query->set('order', 'ASC');
    }

    if (is_tax('occasion-categorie')) {
        $query->set('posts_per_page', '24');
    }

    if (is_post_type_archive('vestiging')) {
        $query->set('posts_per_page', 24);
    }
}

function getMetaValuesOccasionPage($postId)
{
    $metaValues = get_post_meta($postId);

    $excludedValues = [
        'ag_code',
        'art_code',
        'naam',
        'beschrijving',
        'btw_marge',
        'nieuw',
        'contact_persoon',
        'contact_mobiel',
        'contact_telefoon',
        'prijs_excl',
        'afbeelding',
        'afbeelding_id',
        'categorie',
        'inline_featured_image',
        'prijsexcl',
        '_prijs_excl',
        'IMG',
        'lastChangeDate',
        'contact_filiaal',
        'afbeeldingenArray',
        'top',
        '_edit_lock',
        'prijs_op_aanvraag'
    ];

    $filteredValues = array_diff_key($metaValues, array_flip($excludedValues));

    foreach ($filteredValues as $key => $value) {

        if ($key === 'gereserveerd_tot') {
            date_default_timezone_set('Europe/Amsterdam');
            $orgDate = $metaValues['gereserveerd_tot'][0];
            $newDate = date('d-m-Y', strtotime($orgDate));
            $value[0] = $newDate;
        }
        if (!array_key_exists($key, $excludedValues)) {
            if (modifyMetaKey($key) != 'IMG' || modifyMetaKey($key) != 'top') {
                echo '<dt>' . modifyMetaKey($key) . '</dt>';
                echo '<dd>' . $value[0] . '</dd>';
            }
        }

    }


}

function modifyMetaKey($key)
{

    if (strpos($key, '_')) {
        return str_replace('_', ' ', $key);
    }

    if (strpos($key, 'conditie') !== false) {
        return substr_replace($key, " ", strlen('conditie'), -strlen($key));

    }

    if ( $key == 'hefinrichtingvoor' ) return 'hefinrichting voor';
    if ( $key == 'hefinrichtingachter' ) return 'hefinrichting achter';
    if ( $key == 'bandenvoor' ) return 'banden voor';
    if ( $key == 'bandenachter' ) return 'banden achter';
    if ( $key == 'hydraulischeventielen' ) return 'hydraulische ventielen';

    return $key;
}


if (isset($_POST['submitForm'])) {

    if(isset($_POST['Message']) && isset($_POST['Name']) && isset($_POST['Phone']) && isset($_POST['Name'])) {

        $to = 'occasions@abemec.nl';
        $subject = 'Meer info over ' . $_POST['title'];
        $body = 'Bericht: ' . $_POST['Message'] . '<br />';
        $body .= 'Naam: ' . $_POST['Name'] . '<br />';
        $body .= 'Telefoon: ' . $_POST['Phone'] . '<br />';
        $headers = array('From:' . $_POST['Name'] . '<' . $_POST['Email'] . '>', 'Content-Type: text/html; charset=UTF-8');

        wp_mail($to, $subject, $body, $headers);
    } else {
        header("Location: https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
        exit;
    }
}



// function cron_delete_trash() {
//     $args = array(
//         'posts_per_page'   => -1,
//         'post_status'      => 'trash',
//         'post_type'        => 'occasion'
//     );

//     $trash = get_posts($args);

//     foreach($trash as $post) {
//         wp_delete_post($post->ID, true);
//     }
// }
function delete_machine_post_func() {

    $post_type_to_delete = 'machine';
    global $wpdb;
    $sql = $wpdb->prepare("DELETE FROM {$wpdb->posts} WHERE post_type = %s", $post_type_to_delete);
    $wpdb->query($sql);
    
    
    //Delete All keys

    $sql = "DELETE FROM `wp_postmeta` WHERE meta_key IN ('art_code','naam','ag_code','beschrijving','categorie','prijsexcl','btw_marge','bouwjaar','tanden','nieuw','contact_persoon','contact_mobiel','conditieslijtdelen','uiterlijk','elementen','lastChangeDate','merk','top','draaiuren','bandenvoor','bandenachter','conditiemotor','conditietransmissie','gereserveerd_tot','contact_filiaal','contact_telefoon','cabine','conditiehef','vooras','hefinrichtingachter','aftakas','hydraulischeventielen','aanhangerrem','pk','inhoud','laadvermogen','rijsnelheidmin','rijsnelheidmax','werkbreedte','werkhoogte','hefinrichtingvoor','prijs_op_aanvraag','mtekst');";
    $wpdb->query($sql);
    
$xml_url= get_field('xml_url', 'option');
$xmldata = simplexml_load_file($xml_url) or die("Failed to load");
$total_nodes = count($xmldata->devices->device);
$nodes_processed =0;

foreach($xmldata->devices->device as $empl_new) { 
   
    $art_code= $empl_new->art_code;   
    $naam=$empl_new->naam;    
    $ag_code=$empl_new->ag_code;
    $beschrijving= $empl_new->beschrijving;
    $categorie=  $empl_new->categorie; 
    $prijsexcl= $empl_new->prijsexcl;
    $btw_marge= $empl_new->btw_marge;
    $bouwjaar= $empl_new->bouwjaar;
    $tanden= $empl_new->tanden;
    $nieuw= $empl_new->nieuw; 
    $contact_persoon= $empl_new->contact_persoon; 
    $contact_mobiel= $empl_new->contact_mobiel;
    $conditieslijtdelen= $empl_new->conditieslijtdelen; 
    $uiterlijk= $empl_new->uiterlijk;
    $elementen= $empl_new->elementen;
    $lastChangeDate= $empl_new->lastChangeDate; 
    $merk= $empl_new->merk;
    $top=  $empl_new->top; 
    $draaiuren=  $empl_new->draaiuren; 
    $bandenvoor=  $empl_new->bandenvoor;
    $bandenachter=  $empl_new->bandenachter;
    $conditiemotor=  $empl_new->conditiemotor;
    $conditietransmissie=  $empl_new->conditietransmissie;
    $gereserveerd_tot=  $empl_new->gereserveerd_tot;
    $contact_filiaal=  $empl_new->contact_filiaal;
    $contact_telefoon=  $empl_new->contact_telefoon;
    $contact_telefoon=  $empl_new->contact_telefoon;
    $cabine=  $empl_new->cabine;
    $conditiehef=  $empl_new->conditiehef;
    $vooras=  $empl_new->vooras;
    $hefinrichtingachter=  $empl_new->hefinrichtingachter;
    $aftakas=  $empl_new->aftakas;
    $hydraulischeventielen=  $empl_new->hydraulischeventielen;
    $aanhangerrem=  $empl_new->aanhangerrem;
    $pk=  $empl_new->pk;
    $inhoud=  $empl_new->inhoud;
    $laadvermogen=  $empl_new->laadvermogen;
    $rijsnelheidmin=  $empl_new->rijsnelheidmin;
    $rijsnelheidmax=  $empl_new->rijsnelheidmax;
    $werkbreedte=  $empl_new->werkbreedte;
    $werkhoogte=  $empl_new->werkhoogte;
    $hefinrichtingvoor=  $empl_new->hefinrichtingvoor;
    $prijs_op_aanvraag=  $empl_new->prijs_op_aanvraag;
    $mtekst=  $empl_new->mtekst;
    $directory= ABSPATH.'IMG/'.$art_code; 
    $parent_category = get_term_by( 'name', $categorie, 'category' );
if ( $parent_category ) {

  $parent_category_id = $parent_category->term_id;

} 
$my_post = array(

  'post_title'    => (string)$naam,

  'post_content'  => '',

  'post_status'   => 'publish',

  'post_type'     => 'machine',

  'post_category' => array($parent_category_id),

  

);

 $post_id = wp_insert_post( $my_post );

if($art_code){

    update_post_meta( $post_id, 'art_code',(string)$art_code );

}


if($naam){

    update_post_meta( $post_id, 'naam',(string)$naam );

}

 if($ag_code){

    update_post_meta( $post_id, 'ag_code',(string)$ag_code );

}

if($beschrijving){

    update_post_meta( $post_id, 'beschrijving',(string) $beschrijving );

}

if($categorie){

    update_post_meta( $post_id, 'categorie',(string) $categorie );

}

if($prijsexcl){

    update_post_meta( $post_id, 'prijsexcl',(string) $prijsexcl );

}

if($btw_marge){

    update_post_meta( $post_id, 'btw_marge',(string)$btw_marge );

}

if($bouwjaar){

    update_post_meta( $post_id, 'bouwjaar',(string)$bouwjaar );

}

if($tanden){

    update_post_meta( $post_id, 'tanden',(string)$tanden );

}

if($nieuw){

    update_post_meta( $post_id, 'nieuw',(string)$nieuw );

}

if($contact_persoon){

    update_post_meta( $post_id, 'contact_persoon',(string)$contact_persoon );

}


if($contact_mobiel){

    update_post_meta( $post_id, 'contact_mobiel',(string)$contact_mobiel );

}

if($conditieslijtdelen){

    update_post_meta( $post_id, 'conditieslijtdelen',(string)$conditieslijtdelen );

}


if($uiterlijk){

    update_post_meta( $post_id, 'uiterlijk',(string)$uiterlijk );

}


if($elementen){

    update_post_meta( $post_id, 'elementen',(string)$elementen );

}

if($lastChangeDate){

    update_post_meta( $post_id, 'lastChangeDate',(string)$lastChangeDate );

}

if($merk){

    update_post_meta( $post_id, 'merk',(string)$merk );

}


if($top){

    update_post_meta( $post_id, 'top',(string)$top );

}

if($draaiuren){

    update_post_meta( $post_id, 'draaiuren',(string)$draaiuren );

}

if($bandenvoor){

    update_post_meta( $post_id, 'bandenvoor',(string)$bandenvoor );

}

if($bandenachter){

    update_post_meta( $post_id, 'bandenachter',(string)$bandenachter );

}

if($conditiemotor){

    update_post_meta( $post_id, 'conditiemotor',(string)$conditiemotor );

}
if($conditietransmissie){

    update_post_meta( $post_id, 'conditietransmissie',(string)$conditietransmissie );

}

if($gereserveerd_tot){

    update_post_meta( $post_id, 'gereserveerd_tot',(string)$gereserveerd_tot );

}

if(trim($contact_filiaal)){

    update_post_meta( $post_id, 'contact_filiaal',(string)$contact_filiaal );
    global $wpdb;

$meta_key = 'contact_filiaal';

$wpdb->query(
    $wpdb->prepare(
        "
        UPDATE $wpdb->postmeta
        SET meta_value = TRIM(REGEXP_REPLACE(meta_value, '\\\\s+', ' '))
        WHERE meta_key = %s
        ",
        $meta_key
    )
);
}

if($contact_telefoon){

    update_post_meta( $post_id, 'contact_telefoon',(string)$contact_telefoon );

}

if($cabine){

    update_post_meta( $post_id, 'cabine',(string)$cabine );

}

if($conditiehef){

    update_post_meta( $post_id, 'conditiehef',(string)$conditiehef );

}

if($vooras){

    update_post_meta( $post_id, 'vooras',(string)$vooras );

}

if($hefinrichtingachter){

    update_post_meta( $post_id, 'hefinrichtingachter',(string)$hefinrichtingachter);

}

if($aftakas){

    update_post_meta( $post_id, 'aftakas',(string)$aftakas );

}

if($hydraulischeventielen){

    update_post_meta( $post_id, 'hydraulischeventielen',(string)$hydraulischeventielen);

}

if($aanhangerrem){

    update_post_meta( $post_id, 'aanhangerrem',(string)$aanhangerrem );

}

if($pk){

    update_post_meta( $post_id, 'pk',(string)$pk );

}

if($inhoud){

    update_post_meta( $post_id, 'inhoud',(string)$inhoud);

}

if($laadvermogen){

    update_post_meta( $post_id, 'laadvermogen',(string)$laadvermogen );

}

if($rijsnelheidmin){

    update_post_meta( $post_id, 'rijsnelheidmin',(string)$rijsnelheidmin);

}

if($rijsnelheidmax){

    update_post_meta( $post_id, 'rijsnelheidmax',(string)$rijsnelheidmax);

}

if($werkbreedte){

    update_post_meta( $post_id, 'werkbreedte',(string)$werkbreedte);

}

if($werkhoogte){

    update_post_meta( $post_id, 'werkhoogte',(string)$werkhoogte);

}

if($hefinrichtingvoor){

    update_post_meta( $post_id, 'hefinrichtingvoor',(string)$hefinrichtingvoor

     );

}
if($prijs_op_aanvraag){

    update_post_meta( $post_id, 'prijs_op_aanvraag',(string)$prijs_op_aanvraag);

}

if($mtekst){

    update_post_meta( $post_id, 'mtekst',(string)$mtekst);

}

$nodes_processed++;

    // Check if all nodes are processed
    if ($nodes_processed === $total_nodes) {
        break; // Stop the loop when all nodes are processed
    }







} 
die;


}
function xml_export_machine_func() {

    $xml = new SimpleXMLElement('<data></data>');
$devices = $xml->addChild('devices');


global $wp_query;
           $args = array(
            "posts_per_page" => -1,

            "post_type" => "machine",

            "post_status" => "publish",

            "orderby" => "title",

            "order" => "ASC"
           );
           
$the_query = new WP_Query($args);
if ($the_query->have_posts()) {
while ($the_query->have_posts()) {
$the_query->the_post();
$post_id = get_the_ID();


$naam = get_post_meta($post_id, 'naam', true);
$categorie = get_post_meta($post_id, 'categorie', true);
$beschrijving = get_post_meta($post_id, 'beschrijving', true);
$art_code = get_post_meta($post_id, 'art_code', true);
$prijsexcl = get_post_meta($post_id, 'prijsexcl', true);
$bouwjaar = get_post_meta($post_id, 'bouwjaar', true);
$bandenvoor = get_post_meta($post_id, 'bandenvoor', true);
$bandenachter = get_post_meta($post_id, 'bandenachter', true);
$conditiemotor = get_post_meta($post_id, 'conditiemotor', true);
$conditietransmissie = get_post_meta($post_id, 'conditietransmissie', true);
$conditieslijtdelen = get_post_meta($post_id, 'conditieslijtdelen', true);
$uiterlijk = get_post_meta($post_id, 'uiterlijk', true);
$conditiehef = get_post_meta($post_id, 'conditiehef', true);
$merk = get_post_meta($post_id, 'merk', true);
$draaiuren = get_post_meta($post_id, 'draaiuren', true);
$cabine = get_post_meta($post_id, 'cabine', true);
$rijsnelheidmax = get_post_meta($post_id, 'rijsnelheidmax', true);
$werkbreedte = get_post_meta($post_id, 'werkbreedte', true);
$inhoud = get_post_meta($post_id, 'inhoud', true);
$elementen = get_post_meta($post_id, 'elementen', true);
$werkhoogte = get_post_meta($post_id, 'werkhoogte', true);
$vooras = get_post_meta($post_id, 'vooras', true);
$aftakas = get_post_meta($post_id, 'aftakas', true);
$aanhangerrem = get_post_meta($post_id, 'aanhangerrem', true);
$rijsnelheidmin = get_post_meta($post_id, 'rijsnelheidmin', true);
$hydraulischeventielen = get_post_meta($post_id, 'hydraulischeventielen', true);
$hefinrichtingachter = get_post_meta($post_id, 'hefinrichtingachter', true);
$hefinrichtingvoor = get_post_meta($post_id, 'hefinrichtingvoor', true);
$pk = get_post_meta($post_id, 'pk', true);
$contact_filiaal = get_post_meta($post_id, 'contact_filiaal', true);
$contact_persoon = get_post_meta($post_id, 'contact_persoon', true);
$contact_mobiel = get_post_meta($post_id, 'contact_mobiel', true);
$contact_telefoon = get_post_meta($post_id, 'contact_telefoon', true);
$ag_code = get_post_meta($post_id, 'ag_code', true);
$btw_marge = get_post_meta($post_id, 'btw_marge', true);
$nieuw = get_post_meta($post_id, 'nieuw', true);
$lastChangeDate = get_post_meta($post_id, 'lastChangeDate', true);
$top = get_post_meta($post_id, 'top', true);
$mtekst = get_post_meta($post_id, 'mtekst', true);
$prijs_op_aanvraag = get_post_meta($post_id, 'prijs_op_aanvraag', true);
$laadvermogen = get_post_meta($post_id, 'laadvermogen', true);
$werkdiepte = get_post_meta($post_id, 'werkdiepte', true);
$tanden = get_post_meta($post_id, 'tanden', true);
$gpssysteem = get_post_meta($post_id, 'gpssysteem', true);
$gereserveerd = get_post_meta($post_id, 'gereserveerd', true);

// $base_url = site_url()."/inner-page/";
$article_url = get_permalink();




$url_path = ABSPATH.'/_occasions/images/'.$art_code.'/';
$handle = opendir($url_path);
if (!empty($handle)) {
  $files = array();
  while($file = readdir($handle)){
    if($file !== '.' && $file !== '..'){
      $files[] = $file;
    }
  }
  closedir($handle);

  
  $files = array_reverse($files);

  
  $art_code_file=$art_code . '_' . '001.jpg';
  
  $index = array_search($art_code_file, $files);

 
  if ($index !== false) {
    $temp = $files[0];
    $files[0] = $files[$index];
    $files[$index] = $temp;
  }

  $filearray = "";
  foreach ($files as $file) {
      $filearray .= home_url('/_occasions/images/' . $art_code . '/' . $file) . ' | ';
  }
  
  $filearray = rtrim($filearray, '| ');
}else{
    $filearray = "";
}



 


$device = $devices->addChild('device');
$device->addChild('art_code', "$art_code");
$device->addChild('naam', "$naam");
$device->addChild('ag_code', "$ag_code");
$device->addChild('beschrijving',"$beschrijving");
$device->addChild('categorie', "$categorie");
$device->addChild('btw_marge', "$btw_marge");
$device->addChild('nieuw', "$nieuw");
$device->addChild('contact_persoon', "$contact_persoon");
$device->addChild('contact_mobiel', "$contact_mobiel");
$device->addChild('draaiuren', "$draaiuren");
$device->addChild('bandenachter', "$bandenachter");
$device->addChild('cabine', "$cabine");
$device->addChild('conditiemotor', "$conditiemotor");
$device->addChild('conditietransmissie',"$conditietransmissie");
$device->addChild('uiterlijk',"$uiterlijk");
$device->addChild('conditiehef', "$conditiehef");
$device->addChild('hefinrichtingachter', "$hefinrichtingachter");
$device->addChild('aftakas', "$aftakas");
$device->addChild('hydraulischeventielen', "$hydraulischeventielen");
$device->addChild('lastChangeDate', "$lastChangeDate");
$device->addChild('merk', "$merk");
$device->addChild('top', "$top");
$device->addChild('prijs', "$prijsexcl");
$device->addChild('bouwjaar', "$bouwjaar");
$device->addChild('bandenvoor', "$bandenvoor");
$device->addChild('conditieslijtdelen', "$conditieslijtdelen");
$device->addChild('rijsnelheidmax', "$rijsnelheidmax");
$device->addChild('werkbreedte', "$werkbreedte");
$device->addChild('inhoud', "$inhoud");
$device->addChild('elementen', "$elementen");
$device->addChild('werkhoogte', "$werkhoogte");
$device->addChild('vooras', "$vooras");
$device->addChild('aanhangerrem', "$aanhangerrem");
$device->addChild('rijsnelheidmin', "$rijsnelheidmin");
$device->addChild('hefinrichtingvoor', "$hefinrichtingvoor");
$device->addChild('pk', "$pk");
$device->addChild('contact_filiaal', "$contact_filiaal");
$device->addChild('contact_telefoon', "$contact_telefoon");
$device->addChild('mtekst', "$mtekst");
$device->addChild('prijs_op_aanvraag', "$prijs_op_aanvraag");
$device->addChild('laadvermogen', "$laadvermogen");
$device->addChild('werkdiepte', "$werkdiepte");
$device->addChild('tanden', "$tanden");
$device->addChild('gpssysteem', "$gpssysteem");
$device->addChild('gereserveerd', "$gereserveerd"); 
 

$device->addChild('IMG', "$filearray");
$device->addChild('article_url', "$article_url");


 }


}

      




$xml->asXML('data.xml');
    }


add_filter( 'cron_schedules', function ( $schedules ) {
    $schedules['5min'] = array(
        'interval'  => 300,
        'display'   => __( 'Every 5 minutes', 'textdomain' )
    );
    $schedules['30min'] = array(
        'interval'  => 60*30,
        'display'   => __( 'Every 30 minutes', 'textdomain' )
    );
    $schedules['240min'] = array(
        'interval'  => 60*240,
        'display'   => __( 'Every 60 minutes', 'textdomain' )
    );
    return $schedules;
});

add_action('cron_sync_occasions', 'sync_occasions');
if( !wp_next_scheduled( 'cron_sync_occasions' ) ) {
    wp_schedule_event( time(), '240min', 'cron_sync_occasions' );
}
add_action('cron_sync_categories', 'sync_categories');
if( !wp_next_scheduled( 'cron_sync_categories' ) ) {
    wp_schedule_event( time(), '30min', 'cron_sync_categories' );
}
add_action('cron_delete_occasions', 'cron_delete_trash');
if( ! wp_next_scheduled( 'cron_delete_occasions' ) ) {
    wp_schedule_event( time(), '30min', 'cron_delete_occasions' );
}
add_action('delete_machine_post', 'delete_machine_post_func');
if( ! wp_next_scheduled( 'cron_delete_occasions' ) ) {
    wp_schedule_event( time(), 'cmplz_daily', 'delete_machine_post' );
}


add_action('xml_export', 'xml_export_machine_func');

if (!wp_next_scheduled('xml_export')) {
    wp_schedule_event(time(), 'hourly', 'xml_export');
}

add_action('cron_test', 'test');
function test(){
    file_put_contents(__DIR__ . '/test.log', date('Y-m-d H:i:s') . "\r\n", FILE_APPEND);
}
if( ! wp_next_scheduled( 'cron_test' ) ) {
    wp_schedule_event( time(), '5min', 'cron_test' );
}

add_filter( 'post_type_link', 'my_post_type_link', 10, 3);
function my_post_type_link($permalink, $post, $leavename) {

    if  ($post->post_type == 'occasion') {
        $meta = get_post_meta($post->ID, 'categorie', true);
        $name = get_post_meta($post->ID, 'naam', true);
        $merk = get_post_meta($post->ID, 'merk', true);
        if (isset($meta) && !empty($meta))
            $permalink = home_url( "occasions/" . sanitize_title($meta) . "/" . sanitize_title($merk) . "/" . sanitize_title($name) . "/" . $post->post_name . "/");
    }

    return $permalink;

}

add_filter( 'rewrite_rules_array', 'my_rewrite_rules_array');
function my_rewrite_rules_array($rules) {
    //var_dump($rules);
    $rules = array('occasions/([^/]*)/([^/]*)/([^/]*)/([^/]*)/?$' => 'index.php?post_type=occasion&name=$matches[4]&meta=$matches[1]&meta=$matches[3]&meta=$matches[2]') + $rules;
    return $rules;
}

$theme->init();

add_filter( 'wpcf7_support_html5_fallback', '__return_true' );


add_action('wp_head','wp_head_add_css');
function wp_head_add_css(){?>
<style type="text/css">
    
@media(max-width: 767px){
    div#products picture.product__picture img{
        width: 100% !important;
        height: auto !important;
    }
}
</style>
<?php }



/*add_action('init', 'sync_occasions_init_pp');
function sync_occasions_init_pp()
{
    if (isset($_GET['pp_import_occasions']) && $_GET['pp_import_occasions'] != '') {
        set_time_limit(300);
        $file = 'https://www.abemec.nl/_occasions/data/data.xml';
        $xmlReader = new XMLReader();
        $s = $xmlReader->open($file);
        if ( ! $s ) return;
        $afbeeldingenDict = [];
        $artCodeIdDict = [];

        $xmlReader->read();

        while($xmlReader->name != 'device') { $xmlReader->read(); }
        while($xmlReader->name == 'device') {
            $xmlArticle = new SimpleXMLElement($xmlReader->readOuterXml());
            echo "<pre>";
            // print_r($xmlArticle);
            if ($xmlArticle->art_code == "") {
                echo 'praful';
            }else{
                echo $xmlArticle->art_code;
            }
            echo "<br>";
            echo "</pre>";
            $xmlReader->next('device');
            unset($xmlArticle);
        }
        $xmlReader->close();
    }
}*/
//function to change the permalink for neiuws
function nieuws_generate_rewrite_rules( $wp_rewrite ) {
  $new_rules = array(
    '(([^/]+/)*nieuws)/page/?([0-9]{1,})/?$' => 'index.php?pagename=$matches[1]&paged=$matches[3]',
    'nieuws/([^/]+)/?$' => 'index.php?post_type=post&name=$matches[1]',
    'nieuwsv/[^/]+/attachment/([^/]+)/?$' => 'index.php?post_type=post&attachment=$matches[1]',
    'nieuws/[^/]+/attachment/([^/]+)/trackback/?$' => 'index.php?post_type=post&attachment=$matches[1]&tb=1',
    'nieuws/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$' => 'index.php?post_type=post&attachment=$matches[1]&feed=$matches[2]',
    'nieuws/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$' => 'index.php?post_type=post&attachment=$matches[1]&feed=$matches[2]',
    'nieuws/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$' => 'index.php?post_type=post&attachment=$matches[1]&cpage=$matches[2]',     
    'nieuws/[^/]+/attachment/([^/]+)/embed/?$' => 'index.php?post_type=post&attachment=$matches[1]&embed=true',
    'nieuws/[^/]+/embed/([^/]+)/?$' => 'index.php?post_type=post&attachment=$matches[1]&embed=true',
    'nieuws/([^/]+)/embed/?$' => 'index.php?post_type=post&name=$matches[1]&embed=true',
    'nieuws/[^/]+/([^/]+)/embed/?$' => 'index.php?post_type=post&attachment=$matches[1]&embed=true',
    'nieuws/([^/]+)/trackback/?$' => 'index.php?post_type=post&name=$matches[1]&tb=1',
    'nieuws/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$' => 'index.php?post_type=post&name=$matches[1]&feed=$matches[2]',
    'nieuws/([^/]+)/(feed|rdf|rss|rss2|atom)/?$' => 'index.php?post_type=post&name=$matches[1]&feed=$matches[2]',
    'nieuws/page/([0-9]{1,})/?$' => 'index.php?post_type=post&paged=$matches[1]',
    'nieuws/[^/]+/page/?([0-9]{1,})/?$' => 'index.php?post_type=post&name=$matches[1]&paged=$matches[2]',
    'nieuws/([^/]+)/page/?([0-9]{1,})/?$' => 'index.php?post_type=post&name=$matches[1]&paged=$matches[2]',
    'nieuwsv/([^/]+)/comment-page-([0-9]{1,})/?$' => 'index.php?post_type=post&name=$matches[1]&cpage=$matches[2]',
    'nieuws/([^/]+)(/[0-9]+)?/?$' => 'index.php?post_type=post&name=$matches[1]&page=$matches[2]',
    'nieuws/[^/]+/([^/]+)/?$' => 'index.php?post_type=post&attachment=$matches[1]',
    'nieuws/[^/]+/([^/]+)/trackback/?$' => 'index.php?post_type=post&attachment=$matches[1]&tb=1',
    'nieuws/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$' => 'index.php?post_type=post&attachment=$matches[1]&feed=$matches[2]',
    'nieuws/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$' => 'index.php?post_type=post&attachment=$matches[1]&feed=$matches[2]',
    'nieuws/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$' => 'index.php?post_type=post&attachment=$matches[1]&cpage=$matches[2]',
  );
  $wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
}
add_action( 'generate_rewrite_rules', 'nieuws_generate_rewrite_rules' );

function nieuws_update_post_link( $post_link, $id = 0 ) {
  $post = get_post( $id );
  if( is_object( $post ) && $post->post_type == 'post' ) {
    return home_url( '/nieuws/' . $post->post_name );
  }
  return $post_link;
}
add_filter( 'post_link', 'nieuws_update_post_link', 1, 3 );



add_filter(
	'all_plugins',
	function ( $plugins ) {

		$shouldHide = ! array_key_exists( 'show_all', $_GET );

		if ( $shouldHide ) {
            unset( $plugins[ 'easy-fancybox/easy-fancybox.php' ] );
		}

		return $plugins;
	}
);

/* ---- New Functionality ---- */

// Register Custom Post Type
function media__post_type() {

	$t_post_type = array(
		array(
			'slug'  => 'portfolio_gallery',
			'name'  => 'Portfolio Gallerys',
			'mname' => 'Portfolio Gallery',
		),
		array(
			'slug'  => 'portfolio_video',
			'name'  => 'Portfolio Videos',
			'mname' => 'Portfolio Video',
		),
		array(
			'slug'  => 'training',
			'name'  => 'Training',
			'mname' => 'Training',
		),
	);

	if ( ! empty( $t_post_type ) ) :

		foreach ( $t_post_type as $key_slug => $posttype ) :
			if ( isset( $posttype['slug'] ) && isset( $posttype['name'] ) && isset( $posttype['mname'] ) &&
			! empty( $posttype['slug'] ) && ! empty( $posttype['name'] ) && ! empty( $posttype['mname'] ) ) :

				$labels = array(
					'name'                  => $posttype['name'],
					'singular_name'         => $posttype['name'],
					'menu_name'             => $posttype['name'],
					'name_admin_bar'        => $posttype['mname'],
					'archives'              => 'Item Archives',
					'attributes'            => 'Item Attributes',
					'parent_item_colon'     => 'Parent Item:',
					'all_items'             => 'All Items',
					'add_new_item'          => 'Add New Item',
					'add_new'               => 'Add New',
					'new_item'              => 'New Item',
					'edit_item'             => 'Edit Item',
					'update_item'           => 'Update Item',
					'view_item'             => 'View Item',
					'view_items'            => 'View Items',
					'search_items'          => 'Search Item',
					'not_found'             => 'Not found',
					'not_found_in_trash'    => 'Not found in Trash',
					'featured_image'        => 'Featured Image',
					'set_featured_image'    => 'Set featured image',
					'remove_featured_image' => 'Remove featured image',
					'use_featured_image'    => 'Use as featured image',
					'insert_into_item'      => 'Insert into item',
					'uploaded_to_this_item' => 'Uploaded to this item',
					'items_list'            => 'Items list',
					'items_list_navigation' => 'Items list navigation',
					'filter_items_list'     => 'Filter items list',
				);

				$args = array(
					'label'               => $posttype['mname'],
					'description'         => $posttype['mname'] . 'Description',
					'labels'              => $labels,
					'supports'            => array( 'title', 'editor', 'thumbnail' ),
					'hierarchical'        => false,
					'public'              => true,
					'show_ui'             => true,
					'show_in_menu'        => true,
					'show_in_admin_bar'   => true,
					'show_in_nav_menus'   => true,
					'can_export'          => true,
					'has_archive'         => true,
					'exclude_from_search' => false,
					'publicly_queryable'  => true,
					'capability_type'     => 'post',
				);

				register_post_type( $posttype['slug'], $args );

		   endif;
		endforeach;

	endif;

}
add_action( 'init', 'media__post_type', 0 );


// Register Custom Taxonomy
function custom_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Video Categories', 'Video Categories', 'abemec' ),
		'singular_name'              => _x( 'Video Categories', 'Video Categories', 'abemec' ),
		'menu_name'                  => __( 'Video Categories', 'abemec' ),
		'all_items'                  => __( 'All Items', 'abemec' ),
		'parent_item'                => __( 'Parent Item', 'abemec' ),
		'parent_item_colon'          => __( 'Parent Item:', 'abemec' ),
		'new_item_name'              => __( 'New Item Name', 'abemec' ),
		'add_new_item'               => __( 'Add New Item', 'abemec' ),
		'edit_item'                  => __( 'Edit Item', 'abemec' ),
		'update_item'                => __( 'Update Item', 'abemec' ),
		'view_item'                  => __( 'View Item', 'abemec' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'abemec' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'abemec' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'abemec' ),
		'popular_items'              => __( 'Popular Items', 'abemec' ),
		'search_items'               => __( 'Search Items', 'abemec' ),
		'not_found'                  => __( 'Not Found', 'abemec' ),
		'no_terms'                   => __( 'No items', 'abemec' ),
		'items_list'                 => __( 'Items list', 'abemec' ),
		'items_list_navigation'      => __( 'Items list navigation', 'abemec' ),
	);
	$args   = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => true,
	);
	register_taxonomy( 'video_cat', array( 'portfolio_video' ), $args );

}
add_action( 'init', 'custom_taxonomy', 0 );

function wpdocs_dequeue_script() {
	if ( is_page( 'media' ) || is_page( 'media-2' ) || is_page( 1 ) ) :
		wp_dequeue_script( 'jquery-fancybox' );
	endif;
}
add_action( 'wp_print_scripts', 'wpdocs_dequeue_script', 100 );


add_action( 'wp_enqueue_scripts', 'new_functionality_enqueue_script' );
function new_functionality_enqueue_script() {
	wp_enqueue_style( 'dev-css', get_bloginfo( 'stylesheet_directory' ) . '/assets/css/dev.css', array(), '1.0' );
	if ( is_page( 'scholingsaanbod' ) || is_page( 'jaarkalender' ) ) :
		wp_enqueue_style( 'boostrap', get_bloginfo( 'stylesheet_directory' ) . '/assets/css/bootstrap.min.css', array(), '1.0' );
		wp_enqueue_script( 'boostrap-bundle', get_bloginfo( 'stylesheet_directory' ) . '/assets/js/bootstrap.bundle.min.js', array( 'jquery' ), '1.0' );
	endif;
    wp_enqueue_script( 'developer-custom', get_bloginfo( 'stylesheet_directory' ) . '/assets/js/developer.js', array( 'jquery' ), '1.0' );
}


function wpcf7_autop_or_not_in_form() {
	if ( is_page( 'aanmelden-scholing' ) ) :
		add_filter( 'wpcf7_autop_or_not', '__return_false' );
	endif;
}
add_action( 'wp', 'wpcf7_autop_or_not_in_form' );


function abemec_dynamic_select_field_values( $scanned_tag, $replace ) {

	$args = array(
		'post_type'   => 'training',
		'numberposts' => -1,
	);

	// if ( isset( $_GET['tid'] ) && ! empty( $_GET['tid'] ) ) :
	// 	$args['post__in'] = array( $_GET['tid'] );
	// endif;

	$rows = get_posts( $args );

	if ( 'scholing' === $scanned_tag['name'] || 'locatie' === $scanned_tag['name'] ) :

		$key = ( 'scholing' === $scanned_tag['name'] ) ? 'onderwerp' : 'jaarkalender_locatie';

		if ( ! $rows ) {
			return $scanned_tag;
		}

		$checkarray = array();

		if( 'scholing' === $scanned_tag['name'] ):
			foreach ( $rows as $row ) {
				$scanned_tag['raw_values'][] = $row->ID . '|' . $row->post_title;
			}
		endif;

		$pipes = new WPCF7_Pipes( $scanned_tag['raw_values'] );

		$scanned_tag['values'] = $pipes->collect_befores();
		$scanned_tag['labels'] = $pipes->collect_afters();
		$scanned_tag['pipes']  = $pipes;

		return $scanned_tag;

	elseif ( 'datum' === $scanned_tag['name'] ) :

		// if ( ! $rows ) {
		// 	return $scanned_tag;
		// }

		// $checkarray = array();

		// foreach ( $rows as $row ) {
		// 	$f_id     = $row->ID;
		// 	$f_date   = get_field( 'jaarkalender_datum', $f_id );
		// 	$f_time_s = get_field( 'kalender_starttijd', $f_id );
		// 	$f_time_e = get_field( 'einde_kalendertijd', $f_id );
		// 	$f_comb   = $f_date . '-' . $f_time_s . '-' . $f_time_e;
		// 	if ( ! in_array( $f_comb, $checkarray ) ) :
		// 		$checkarray[]                = $f_comb;
		// 		$scanned_tag['raw_values'][] = $f_comb . '|' . $f_comb;
		// 	endif;
		// }

		// $pipes = new WPCF7_Pipes( $scanned_tag['raw_values'] );

		// $scanned_tag['values'] = $pipes->collect_befores();
		// $scanned_tag['labels'] = $pipes->collect_afters();
		// $scanned_tag['pipes']  = $pipes;

		return $scanned_tag;

	else :
		return $scanned_tag;
	endif;
}

add_filter( 'wpcf7_form_tag', 'abemec_dynamic_select_field_values', 10, 2 );

function get_locatie_and_time_based_on_traning(){

	$nonce = $_POST['nonce'];

    if ( ! wp_verify_nonce( $nonce, 'option-generat-nonce' ) ) {
        die( 'Nonce value cannot be verified.' );
    }

	$locatie = $date_titme = '';
	$checkarray = array();
	if( ! empty( $_POST['traningid'] ) ):

		if( have_rows('sd_datum_locatie', $_POST['traningid']) ):

			// Loop through rows.
			while( have_rows('sd_datum_locatie', $_POST['traningid']) ) : the_row();
				$datum = get_sub_field('datum');
				$kalender_starttijd = get_sub_field('kalender_starttijd');
				$einde_kalendertijd = get_sub_field('einde_kalendertijd');
				$locatie_in = get_sub_field('locatie');
				$sep = ( ! empty( $einde_kalendertijd ) )?'-':'';
				$f_comb      = $kalender_starttijd.$sep.$einde_kalendertijd;
				$sep1 = ( ! empty( $f_comb ) )?'-':'';

				if( ! empty( $datum ) ):
					$date_titme .= '<option data-locate="'.$locatie_in.'" value="'.$datum.$sep1.$f_comb.'" >'.$datum.$sep1.$f_comb.'</option>';
				endif;

				if( ! empty( $locatie_in ) && ! in_array( $locatie_in, $checkarray ) ):
					$checkarray[] = $locatie_in; 
					$locatie .= '<option data-time="'.$datum.$sep1.$f_comb.'" value="'.$locatie_in.'">'.$locatie_in.'</option>';
				endif;

			endwhile;
		
		endif;

	endif;
	
	$return = array(
		'locations'  => $locatie,
		'datetimes'  => $date_titme
	);
	
	wp_send_json($return);

	die();
}
add_action( 'wp_ajax_option_generat','get_locatie_and_time_based_on_traning' );
add_action( 'wp_ajax_nopriv_option_generat', 'get_locatie_and_time_based_on_traning');

function agenda_post_load_with_sidebar_count(){

    $nonce = $_POST['nonce'];

    if ( ! wp_verify_nonce( $nonce, 'agenda-post-nonce' ) ) {
        die( 'Nonce value cannot be verified.' );
    }

    ob_start();
    if ( isset( $_POST['trigger_year'] ) && $_POST['trigger_year'] == 'yes' ) {
        global $wpdb;
      for ( $fun_counter_month = 1; $fun_counter_month <= 12; $fun_counter_month++ ) {
        $requested_year = $_POST['data_year'];
        $fn_month_loop = date('F', mktime(0,0,0,$fun_counter_month, 1, date('Y')));
        $fn_active_month = ( $fun_counter_month == 1 ) ? 'active' : '' ;
        $monthQuery = $wpdb->get_var("SELECT count(ID) FROM $wpdb->posts WHERE post_type='agenda' AND (post_status = 'publish' OR post_status = 'future') AND YEAR(post_date) = ". $requested_year." AND MONTH(post_date) = ". $fun_counter_month);
        ?>
        <li class="<?php echo $fn_active_month; ?>">
          <a href="#" data-target="month" data-month="<?php echo $fun_counter_month; ?>">
            <div class="left"><?php echo esc_html( dutch_format( $fn_month_loop ) ); ?></div>
            <div class="right"><?php echo esc_html( $monthQuery ); ?></div>
          </a>
        </li>
        <?php 
        wp_reset_postdata(); 
      }
    }
    $year_content = ob_get_clean();

    ob_start();
    $args = array(
        'posts_per_page' => -1,
        'post_type' => 'agenda',
        'orderby' => 'date',
        'order' => 'ASC',  
        'date_query' => array( 
          array(
            'year' => $_POST['data_year'], 
            'month' => $_POST['data_month'] 
          ), 
        ), 
      ); 
    $the_query = new WP_Query( $args ); 
    if ( $the_query->have_posts() ) : 
      while (
        $the_query->have_posts() ) : $the_query->the_post();
          get_template_part('template-parts/page', 'agenda-loop-content');
      endwhile; 
      wp_reset_postdata(); 
    else : ?>
      <p><?php _e( 'Sorry, we hebben geen events in deze maand.' ); ?></p>
    <?php endif;

    $post_date_content = ob_get_clean();
    
    $return = array(
        'found_posts'  => $post_date_content,
        'year_content'  => $year_content
    );
    
    wp_send_json($return);

    die();
}
add_action( 'wp_ajax_agenda_post_load','agenda_post_load_with_sidebar_count' );
add_action( 'wp_ajax_nopriv_agenda_post_load', 'agenda_post_load_with_sidebar_count');


add_filter('pto/posts_orderby/ignore', 'theme_pto_posts_orderby', 10, 3);
function theme_pto_posts_orderby($ignore, $orderBy, $query)
{
    if( (! is_array($query->query_vars['post_type']) && $query->query_vars['post_type'] == 'agenda') || (is_array($query->query_vars)   &&  in_array('agenda', $query->query_vars)))
    $ignore = TRUE;
    return $ignore;
}


function dutch_format($value) {
    $months = array(
        "January"   => "Januari",
        "February"  => "Februari",
        "March" => "Maart",
        "April"     => "April",
        "May"       => "Mei",
        "June"      => "Juni",
        "July"      => "Juli",
        "August"    => "Augustus",
        "September" => "September",
        "October"   => "Oktober",
        "November"  => "November",
        "December"  => "December"
    );
    return $months[$value];
}

function myfilter1()
{
    $parent_name = $_GET["main-category"];
    $parent_term = get_term_by("name", $parent_name, "category");
    $meta_query = [];
    if (is_wp_error($parent_term)) {
        // Handle error if parent category is not found
    } else {
        $parent_id = $parent_term->term_id;
        $child_terms = get_term_children($parent_id, "category");

        if ($child_terms) {
            $meta_query[0] = [
                "relation" => "OR",
            ];

            $sub_child_meta = [];
            foreach ($child_terms as $child) {
                $child_term = get_term_by("id", $child, "category");
                $child_name = $child_term->name;

                $sub_child_meta = [
                    "key" => "categorie",
                    "value" => $child_name,
                    "compare" => "=",
                ];

                array_push($meta_query[0], $sub_child_meta);
            }
        } else {
            if ($_GET["main-category"]) {
                $main_category = $_GET["main-category"];
                $meta_query[0] = [
                    "key" => "categorie",
                    "value" => $main_category,
                    "compare" => "=",
                ];
            }
        }
    }

    if ($_GET["merk"]) {
        $merk = $_GET["merk"];

        $meta_query[1] = [
            "key" => "merk",

            "value" => $merk,

            "compare" => "=",
        ];
    }

    if ($_GET["prijsmin"] ||  $_GET["prijsmax"]) {

        if($_GET["prijsmin"]==""){
            $prijsmin=0;
        }

        else{

            $prijsmin = $_GET["prijsmin"];

        }

        if($_GET["prijsmax"]==""){

            $prijsmax=900000;

        }
        else{

            $prijsmax = $_GET["prijsmax"];

        }

      
     

        $meta_query[2] = [
            "key" => "prijsexcl",

            "type" => "numeric",

            "value" => [$prijsmin, $prijsmax],

            "compare" => "BETWEEN",
        ];
    } 
    // elseif ($_GET["prijsmin"]) {

    //      if($_GET["prijsmin"]==""){
    //         $prijsmin=0;
    //     }

    //     else{

    //         $prijsmin = $_GET["prijsmin"];

    //     }

    //     if($_GET["prijsmax"]==""){

    //         $prijsmax=90000;

    //     }
    //     else{

    //         $prijsmax = $_GET["prijsmax"];

    //     }

        

    //     $meta_query[2] = [
    //         "key" => "prijsexcl",

    //         "type" => "numeric",

    //         "value" => [$prijsmin, $prijsmax],

    //         "compare" => "BETWEEN",
    //     ];
    // }
    //  elseif ($_GET["prijsmax"]) {

    //      if($_GET["prijsmin"]==""){
    //         $prijsmin=0;
    //     }

    //     else{

    //         $prijsmin = $_GET["prijsmin"];

    //     }

    //     if($_GET["prijsmax"]==""){

    //         $prijsmax=90000;

    //     }
    //     else{

    //         $prijsmax = $_GET["prijsmax"];

    //     }

       
    //    $meta_query[2] = [
    //         "key" => "prijsexcl",

    //         "type" => "numeric",

    //         "value" => [$prijsmin, $prijsmax],

    //         "compare" => "BETWEEN",
    //     ];
    // }

    if ($_GET["draaiurenMin"] && $_GET["draaiurenMax"]) {
        $draaiurenMin = $_GET["draaiurenMin"];

        $draaiurenMax = $_GET["draaiurenMax"];

        $meta_query[3] = [
            "key" => "draaiuren",

            "type" => "numeric",

            "value" => [$draaiurenMin, $draaiurenMax],

            "compare" => "BETWEEN",
        ];
    } elseif ($_GET["draaiurenMin"]) {
        $draaiurenMin = $_GET["draaiurenMin"];

        $meta_query[3] = [
            "key" => "draaiuren",

            "value" => $draaiurenMin,

            "compare" => ">=",
        ];
    } elseif ($_GET["draaiurenMax"]) {
        $draaiurenMax = $_GET["draaiurenMax"];

        $meta_query[3] = [
            "key" => "draaiuren",

            "value" => $draaiurenMax,

            "compare" => "<=",
        ];
    }
   if ($_GET["contact_filiaal"]) {
        $contact_filiaal = $_GET["contact_filiaal"];

        $meta_query[4] = [
            "key" => "contact_filiaal",

            "type" => "string",

            "value" => $contact_filiaal,

            "compare" => "like",
        ];
    }

    if ($_GET["bouwjaarMin"] && $_GET["bouwjaarMax"]) {
        $bouwjaarMin = $_GET["bouwjaarMin"];

        $bouwjaarMax = $_GET["bouwjaarMax"];

        $meta_query[5] = [
            "key" => "bouwjaar",

            "type" => "string",

            "value" => [$bouwjaarMin, $bouwjaarMax],

            "compare" => "BETWEEN",
        ];
    } elseif ($_GET["bouwjaarMin"]) {
        $bouwjaarMin = $_GET["bouwjaarMin"];

        $meta_query[5] = [
            "key" => "bouwjaar",

            "type" => "string",

            "value" => $bouwjaarMin,

            "compare" => ">=",
        ];
    } elseif ($_GET["bouwjaarMax"]) {
        $bouwjaarMax = $_GET["bouwjaarMax"];

        $meta_query[5] = [
            "key" => "bouwjaar",

            "type" => "string",

            "value" => $bouwjaarMax,

            "compare" => "=<",
        ];
    }

 
    if ($_GET["post-filters"]) {
        $post_filters = $_GET["post-filters"];

        foreach ($post_filters as $key => $post_filters_value) {
            if ($post_filters_value == "today") {
                $meta_query[6] = [
                    "key" => "lastChangeDate",

                    "value" => date("Y-m-d"),

                    "type" => "DATE",

                    "compare" => "=",
                ];
            } elseif ($post_filters_value == "yesterday") {
                $yesterday = date("Y-m-d", strtotime("-1 day"));

                $meta_query[6] = [
                    "key" => "lastChangeDate",

                    "value" => $yesterday,

                    "type" => "DATE",

                    "compare" => "=",
                ];
            } elseif ($post_filters_value == "one-week") {
                $meta_query[6] = [
                    "key" => "lastChangeDate",

                    "value" => [
                        date("Y-m-d", strtotime("-6 days")),
                        date("Y-m-d"),
                    ],

                    "type" => "DATE",

                    "compare" => "BETWEEN",
                ];
            } elseif ($post_filters_value == "all") {
                $meta_query[6] = [
                    "key" => "lastChangeDate",

                    "value" => ["1900-01-01", date("Y-m-d")],

                    "type" => "DATE",

                    "compare" => "BETWEEN",
                ];
            }
        }
    }

    if ($_GET["search"]) {
        $search = $_GET["search"];

        $meta_query[7] = [
            "relation" => "OR",

            [
                "key" => "art_code",

                "value" => $search,

                "compare" => "like",
            ],
            [
                "key" => "contact_persoon",

                "value" => $search,

                "compare" => "like",
            ],

            [
                "key" => "naam",

                "value" => $search,

                "compare" => "like",
            ],

            [
                "key" => "merk",

                "value" => $search,

                "compare" => "=",
            ],
        ];
    }

    global $wpdb;

    if (
        $_GET["main-category"] == "" &&
        $_GET["merk"] == "" &&
        $_GET["prijsmin"] == "" &&
        $_GET["prijsmax"] == "" &&
        $_GET["draaiurenMin"] == "" &&
        $_GET["draaiurenMax"] == "" &&
        $_GET["bouwjaarMin"] == "" &&
        $_GET["bouwjaarMax"] == "" &&
        $_GET["contact_filiaal"] == "" &&
        $_GET["search"] == "" &&
        $_GET["post-filters"] == ""
    ) {
        


        $args = [
            "posts_per_page" => 4,

            "post_type" => "machine",

            "post_status" => "publish",

            "meta_key" => "top",

            "meta_value" => "ja",

            "orderby" => "title",

            "order" => "ASC",

            "meta_query" => [
                "relation" => "AND",

                $meta_query,
            ],
        ];
    } else {
        $args = [
            "posts_per_page" => -1,

            "post_type" => "machine",

            "post_status" => "publish",

            "orderby" => "title",

            "order" => "ASC",

            "meta_query" => [
                "relation" => "AND",

                $meta_query,
            ],
        ];
    }

    $the_query = new WP_Query($args);

    $total = $the_query->found_posts;

    if ($the_query->have_posts()) {
        $html = "";

        while ($the_query->have_posts()) {
            $the_query->the_post();

            $post_id = get_the_ID();

            $art_code = get_post_meta($post_id, "art_code", true);

            $prijsexcl = get_post_meta($post_id, "prijsexcl", true);

            if ($prijsexcl) {
                if ($prijsexcl != "0.00") {

                    $prijsexcl = str_replace(',', '', $prijsexcl); 

                    $number_format=   number_format($prijsexcl, 2, ',', '.');
    
              
                        $prijsexclnew = "<br>Prijs:€" .$number_format;
                } else {
                    $prijsexclnew = "<br>Prijs: Op aanvraag";
                }
            }


            

            $bouwjaar = get_post_meta($post_id, "bouwjaar", true);

            $bouwjaarnew = "";

            if ($bouwjaar != 0) {
                $bouwjaarnew = "<br>Bouwjaar:" . $bouwjaar;
            }

            

            $draaiuren = get_post_meta($post_id, "draaiuren", true);

            $draaiurennew = "";
            if ($draaiuren != 0) {
                $draaiurennew = "<br>Draaiuren:" . $draaiuren;
            }

            $beschrijving = get_post_meta($post_id, "beschrijving", true);

            if (empty($beschrijving)) {
                $beschrijvingnew = "<br>Beschrijving:" . $beschrijving;
            }

            $top = get_post_meta($post_id, "top", true);

            if ($top) {
                $top = get_post_meta($post_id, "top", true);
            }

            if ($top == "Ja") {
                $topnew =
                    '<div class="top_occasions"><h2 class="top">Top</h2><p class="occasions">Occasions</p></div>';
            }

            $path = get_home_path();

            $image_path = $path . "/_occasions/images/" . $art_code;
            $full_img = $image_path . "/" . $art_code . "_" . "001.jpg";

            if (file_exists($full_img)) {
                $full_img =
                    site_url() .
                    "/_occasions/images/" .
                    $art_code .
                    "/" .
                    $art_code .
                    "_" .
                    "001.jpg";
            } else {
                $full_img =
                    site_url() . "/wp-content/uploads/image1.png";
            }

            $html .= '<div class="blog">';

            $html .= '<div class="blog-img">';

            $html .= $topnew;

            $html .=
                '<a href="' .
               get_permalink().
                '"><img src="' .
                $full_img .
                '"></a>';

               

            $html .= '<h2 class="blog-title">' . get_the_title() . "</h2>";

            $html .= "</div>";

            $html .= '<div class="grey">';

            $html .= '<div class="blog-content">';

            $html .=
                '<p class="blog-desc">' .
                "Artikelcode: $art_code" .
                "" .
                "$prijsexclnew" .
                "" .
                " $bouwjaarnew" .
                "" .
                "$draaiurennew" .
                "" .
                "$beschrijvingnew" .
                "</p>";

            $html .= '<div class="blog-details">';

            $html .=
                '<button id="fancyButton"><a href="' .
                get_permalink() .
                '">MEER INFO<span class="right-arrow"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" class="svg-triangle" width="20" height="20">
    <path style="fill:#fff;" d="M 15,10 5,15 5,5 z"></path>
  </svg></span></a></button>';

            $html .= "</div>";

            $html .= "</div>";

            $html .= "</div>";

            $html .= "</div>";

            wp_reset_postdata();
        }
    } else {
        $html = "Geen machines gevonden!";
    }

    if ($_GET["main-category"] != "" && $_GET["main-subcategory"] != "") {
        $parent_category_name1 = $_GET["main-subcategory"];

        $parent_category1 = get_term_by(
            "name",
            $parent_category_name1,
            "category"
        );

        if ($parent_category1) {
            $parent_category_id1 = $parent_category1->term_id;

            $subcategories1 = get_categories([
                "child_of" => $parent_category_id1,

                "hide_empty" => false,
            ]);

            if ($subcategories1) {
                $sub_select1 .=
                    '<option value="">--- Maak een keuze ---</option>';

                foreach ($subcategories1 as $subcategory1) {
                    // Access subcategory properties

                    $subcategory_name1 = $subcategory1->name;

                    $subcategory_id1 = $subcategory1->term_id;

                    $sub_select1 .=
                        '<option value="' .
                        $subcategory_name1 .
                        '">' .
                        $subcategory_name1 .
                        "</option>";
                }

                $sub_select1 .= "</select>";

                $return_arr[] = [
                    "sub_select1" => $sub_select1,
                    "html" => $html,
                    "filter_form" => $filter_form,
                    "total" => $total,
                ];
            } else {
                $return_arr[] = [
                    "html" => $html,
                    "filter_form" => $filter_form,
                    "total" => $total,
                ];
            }
        } else {
            echo "Parent category not found.";

            $return_arr[] = [
                "html" => $html,
                "filter_form" => $filter_form,
                "total" => $total,
            ];
        }
    }

    if ($_GET["main-category"] != "" && $_GET["main-subcategory"] == "") {
        $parent_category_name = $_GET["main-category"];

        $parent_category = get_term_by(
            "name",
            $parent_category_name,
            "category"
        );

        if ($parent_category) {
            $parent_category_id = $parent_category->term_id;

            $subcategories = get_categories([
                "child_of" => $parent_category_id,

                "hide_empty" => false,
            ]);

            if ($subcategories) {
                // Loop through the subcategories

                $sub_select = "";

                $sub_select .=
                    '<option value="">--- Maak een keuze ---</option>';

                foreach ($subcategories as $subcategory) {
                    // Access subcategory properties

                    $subcategory_name = $subcategory->name;

                    $subcategory_id = $subcategory->term_id;

                    $sub_select .=
                        '<option value="' .
                        $subcategory_name .
                        '">' .
                        $subcategory_name .
                        "</option>";
                }

                $return_arr[] = [
                    "sub_select" => $sub_select,
                    "html" => $html,
                    "filter_form" => $filter_form,
                    "total" => $total,
                ];
            } else {
                $return_arr[] = [
                    "html" => $html,
                    "filter_form" => $filter_form,
                    "total" => $total,
                ];
            }
        } else {
            $return_arr[] = [
                "html" => $html,
                "filter_form" => $filter_form,
                "total" => $total,
            ];
        }
    }

    if ($_GET["main-category"] == "" && $_GET["main-subcategory"] == "") {
        $return_arr[] = [
            "html" => $html,
            "filter_form" => $filter_form,
            "total" => $total,
        ];
    }

    echo json_encode($return_arr);

    exit();
}

add_action("wp_ajax_nopriv_myfilter1", "myfilter1");

add_action("wp_ajax_myfilter1", "myfilter1");

add_action("wp_ajax_nopriv_update_merk", "update_merk");

add_action("wp_ajax_update_merk", "update_merk");

function update_merk()
{
    if ($_POST["main-category"] != "") {
        $parent_name = $_POST["main-category"];
        $parent_term = get_term_by("name", $parent_name, "category");
        $meta_query = [];
        if (is_wp_error($parent_term)) {
            // Handle error if parent category is not found
        } else {
            $parent_id = $parent_term->term_id;
            $child_terms = get_term_children($parent_id, "category");

            if ($child_terms) {
                $meta_query[0] = [
                    "relation" => "OR",
                ];

                $sub_child_meta = [];
                foreach ($child_terms as $child) {
                    $child_term = get_term_by("id", $child, "category");
                    $child_name = $child_term->name;

                    $sub_child_meta = [
                        "key" => "categorie",
                        "value" => $child_name,
                        "compare" => "=",
                    ];

                    array_push($meta_query[0], $sub_child_meta);
                }
            } else {
                if ($_POST["main-category"]) {
                    $main_category = $_POST["main-category"];
                    $meta_query[0] = [
                        "key" => "categorie",
                        "value" => $main_category,
                        "compare" => "=",
                    ];
                }
            }
        }

        $args = [
            "posts_per_page" => -1,

            "post_type" => "machine",
            "post_status" => "publish",
            "orderby" => "title",
            "order" => "ASC",
            "meta_query" => [
                "relation" => "AND",
                $meta_query,
            ],
        ];

        $the_query = new WP_Query($args);

        $total = $the_query->found_posts;

        $merk_new = [];

        //$merk_new[] = "<option value=''>Select</option>";

        if ($the_query->have_posts()) {
            while ($the_query->have_posts()) {
                $the_query->the_post();

                $post_id = get_the_ID();

                $merk_select = get_post_meta($post_id, "merk", true);

                $merk_new[] = $merk_select;
                // $merk_new[] ="<option value='" .$merk_select ."'>" .$merk_select ."</option>";
            }


sort($merk_new); 
 // $merk_new[] = "<option value=''>Select</option>";
foreach ($merk_new as $merk) {
        $merk_new[]= "<option value='" . $merk . "'>" . $merk . "</option>";
    }


  





            if (!empty($merk_new)) {
                $merk_new = array_map('strtolower', $merk_new);
                $uniqueWords = array_unique($merk_new);
                $select_array=array("<option value=''>Select</option>");
                $uniqueWords=array_merge($select_array,$uniqueWords);
//print_r($array_merge);
                $merk_option = implode(" ", $uniqueWords);

                $return_arr1[] = [
                    "merk_option" => $merk_option,
                    "total" => $total,
                ];
            }
        } else {
            $merk_new = [];

            $merk_new[] = "<option value=''>Select</option>";

            $return_arr1[] = ["merk_option" => $merk_option, "total" => 0];
        }
    }

    echo json_encode($return_arr1);

    exit();
}

if (function_exists("acf_add_options_page")) {
    acf_add_options_page([
        "page_title" => "XML file",

        "menu_title" => "XML file",

        "menu_slug" => "theme-general-settings",

        "capability" => "edit_posts",

        "redirect" => false,
    ]);
}

add_action("wp_ajax_generate_pdf", "ajax_generate_pdf");

add_action("wp_ajax_nopriv_generate_pdf", "ajax_generate_pdf");

function ajax_generate_pdf()
{
    $naam = $_POST["naam"];

    $beschrijving = $_POST["beschrijving"];

    $art_code = $_POST["art_code"];

    $prijsexcl = $_POST["prijsexcl"];

    $bouwjaar = $_POST["bouwjaar"];

    $bandenvoor = $_POST["bandenvoor"];

    $bandenachter = $_POST["bandenachter"];

    $conditiemotor = $_POST["conditiemotor"];

    $conditietransmissie = $_POST["conditietransmissie"];

    $conditieslijtdelen = $_POST["conditieslijtdelen"];

    $uiterlijk = $_POST["uiterlijk"];

    $conditiehef = $_POST["conditiehef"];

    $merk = $_POST["merk"];

    $draaiuren = $_POST["draaiuren"];

    $cabine = $_POST["cabine"];

    $rijsnelheidmax = $_POST["rijsnelheidmax"];

    $werkbreedte = $_POST["werkbreedte"];

    $inhoud = $_POST["inhoud"];

    $elementen = $_POST["elementen"];

    $werkhoogte = $_POST["werkhoogte"];

    $vooras = $_POST["vooras"];

    $aftakas = $_POST["aftakas"];

    $aanhangerrem = $_POST["aanhangerrem"];

    $rijsnelheidmin = $_POST["rijsnelheidmin"];

    $hydraulischeventielen = $_POST["hydraulischeventielen"];

    $hefinrichtingachter = $_POST["hefinrichtingachter"];

    $hefinrichtingvoor = $_POST["hefinrichtingvoor"];

    $pk = $_POST["pk"];

    $html = "dvdsvsfdbvsdvzd";

    ob_start();

    require_once "TCPDF-main/tcpdf.php";

    $pdf = new TCPDF(
        PDF_PAGE_ORIENTATION,
        PDF_UNIT,
        PDF_PAGE_FORMAT,
        true,
        "UTF-8",
        false
    );

    $pdf->SetCreator(PDF_CREATOR);

    $pdf->SetAuthor("Nicola Asuni");

    $pdf->SetTitle("TCPDF Example 054");

    $pdf->SetSubject("TCPDF Tutorial");

    $pdf->SetKeywords("TCPDF, PDF, example, test, guide");

    $pdf->setFooterFont([PDF_FONT_NAME_DATA, "", PDF_FONT_SIZE_DATA]);

    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    if (@file_exists(dirname(__FILE__) . "/lang/eng.php")) {
        require_once dirname(__FILE__) . "/lang/eng.php";

        $pdf->setLanguageArray($l);
    }

    $pdf->setFontSubsetting(false);

    $pdf->SetFont("helvetica", "", 10, "", false);

    $pdf->AddPage();

    $pdf->writeHTML($html, true, 0, true, 0);

    $pdf->lastPage();

    ob_end_clean();

    $pdfName = "missing_00" . rand() . ".pdf";

    $pdf->Output(__DIR__ . "/machine_pdfs/" . $pdfName, "F");

    $pdfUrl = get_template_directory_uri() . "/machine_pdfs/" . $pdfName;

    $return_arrr[] = ["pdfUrl" => $pdfUrl];

    echo json_encode($return_arrr);

    die();
}



function custom_admin_menu() {
    add_menu_page(
        'xml sync', 
        'xml_sync', 
        'manage_options', 
        'xml_sync', 
        'xml_sync_sync_page' 
    );
}
add_action('admin_menu', 'custom_admin_menu');


function xml_sync_sync_page()  {

    ?>
    <div class="wrap">
        <h2>Sync Machines</h2>
        <form method="post">
            <button type="submit" name="sync_machines" style="background-color:#007a3d; color: white; padding: 10px 20px; border: none; border-radius: 5px;">Sync</button>
        </form>
    </div>

    <?php
    // Check if the sync button is clicked
    if (isset($_POST['sync_machines'])) {
        $post_type_to_delete = 'machine';
    global $wpdb;
    $sql = $wpdb->prepare("DELETE FROM {$wpdb->posts} WHERE post_type = %s", $post_type_to_delete);
    $wpdb->query($sql);



    //Delete All keys

    $sql = "DELETE FROM `wp_postmeta` WHERE meta_key IN ('art_code','naam','ag_code','beschrijving','categorie','prijsexcl','btw_marge','bouwjaar','tanden','nieuw','contact_persoon','contact_mobiel','conditieslijtdelen','uiterlijk','elementen','lastChangeDate','merk','top','draaiuren','bandenvoor','bandenachter','conditiemotor','conditietransmissie','gereserveerd_tot','contact_filiaal','contact_telefoon','cabine','conditiehef','vooras','hefinrichtingachter','aftakas','hydraulischeventielen','aanhangerrem','pk','inhoud','laadvermogen','rijsnelheidmin','rijsnelheidmax','werkbreedte','werkhoogte','hefinrichtingvoor','prijs_op_aanvraag','mtekst');";
    $wpdb->query($sql);

    
$xml_url= get_field('xml_url', 'option');
$xmldata = simplexml_load_file($xml_url) or die("Failed to load");
$total_nodes = count($xmldata->devices->device);
$nodes_processed =0;

        foreach($xmldata->devices->device as $empl_new) { 
           
            $art_code= $empl_new->art_code;   
            $naam=$empl_new->naam;    
            $ag_code=$empl_new->ag_code;
            $beschrijving= $empl_new->beschrijving;
            $categorie=  $empl_new->categorie; 
            $prijsexcl= $empl_new->prijsexcl;
            $btw_marge= $empl_new->btw_marge;
            $bouwjaar= $empl_new->bouwjaar;
            $tanden= $empl_new->tanden;
            $nieuw= $empl_new->nieuw; 
            $contact_persoon= $empl_new->contact_persoon; 
            $contact_mobiel= $empl_new->contact_mobiel;
            $conditieslijtdelen= $empl_new->conditieslijtdelen; 
            $uiterlijk= $empl_new->uiterlijk;
            $elementen= $empl_new->elementen;
            $lastChangeDate= $empl_new->lastChangeDate; 
            $merk= $empl_new->merk;
            $top=  $empl_new->top; 
            $draaiuren=  $empl_new->draaiuren; 
            $bandenvoor=  $empl_new->bandenvoor;
            $bandenachter=  $empl_new->bandenachter;
            $conditiemotor=  $empl_new->conditiemotor;
            $conditietransmissie=  $empl_new->conditietransmissie;
            $gereserveerd_tot=  $empl_new->gereserveerd_tot;
            $contact_filiaal=  $empl_new->contact_filiaal;
            $contact_telefoon=  $empl_new->contact_telefoon;
            $contact_telefoon=  $empl_new->contact_telefoon;
            $cabine=  $empl_new->cabine;
            $conditiehef=  $empl_new->conditiehef;
            $vooras=  $empl_new->vooras;
            $hefinrichtingachter=  $empl_new->hefinrichtingachter;
            $aftakas=  $empl_new->aftakas;
            $hydraulischeventielen=  $empl_new->hydraulischeventielen;
            $aanhangerrem=  $empl_new->aanhangerrem;
            $pk=  $empl_new->pk;
            $inhoud=  $empl_new->inhoud;
            $laadvermogen=  $empl_new->laadvermogen;
            $rijsnelheidmin=  $empl_new->rijsnelheidmin;
            $rijsnelheidmax=  $empl_new->rijsnelheidmax;
            $werkbreedte=  $empl_new->werkbreedte;
            $werkhoogte=  $empl_new->werkhoogte;
            $hefinrichtingvoor=  $empl_new->hefinrichtingvoor;
            $prijs_op_aanvraag=  $empl_new->prijs_op_aanvraag;
            $mtekst=  $empl_new->mtekst;
            $directory= ABSPATH.'IMG/'.$art_code; 
            $parent_category = get_term_by( 'name', $categorie, 'category' );
        if ( $parent_category ) {
        
          $parent_category_id = $parent_category->term_id;
        
        } 
        $my_post = array(

            'post_title'    => (string)$naam,
          
            'post_content'  => '',
          
            'post_status'   => 'publish',
          
            'post_type'     => 'machine',
          
            'post_category' => array($parent_category_id),
          
            
          
          );
          
           $post_id = wp_insert_post( $my_post );
          
          if($art_code){
          
              update_post_meta( $post_id, 'art_code',(string)$art_code );
          
          }
          
          
          if($naam){
          
              update_post_meta( $post_id, 'naam',(string)$naam );
          
          }
          
           if($ag_code){
          
              update_post_meta( $post_id, 'ag_code',(string)$ag_code );
          
          }
          
          if($beschrijving){
          
              update_post_meta( $post_id, 'beschrijving',(string) $beschrijving );
          
          }
          
          if($categorie){
          
              update_post_meta( $post_id, 'categorie',(string) $categorie );
          
          }
          
          if($prijsexcl){
          
              update_post_meta( $post_id, 'prijsexcl',(string) $prijsexcl );
          
          }
          
          if($btw_marge){
          
              update_post_meta( $post_id, 'btw_marge',(string)$btw_marge );
          
          }
          
          if($bouwjaar){
          
              update_post_meta( $post_id, 'bouwjaar',(string)$bouwjaar );
          
          }
          
          if($tanden){
          
              update_post_meta( $post_id, 'tanden',(string)$tanden );
          
          }
          
          if($nieuw){
          
              update_post_meta( $post_id, 'nieuw',(string)$nieuw );
          
          }
          
          if($contact_persoon){
          
              update_post_meta( $post_id, 'contact_persoon',(string)$contact_persoon );
          
          }
          
          
          if($contact_mobiel){
          
              update_post_meta( $post_id, 'contact_mobiel',(string)$contact_mobiel );
          
          }
          
          if($conditieslijtdelen){
          
              update_post_meta( $post_id, 'conditieslijtdelen',(string)$conditieslijtdelen );
          
          }
          
          
          if($uiterlijk){
          
              update_post_meta( $post_id, 'uiterlijk',(string)$uiterlijk );
          
          }
          
          
          if($elementen){
          
              update_post_meta( $post_id, 'elementen',(string)$elementen );
          
          }
          
          if($lastChangeDate){
          
              update_post_meta( $post_id, 'lastChangeDate',(string)$lastChangeDate );
          
          }
          
          if($merk){
          
              update_post_meta( $post_id, 'merk',(string)$merk );
          
          }
          
          
          if($top){
          
              update_post_meta( $post_id, 'top',(string)$top );
          
          }
          
          if($draaiuren){
          
              update_post_meta( $post_id, 'draaiuren',(string)$draaiuren );
          
          }
          
          if($bandenvoor){
          
              update_post_meta( $post_id, 'bandenvoor',(string)$bandenvoor );
          
          }
          
          if($bandenachter){
          
              update_post_meta( $post_id, 'bandenachter',(string)$bandenachter );
          
          }
          
          if($conditiemotor){
          
              update_post_meta( $post_id, 'conditiemotor',(string)$conditiemotor );
          
          }
          if($conditietransmissie){
          
              update_post_meta( $post_id, 'conditietransmissie',(string)$conditietransmissie );
          
          }
          
          if($gereserveerd_tot){
          
              update_post_meta( $post_id, 'gereserveerd_tot',(string)$gereserveerd_tot );
          
          }
          
          if(trim($contact_filiaal)){
          
              update_post_meta( $post_id, 'contact_filiaal',(string)$contact_filiaal );
              global $wpdb;
          
          $meta_key = 'contact_filiaal';
          
          $wpdb->query(
              $wpdb->prepare(
                  "
                  UPDATE $wpdb->postmeta
                  SET meta_value = TRIM(REGEXP_REPLACE(meta_value, '\\\\s+', ' '))
                  WHERE meta_key = %s
                  ",
                  $meta_key
              )
          );
          }
          
          if($contact_telefoon){
          
              update_post_meta( $post_id, 'contact_telefoon',(string)$contact_telefoon );
          
          }
          
          if($cabine){
          
              update_post_meta( $post_id, 'cabine',(string)$cabine );
          
          }
          
          if($conditiehef){
          
              update_post_meta( $post_id, 'conditiehef',(string)$conditiehef );
          
          }
          
          if($vooras){
          
              update_post_meta( $post_id, 'vooras',(string)$vooras );
          
          }
          
          if($hefinrichtingachter){
          
              update_post_meta( $post_id, 'hefinrichtingachter',(string)$hefinrichtingachter);
          
          }
          
          if($aftakas){
          
              update_post_meta( $post_id, 'aftakas',(string)$aftakas );
          
          }
          
          if($hydraulischeventielen){
          
              update_post_meta( $post_id, 'hydraulischeventielen',(string)$hydraulischeventielen);
          
          }
          
          if($aanhangerrem){
          
              update_post_meta( $post_id, 'aanhangerrem',(string)$aanhangerrem );
          
          }
          
          if($pk){
          
              update_post_meta( $post_id, 'pk',(string)$pk );
          
          }
          
          if($inhoud){
          
              update_post_meta( $post_id, 'inhoud',(string)$inhoud);
          
          }
          
          if($laadvermogen){
          
              update_post_meta( $post_id, 'laadvermogen',(string)$laadvermogen );
          
          }
          
          if($rijsnelheidmin){
          
              update_post_meta( $post_id, 'rijsnelheidmin',(string)$rijsnelheidmin);
          
          }
          
          if($rijsnelheidmax){
          
              update_post_meta( $post_id, 'rijsnelheidmax',(string)$rijsnelheidmax);
          
          }
          
          if($werkbreedte){
          
              update_post_meta( $post_id, 'werkbreedte',(string)$werkbreedte);
          
          }
          
          if($werkhoogte){
          
              update_post_meta( $post_id, 'werkhoogte',(string)$werkhoogte);
          
          }
          
          if($hefinrichtingvoor){
          
              update_post_meta( $post_id, 'werkhoogte',(string)$hefinrichtingvoor
          
               );
          
          }
          if($prijs_op_aanvraag){
          
              update_post_meta( $post_id, 'prijs_op_aanvraag',(string)$prijs_op_aanvraag);
          
          }
          
          if($mtekst){
          
              update_post_meta( $post_id, 'mtekst',(string)$mtekst);
          
          }
            $nodes_processed++;

            // Check if all nodes are processed
            if ($nodes_processed === $total_nodes) {
                break; // Stop the loop when all nodes are processed
            }
        }
        
        // Display success or failure message
        if ($nodes_processed === $total_nodes) {
            echo '<div style="color: green;">Sync successful!</div>';
        } else {
            echo '<div style="color: red;">Sync failed. Please try again.</div>';
        }
    }
}
