
<div class="col-lg-8">
<?php while (have_posts()): the_post(); ?>
    <h1><?php echo the_title(); ?></h1>

    <?php the_content(); ?>

<?php if(!get_the_content()): ?>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse sed porttitor dolor.
        Curabitur ut lorem erat. Nulla condimentum ac metus sit amet varius. Aliquam pretium
        consequat justo, ut venenatis neque dapibus a. Nunc et dapibus eros. Suspendisse vel
        magna augue. Nullam id arcu lacus. Ut rutrum, diam a convallis males</p>

    <h3>En dit is een sub kop op de pagina <?php echo the_title(); ?></h3>

    <p>Etiam facilisis ex eu est mollis maximus. Duis quis consectetur nunc. Vestibulum eget
        nisi vulputate, imperdiet arcu sodales, semper diam. Nunc placerat nunc erat, et
        interdum erat tincidunt non. Proin arcu magna, fringilla aliquet lacus vitae, lobortis
        faucibus nulla. Phasellus suscipit nisi metus, in porttitor lectus ullamcorper et.
        Pellentesque et rutrum mi. Donec nec massa vitae nulla congue molestie. Quisque egestas
        pharetra sapien, a laoreet est auctor a. Proin pulvinar lorem vestibulum, porttitor
        dolor eget, posuere magna. Sed bibendum tortor id velit consectetur vestibulum. Vivamus
        ultrices mauris mi, ut ornare libero mollis ut. Curabitur erat sapien, pulvinar id urna
        in, bibendum interdum magna. Pellentesque commodo dui ut pretium faucibus. Nulla
        pulvinar nisl ut dui finibus, iaculis pretium erat condimentum. Ut tincidunt ut ante id
        iaculis.</p>
    <?php endif; ?>
<?php endwhile; ?>

    <?php if(!get_field('hide_submenu')): ?>
    <?php get_template_part('template-parts/page', 'quicklinks-inline'); ?>
    <?php endif; ?>

    <?php if(have_rows('flex')): ?>
        <?php while(have_rows('flex')): the_row(); ?>
        <div style="margin-top: 1rem; margin-bottom: 1rem;">
            <?php the_sub_field('content'); ?>
            <?php get_template_part('template-parts/page', 'quicklinks-inline'); ?>
        </div>
        <?php endwhile; ?>
    <?php endif; ?>

</div>