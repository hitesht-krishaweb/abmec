</main>

<footer class="footer">
	<div class="footer__main">
		<div class="container">
			<div class="row">
				<h4 class="footer__big-title">
					<svg class="footer__logo"><use xlink:href="#logo-white"></use></svg>
					<?php echo get_field( 'footer_slogan', 'options' ); ?>
				</h4>
				<div class="footer__service d-lg-block col-lg-3">
					<!-- <img src="<?php // echo getThemeUrl(); ?>/assets/images/footer-service.png" alt="" class="footer__service__img"> -->
					<p class="footer__service__text">
						<?php echo get_field( 'text_footer', 'options' ); ?>
					</p>

				</div>
				<div class="col-lg-2">
					<ul class="footer__list">
						<?php $footerMenuItems = getMenuItems( 'Footer Menu' ); ?>
						<?php foreach ( $footerMenuItems as $footerMenuItem ) : ?>
							<li><a href="<?php echo $footerMenuItem['link']; ?>">
									<?php echo $footerMenuItem['title']; ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>

				<div class="col-lg-4 offset-lg-3 nieuwsbrief_volg">
					<div class="nieuwsbrief_content">
						<h4 class="footer__title">Nieuwsbrief</h4>
						<form action="/nieuwsbrief/" class="newsletter__form" method="post">
							<!--<input type="email" placeholder="E-mailadres..." class="newsletter__input" name="email">
							<input type="checkbox" name="mc4wp-subscribe" value="1" checked class="hidden" />-->
							<button class="newsletter__submit">Inschrijven</button>
						</form>
					</div>
					<div class="volg_content">       
						<h4 class="footer__title">Volg Abemec op</h4>
						<ul class="footer__social">
							<?php $socials = get_field( 'social_icons', 'options' ); ?>
							<?php foreach ( $socials as $social ) : ?>
								<li>
									<a href="<?php echo $social['url']; ?>" target="_blank" rel="noreferrer noopener" aria-label="Abemex <?php echo $social['channel']; ?>">
										<svg><use xlink:href="<?php echo $social['icon']; ?>"></use></svg>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<svg class="footer__cutout icon-chevron--down"><use xlink:href="#chevron"></use></svg>
	</div>

	<div class="footer__bottom footer__bottom_fff">
		<div class="container">
			<div class="row justify-content-between">
				<div class="col-lg-4">
					<p><?php echo get_field( 'copyright_footer', 'options' ); ?></p>
				</div>
				<div class="col-lg-8">
					<ul class="footer__bottom__links">
						<?php $footerBottomMenuItems = getMenuItems( 'Footer Bottom Menu' ); ?>
						<?php foreach ( $footerBottomMenuItems as $footerBottomMenuItem ) : ?>
							<li><a href="<?php echo $footerBottomMenuItem['link']; ?>"><?php echo $footerBottomMenuItem['title']; ?></a></li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<?php wp_footer(); ?>
</footer>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/slick-lightbox/0.2.12/slick-lightbox.js"></script>
<script type="text/javascript" src="https://www.abemec.nl/wp-content/themes/abemec/assets/js/jquery.flexslider.js"></script>
<script>
jQuery(document).ready(function() {
  jQuery('.flexslider').flexslider({
    animation: "slide",
	slideshow: true,
	slideshowSpeed: 5000,
	controlNav: true,
	directionNav: false
  });
});
</script>
<script type="text/javascript">
jQuery('select[name="main-category"], select[name="spec1"], select[name="spec2"]').on("change",function(){
	var maincategory_val = jQuery('select[name="main-category"]').find('option:selected').val();
	/*if(maincategory_val == ""){
		jQuery('select[name="main-category"]').addClass('add_color');
	}else{
		jQuery('select[name="main-category"]').removeClass('add_color');
	}*/

	var spec1_val = jQuery('select[name="spec1"]').find('option:selected').val();
	if(spec1_val == ""){
		jQuery('select[name="spec1"]').addClass('add_color');
	}else{
		jQuery('select[name="spec1"]').removeClass('add_color');
	}

	var spec2_val = jQuery('select[name="spec2"]').find('option:selected').val();
	if(spec2_val == ""){
		jQuery('select[name="spec2"]').addClass('add_color');
	}else{
		jQuery('select[name="spec2"]').removeClass('add_color');
	}

});

jQuery( document ).ready(function() {

	/*var maincategory_val = jQuery('select[name="main-category"]').find('option:selected').val();
	if(maincategory_val == ""){
		jQuery('select[name="main-category"]').addClass('add_color');
	}else{
		jQuery('select[name="main-category"]').removeClass('add_color');
	}*/

	var spec1_val = jQuery('select[name="spec1"]').find('option:selected').val();
	if(spec1_val == ""){
		jQuery('select[name="spec1"]').addClass('add_color');
	}else{
		jQuery('select[name="spec1"]').removeClass('add_color');
	}

	var spec2_val = jQuery('select[name="spec2"]').find('option:selected').val();
	if(spec2_val == ""){
		jQuery('select[name="spec2"]').addClass('add_color');
	}else{
		jQuery('select[name="spec2"]').removeClass('add_color');
	}
});
</script>
<style type="text/css">
.pp-arrow {
	position: absolute;
	top: 45%;
	transform: translateY(-50%);
	left: -20px;
	color: #007a3e;
	display: none;
}
.states, .spec2 {
	position: relative;
}
select.add_color[style="display: inline-block;"] + .pp-arrow {
	display: block;
}
select.add_color[style="display: inline-block;"] {
	color: #007a3e;
	border-color: #007a3e;
}
select[style="display: none;"] + .pp-arrow {
	display: none;
}
select.add_color[style="display: inline-block;"]:focus {
	outline-color: #007a3e !important;
}



/*
picture.product__picture a {
	display: block;
}

div#products picture.product__picture img{
	width: 100%;
	height: 340px;
	object-fit: cover;
}*/

/*div#products picture.product__picture img {
	width: 100%;
	object-fit: cover;
	height: 340px;
}

picture.product__picture a {
	display: block;
}*/

div#products picture.product__picture img {
	width: auto;
	height: 340px;
	margin: 0 auto;
	display: table;
}
.footer__service p.footer__service__text {
	position: unset;
}
footer.footer .footer__main {
	padding: 120px 0 30px 0;
}
.nieuwsbrief_volg {
	display: flex;
	justify-content: space-between;
}
.footer__bottom.footer__bottom_fff {
	padding-bottom: 30px;
}
.footer__bottom.footer__bottom_fff p {
	margin: 0;
}
@media screen and (max-width: 768px) {
    .footer__bottom.footer__bottom_fff {
		padding: 30px 0;
		padding-bottom: 15px;
	}
}
@media screen and (max-width: 767px) {
	footer.footer .footer__main {
		padding: 216px 0 30px 0;
	}
	.footer__bottom__links{
		flex-wrap: wrap;
	}
	svg.footer__logo{
		margin-bottom:0;
	}
    .nieuwsbrief_volg{
        flex-direction: column;
    }
}

</style>
<script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='PLAATS';ftypes[2]='text';fnames[3]='TYPE';ftypes[3]='text';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
</body>
</html>
