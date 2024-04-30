<div class="col-12 col-md-6 occasions-<?php echo get_the_ID();?>">
    <div class="product">
        <picture class="product__picture">
            <?php $top_occasions = get_post_meta(get_the_ID(), 'top', true );
            ?>
            <?php 
            if (isset($top_occasions) && $top_occasions == "Ja"): ?>
                <div class="top_occasions"><span class="top">Top</span><span class="occasions">Occasion</span></div>
            <?php endif; ?>
            <?php 
            $images = get_post_meta(get_the_ID(), 'afbeeldingenArray', false);
            $images_IMG = get_post_meta(get_the_ID(), 'IMG', false);
            $single_images = explode("|",$images_IMG['0']);
            ?>
            <a href="<?php the_permalink() ?>" class="item_details_link">
                <?php if (isset($images_IMG) && $images_IMG): ?>
                    <source media="(min-width: 576px)" srcset="<?php echo 'https://www.abemec.nl/_occasions/img/'.$single_images['0'] ?>">
                    <img src="<?php echo 'https://www.abemec.nl/_occasions/img/'.$single_images['0'] ?>" alt="">
                <?php else: ?>
                    <source media="(min-width: 576px)" srcset="<?php echo get_site_url().'/wp-content/uploads/placeholder.png' ?>">
                    <img src="<?php echo get_site_url().'/wp-content/uploads/placeholder.png' ?>" alt="">
                <?php endif; ?>
            </a>



            <?php /*if (isset($images) && $images): ?>
                <?php foreach ($images as $image): ?>
                    <source media="(min-width: 576px)" srcset="<?php echo $image[0] ?>">
                    <img src="<?php echo $image[0] ?>" alt="">
                <?php endforeach; ?>
            <?php else: ?>
                <source media="(min-width: 576px)" srcset="<?php echo get_site_url().'/wp-content/uploads/placeholder.png' ?>">
                <img src="<?php echo get_site_url().'/wp-content/uploads/placeholder.png' ?>" alt="">
            <?php endif;*/ ?>
        </picture>
        <div class="product__description">
            <a href="<?php the_permalink() ?>" class="item_details_link"><h3 class="product__name"><?php echo the_title(); ?></h3></a>

            <div class="product__meta">
                <?php $prijsexcl = str_replace(',', '',get_post_meta(get_the_ID(), 'prijsexcl', true)); ?>
                <span class="product__meta__item">Prijs: 
                <?php if (get_post_meta(get_the_ID(), 'prijsexcl', true) == "Op aanvraag" || get_post_meta(get_the_ID(), 'prijs_op_aanvraag', true) == "Op aanvraag" || get_post_meta(get_the_ID(), 'prijsexcl', true) == "" || get_post_meta(get_the_ID(), 'prijsexcl', true) == "0.00") { ?>
                    Op aanvraag
                <?php }else{ ?>
                    € <?php echo(formatPrice((float)$prijsexcl)); ?> ex. btw
                <?php } ?>
                </span>

                <span class="product__meta__item">Locatie: <?php echo(get_post_meta(get_the_ID(), 'contact_filiaal', true)); ?></span>
                <span class="product__meta__item">Bouwjaar: <?php echo(get_post_meta(get_the_ID(), 'bouwjaar', true)); ?></span>
                <span class="product__meta__item art_code">Artikelcode: <?php echo "<span style='text-transform: uppercase; '>".get_post_field( 'post_name', get_the_ID())."</span>";
 ?></span>
                <span class="product__meta__item">Draaiuren: <?php echo(get_post_meta(get_the_ID(), 'draaiuren', true)); ?></span>
            </div>

            <a href="<?php the_permalink() ?>" class="product__link button button--primary">
                Meer info
                <svg class="icon-chevron icon-chevron--right">
                    <use xlink:href="#chevron"></use>
                </svg>
            </a>
        </div>
    </div>
</div>