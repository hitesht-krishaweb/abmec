<?php if(get_field('double_banner')): ?>
<?php $bannerItems = get_field('double_banner'); ?>
<section class="section section--secondary">
    <div class="container">
        <div class="row">
            <?php foreach($bannerItems as $bannerItem): ?>
            <div class="col-lg-6">
                <a href="<?php echo $bannerItem['link']['url']; ?>" class="card">
                    <figure>
                        <picture class="card__picture">
                            <source media="(min-width: 992px)" srcset="<?php echo $bannerItem['image']['url']; ?>">
                            <img src="<?php echo $bannerItem['image']['url']; ?>" alt="">
                        </picture>
                        <figcaption class="card__caption">
                            <h3 class="card__title"><?php echo $bannerItem['title'] ?>
                            <?php if(!$bannerItem['sub_title']): ?>
                                <svg class="icon-chevron icon-chevron--right"><use xlink:href="#chevron"></use></svg>
                            <?php endif; ?>

                            </h3>

                            <?php if($bannerItem['sub_title']): ?>
                                <p class="card__subtitle"><?php echo $bannerItem['sub_title'] ?> <svg class="icon-chevron icon-chevron--right"><use xlink:href="#chevron"></use></svg></p>
                            <?php endif; ?>

                        </figcaption>
                    </figure>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>