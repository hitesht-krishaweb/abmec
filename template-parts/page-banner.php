<?php

$banner = get_field('banner');
?>

<?php if ($banner): ?>

    <div class="banner">
        <picture>
            <img src="<?php echo $banner['url']; ?>" alt="" class="slide__image">
        </picture>
    </div>
<?php endif; ?>