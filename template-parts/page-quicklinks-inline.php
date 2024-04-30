<?php $menu = get_sub_field('menu') ? get_sub_field('menu'): get_field('menu') ; ?>

<?php if(isset($menu) && $menu): ?>
    <ul class="quick-links quick-links--inline">


        <?php foreach ($menu as $menuItems) : ?>
            <?php foreach ($menuItems as $menuItem): ?>
                <li><svg class="icon-chevron icon-chevron--right"><use xlink:href="#chevron"></use></svg>
                    <a href="<?php echo $menuItem['url']; ?>" class="button">
                        <?php echo $menuItem['title']; ?>
                    </a>
                </li>

            <?php endforeach; ?>
        <?php endforeach; ?>
    </ul>

<?php endif; ?>