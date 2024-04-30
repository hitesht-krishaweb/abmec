<?php

//response generation function
$response = "";

//function to generate response
function my_contact_form_generate_response($type, $message){

    global $response;

    if($type == "success") $response = "<div class='success'>{$message}</div>";
    else $response = "<div class='error'>{$message}</div>";

}
?>
<?php get_header(); ?>

<div class="breadcrumbs">
    <div class="container">
    </div>
</div>

<article class="product-detail">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 order-lg-last">
                <h1 class="product-detail__title"><?php the_title() ?></h1>
                <p><strong><?php echo( get_post_meta(get_the_ID(), 'beschrijving', true) ); ?></strong></p>
                <?php $images = (get_post_meta(get_the_ID(), 'afbeeldingenArray', false));
                $images_IMG = get_post_meta(get_the_ID(), 'IMG', false);
                $single_images = explode("|",$images_IMG['0']);
                $i = 0; 
                foreach($single_images as $image):
                    $i++;
                    $print_image = 'https://www.abemec.nl/_occasions/img/'.$image;
                    if( $i == 1 ){
                        break;
                    }
                endforeach;
                ?>
                <div id="pdf-image" style="display: none;">
                    <img src="<?php echo $print_image; ?>" style="width:700px"/>
                </div>
                <p class="product-detail__meta"><strong>Artikelcode </strong><?php echo( get_post_meta(get_the_ID(), 'art_code', true) ); ?></p>

                <dl class="product-detail__specs">

                    <dt>Prijs</dt>
                    <?php $prijsexcl = str_replace(',', '',get_post_meta(get_the_ID(), 'prijsexcl', true)); 
                    if (get_post_meta(get_the_ID(), 'prijsexcl', true) == "Op aanvraag" || get_post_meta(get_the_ID(), 'prijs_op_aanvraag', true) == "Op aanvraag" || get_post_meta(get_the_ID(), 'prijsexcl', true) == "" || get_post_meta(get_the_ID(), 'prijsexcl', true) == "0.00") { ?>
                        <dd>Op aanvraag</dd>
                    <?php }else{ ?>
                        <dd>€ <?php echo(formatPrice((float)$prijsexcl)); ?> ex. btw</dd>
                    <?php } ?>


                    <?php getMetaValuesOccasionPage(get_the_ID()); ?>
                </dl>

                <button onclick="window.print()" class="button">Print PDF</button>
<!--                <button class="button button--primary">Delen-->
<!--                    <svg class="icon-chevron icon-chevron--right"><use xlink:href="#chevron"></use></svg>-->
<!--                </button>-->
            </div>
            <div class="col-lg-8">
                <?php $images = (get_post_meta(get_the_ID(), 'afbeeldingenArray', false));
                $images_IMG = get_post_meta(get_the_ID(), 'IMG', false);
                $single_images = explode("|",$images_IMG['0']);
                ?>
                <?php if(!empty($images_IMG)): ?>
                <div class="product-detail__slider">
                    <div class="slider">
                        <div class="slick__slides">
                            <?php foreach($single_images as $image): ?>
                                <?php /*foreach($imageData as $image):*/ ?>
                            <div class="slider__slide">
                                <a id="enlarge" href="<?php echo 'https://www.abemec.nl/_occasions/img/'.$image ?>"><svg class="open-lightbox"><use xlink:href="#search"></use></svg></a><img src="<?php echo 'https://www.abemec.nl/_occasions/img/'.$image ?>" alt="" class="active__image slide__image">
                            </div>
                                <?php /*endforeach;*/ ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="slider__thumbs">
                            <div class="slick__slides">
                                <?php $i = 0; ?>
                                <?php foreach($single_images as $image): ?>
                                    <?php /*foreach($imageData as $image):*/ ?>
                                <div class="slider__thumbs__item" aria-label="Naar slide <?php echo $i; ?>" data-glide-dir="=<?php echo $i;  ?>">
                                    <img src="<?php echo 'https://www.abemec.nl/_occasions/img/'.$image ?>" alt="">
                                </div>
                                <?php $i++; ?>
                                <?php /*endforeach;*/ ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="product-detail__slider">
                        <div class="slider">
                            <div class="placeholder__slides">
                                <img src="<?php echo wp_upload_dir()['url'] . '/placeholder.png' ?>" alt="" class="slide__image">
                            </div>
                        </div>
                    </div>


                <?php endif; ?>
            </div>
        </div>

                <div class="row">
                    <div class="col-lg-6">
                        <h2>Is deze occasion nog beschikbaar?</h2>

                        <h3><?php echo get_post_meta(get_the_ID(), 'contact_filiaal', true) ?></h3>
                        <address>
                            Contactpersoon: <?php echo get_post_meta(get_the_ID(), 'contact_persoon', true) ?><br>
                            Mob.: <?php echo get_post_meta(get_the_ID(), 'contact_mobiel', true) ?><br>
                            Tel. nr.: <?php echo get_post_meta(get_the_ID(), 'contact_telefoon', true) ?>
                        </address>

                        <h3>Abemec occasioncentrum Veghel</h3>
                        <address>
                            Geert Heesakkers<br>
                            M +31 (0)654 757 021<br>
                            T +31 (0)413-382 185   F 0413-382217<br>
                            occasions@abemec.nl<br>
                        </address>
                    </div>
                    <div class="col-lg-6">
                        <h2>Neem contact op</h2>
                        <?php echo do_shortcode('[contact-form-7 id="27669" title="Formulier occasions"]'); ?>
                    </div>
                </div>
    </div>
</article>
<style type = "text/css">
      @media print {
        div#pdf-image {
        display: block !important;
        margin-bottom: 20px;
        }
      }
</style>
<?php get_footer(); ?>