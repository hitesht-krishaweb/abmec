
<div class="col-lg-8">
    <?php while (have_posts()): the_post(); ?>
        <h1><?php echo the_title(); ?></h1>

        <?php the_content(); ?>
    <?php endwhile; ?>

        <?php $query = [
            'post_type' => 'vestiging',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'orderby' => 'title',
            'order' => 'ASC'
        ];

        $posts = get_posts($query); ?>

        <ul class="quick-links quick-links--inline">
            <?php foreach ($posts as $post) : ?>
                <li><svg class="icon-chevron icon-chevron--right"><use xlink:href="#chevron"></use></svg>
                    <a href="<?php echo get_permalink($post->ID); ?>" class="button">
                        <?php echo get_the_title($post->ID); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>

</div>