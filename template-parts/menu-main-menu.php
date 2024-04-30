<div class="navigation-bar">
    <div class="container">
        <nav class="nav" data-module-nav>
            <ul class="nav__list">
                <?php $menuItems = getMenuItems('Hoofdmenu');
                foreach( $menuItems as $item) :
                    $hasSub = !empty($item['children']);
                    ?>
                    <li class="nav__item <?php echo $item['css_class']; ?> <?php echo $hasSub ? 'has-sub' : '' ?>" aria-haspopup="true">
                        <a href="<?php echo $item['link']; ?>">
                            <?php echo $item['title']; ?>
                            <?php if($hasSub): ?>
                                <svg class="icon-chevron"><use xlink:href="#chevron"></use></svg>
                            <?php endif; ?>
                        </a>
                        <?php if($hasSub) {
                            $subItems = $item['children'];
                            // Display sub-menu items
                            if (!empty($subItems)) {
                                echo '<ul class="nav__sub">';
                                foreach ($subItems as $subItem) {
                                    echo '<li class="nav__sub__item">';
                                    echo '<a href="' . $subItem['link'] . '">' . $subItem['title'] . '</a>';
                                    
                                    // Check for sub-sub-menu items
                                    if (!empty($subItem['children'])) {
                                        echo '<ul class="nav__sub">';
                                        foreach ($subItem['children'] as $subSubItem) {
                                            echo '<li class="nav__sub__item">';
                                            echo '<a href="' . $subSubItem['link'] . '">' . $subSubItem['title'] . '</a>';
                                            echo '</li>';
                                        }
                                        echo '</ul>';
                                    }
                                    
                                    echo '</li>';
                                }
                                echo '</ul>';
                            }
                        } ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>
    </div>
</div>