<?php $menu = get_field('menu'); ?>

<?php if(isset($menu) && $menu): ?>
<section>
    <div class="container">
        <ul class="quick-links quick-links--small" data-module-quicklinks>


            <?php foreach ($menu as $menuItems) : ?>
                <?php foreach ($menuItems as $menuItem): ?>
                    <li>
                        <a href="<?php echo $menuItem['url']; ?>" class="button button--secondary">
                            <?php echo $menuItem['title']; ?>
                        </a>
                    </li>

                <?php endforeach; ?>
            <?php endforeach; ?>

            <li class="quick-links__more" data-module-quicklinks-more data-width="166" aria-haspopup="true">
                <a href="" class="button button--secondary">Meer</a>
                <ul></ul>
            </li>
        </ul>
    </div>
</section>
<?php endif; ?>