<section>
<div class="container">
    <ul class="quick-links quick-links--homepage">
        <?php $menuLocations = get_nav_menu_locations();
        $quicklinksId = $menuLocations['quick_links'];

        $quicklinks = wp_get_nav_menu_items($quicklinksId); ?>

        <?php foreach($quicklinks as $menuItem) : ?>
        <li>
            <a href="<?php echo $menuItem->url; ?>" class="button button--secondary">
                <svg class="icon-chevron icon-chevron--right"><use xlink:href="#chevron"></use></svg>
                <?php echo $menuItem->title; ?>
            </a>
        </li>
        <?php endforeach; ?>
    </ul>
</div>
</section>