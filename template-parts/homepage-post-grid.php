<?php if(get_field('homepage_grid')): ?>
    <?php $gridItems = get_field('homepage_grid'); ?>

<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <a href="<?php echo $gridItems[0]['button']['url']; ?>" class="card card--large">
                    <figure>
                        <picture class="card__picture">
                            <source media="(min-width: 992px)" srcset="<?php echo $gridItems[0]['image']['url']; ?>">
                            <img src="<?php echo $gridItems[0]['image']['url']; ?>" alt="" style="width: 754px; height: 473px; object-fit: cover;">
                        </picture>
                        <figcaption class="card__caption">
                            <?php if($gridItems[0]['label']['label_text']): ?>
                                <span class="label label<?php echo $gridItems[0]['label']['color'] ? '--alt' : '' ?>"><?php echo $gridItems[0]['label']['label_text'] ?></span>
                            <?php endif; ?>
                            <h1 class="card__title"><?php echo $gridItems[0]['title']; ?></h1>
                            <span class="button">
                                        <svg class="icon-chevron icon-chevron--right"><use xlink:href="#chevron"></use></svg>
                                        <?php echo $gridItems[0]['button']['title']; ?>
                                    </span>
                        </figcaption>
                    </figure>
                </a>
                <div class="row">
                    <div class="col-6">
                        <a href="<?php echo $gridItems[3]['button']['url']; ?>" class="card">
                            <figure>
                                <picture class="card__picture">
                                    <source media="(min-width: 992px)" srcset="<?php echo $gridItems[3]['image']['url']; ?>">
                                    <img src="<?php echo $gridItems[3]['image']['url']; ?>" alt="" style="width: 363px; height: 252px; object-fit: cover;">
                                </picture>
                                <figcaption class="card__caption">
                                    <?php if($gridItems[3]['label']['label_text']): ?>
                                        <span class="label label<?php echo $gridItems[3]['label']['color'] ? '--alt' : '' ?>"><?php echo $gridItems[3]['label']['label_text'] ?></span>
                                    <?php endif; ?>
                                    <h3 class="card__title"><?php echo $gridItems[3]['title'] ?><svg class="icon-chevron icon-chevron--right"><use xlink:href="#chevron"></use></svg></h3>
                                </figcaption>
                            </figure>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="<?php echo $gridItems[4]['button']['url']; ?>" class="card">
                            <figure>
                                <picture class="card__picture">
                                    <source media="(min-width: 992px)" srcset="<?php echo $gridItems[4]['image']['url']; ?>">
                                    <img src="<?php echo $gridItems[4]['image']['url']; ?>" alt="" style="width: 363px; height: 252px; object-fit: cover;">
                                </picture>
                                <figcaption class="card__caption">
                                    <?php if($gridItems[4]['label']['label_text']): ?>
                                        <span class="label label<?php echo $gridItems[4]['label']['color'] ? '--alt' : '' ?>"><?php echo $gridItems[4]['label']['label_text'] ?></span>
                                    <?php endif; ?>
                                    <h3 class="card__title"><?php echo $gridItems[4]['title'] ?><svg class="icon-chevron icon-chevron--right"><use xlink:href="#chevron"></use></svg></h3>
                                </figcaption>
                            </figure>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <a href="<?php echo $gridItems[1]['button']['url']; ?>" class="card">
                    <figure>
                        <picture class="card__picture">
                            <source media="(min-width: 992px)" srcset="<?php echo $gridItems[1]['image']['url']; ?>">
                            <img src="<?php echo $gridItems[1]['image']['url']; ?>" alt="" style="min-width: 364px; height: 364px; object-fit: cover;">
                        </picture>
                        <figcaption class="card__caption">
                            <?php if($gridItems[1]['label']['label_text']): ?>
                                <span class="label label<?php echo $gridItems[1]['label']['color'] ? '--alt' : '' ?>"><?php echo $gridItems[1]['label']['label_text'] ?></span>
                            <?php endif; ?>
                            <h3 class="card__title"><?php echo $gridItems[1]['title'] ?><svg class="icon-chevron icon-chevron--right"><use xlink:href="#chevron"></use></svg></h3>
                        </figcaption>
                    </figure>
                </a>

                <a href="<?php echo $gridItems[2]['button']['url']; ?>" class="card">
                    <figure>
                        <picture class="card__picture">
                            <source media="(min-width: 992px)" srcset="<?php echo $gridItems[2]['image']['url']; ?>">
                            <img src="<?php echo $gridItems[2]['image']['url']; ?>" alt="" style="min-width: 364px; height: 364px; object-fit: cover;">
                        </picture>
                        <figcaption class="card__caption">
                            <?php if($gridItems[2]['label']['label_text']): ?>
                                <span class="label label<?php echo $gridItems[2]['label']['color'] ? '--alt' : '' ?>"><?php echo $gridItems[2]['label']['label_text'] ?></span>
                            <?php endif; ?>
                            <h3 class="card__title"><?php echo $gridItems[2]['title'] ?></h3>
                            <p class="card__subtitle"><?php echo $gridItems[2]['subtitle'] ?><svg class="icon-chevron icon-chevron--right"><use xlink:href="#chevron"></use></svg></p>
                        </figcaption>
                    </figure>
                </a>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>