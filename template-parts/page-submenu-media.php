<?php
$banner = get_field('banner');
$banner_empty = ( '' == $banner ) ? 'banner_empty' : '';
?>
<?php $menu = get_field('menu'); ?>

<?php
$gag_class = ( empty( $method ) || 'gallery' == $method['type'] ) ? 'active' : '';
$gav_class = ( isset( $method['type'] ) && 'video' == $method['type'] ) ? 'active' : '';
?>
<?php if(isset($menu) && $menu): ?>
<section class="media-quick-links">
    <div class="container">
        <ul class="quick-links quick-links--small data-module-quicklinks <?php echo $banner_empty; ?>">
            <?php foreach ($menu as $menuItems) : ?>
                <?php foreach ($menuItems as $menuItem): ?>
                    <li>
                        <a href="<?php echo $menuItem['url']; ?>" class="button button--secondary <?php echo esc_attr( $gag_class ); ?>">
                            <?php echo $menuItem['title']; ?>
                        </a>
                    </li>

                <?php endforeach; ?>
            <?php endforeach; ?>
        </ul>
    </div>
</section>
<?php endif; ?>