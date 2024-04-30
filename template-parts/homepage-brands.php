<section class="section section--center" data-slider-brands>
    <div class="container">
        <h2 class="section__title">Onze merken</h2>
        <div class="clients">
            <div class="row">

                <?php $brands = get_field('brands', 'options'); ?>
                <?php if($brands): ?>
                <div class="glide__track" data-glide-el="track">
                    <ul class="glide__slides">
                <?php foreach($brands as $brand) : ?>
<!--                <div class="col-6 col-lg-2">-->



                    <li class="glide__slide">
                    <a href="" class="clients__item ">
                        <img src="<?php echo $brand['logo']['url']; ?>" alt="Massey Ferguson" class="clients__item__logo">
                    </a>
                    </li>

<!--                </div>-->
                <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <a href="<?php echo get_field('all_brands_page', 'options') ?>" class="button">
            <svg class="icon-chevron icon-chevron--right"><use xlink:href="#chevron"></use></svg>
            Bekijk alle merken
        </a>
    </div>
</section>