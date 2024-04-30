<?php $menuLocations = get_nav_menu_locations();
$topMenuId = $menuLocations['top_menu'];

$topMenu = wp_get_nav_menu_items($topMenuId);

?>
<div class="header__content">
    <ul class="header__toplinks">
        <?php if($topMenu): ?>
        <?php foreach($topMenu as $item) : ?>
            <li class="header__toplinks__item <?php echo get_field('highlighted', $item) ? 'header__toplinks__item--highlight' : ''; ?>">
                <a href="<?php echo $item->url; ?>" target="<?php echo $item->target; ?>"><?php echo $item->title ?></a>
            </li>
        <?php endforeach; ?>
        <?php endif; ?>
    </ul>
    <?php get_search_form(); ?>

    <button class="nav-toggle" aria-label="Menu" data-module-nav-toggle>
        <span></span>
        <span></span>
        <span></span>
    </button>
</div>