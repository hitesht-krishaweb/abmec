<?php
/**
 * Template Name: Media Gallery Page.
 *
 * @package WordPress.
 */

get_header();

$method = $_GET;

if ( isset( $method['type'] ) && 'video' === $method['type'] ) :
	$class      = 'mb-4';
	$post_types = 'portfolio_video';
	$ppp        = 4;
	$page_title = get_field('videos_page_title');
else :
	$class      = 'mb-5';
	$post_types = 'portfolio_gallery';
	$ppp        = 6;
	$page_title = get_field('fotos_page_title');
endif;

?>
<?php get_template_part('template-parts/page', 'banner-media'); ?>
<?php get_template_part('template-parts/page', 'submenu-media'); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" />
<section class="section media-stl media-section-wraper">
	<div class="breadcrumbs">
		<div class="container">
			<?php custom_breadcrumbs(); ?>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-12 heading-title">
				<h1><?php echo ( $page_title != "" ) ? $page_title : get_the_title(); ?></h1>
			</div>
			<?php
			$gag_class = ( empty( $method ) || 'gallery' == $method['type'] ) ? 'active' : '';
			$gav_class = ( isset( $method['type'] ) && 'video' == $method['type'] ) ? 'active' : '';
			/* 
			?>
			<div class="col-12 tab-custom">
				<ul class="d-flex <?php echo esc_attr( $class ); ?>">
					<li class="nav-item">
						<a class="nav-link p-3 px-4 d-block <?php echo esc_attr( $gag_class ); ?>" aria-current="page" href="<?php echo esc_url( get_permalink() ); ?>?type=gallery">Foto’s</a>
					</li>
					<li class="nav-item">
						<a class="nav-link p-3 px-4 d-block <?php echo esc_attr( $gav_class ); ?>" href="<?php echo esc_url( get_permalink() ); ?>?type=video">Video’s</a>
					</li>
				</ul>
			</div>
			<?php
			 */
			$terms_i = get_terms(
				array(
					'taxonomy'   => 'video_cat',
					'parent'     => 0,
					'hide_empty' => true,
				)
			);

			if ( isset( $method['type'] ) && 'video' === $method['type'] ) :
				if ( ! empty( $terms_i ) && ! is_wp_error( $terms_i ) ) :
					?>
				<div class="col-12 categorylisting mb-3">
					<ul class="cat-terms d-flex">
						<?php
						foreach ( $terms_i as $termr ) :
							$ca_class = ( isset( $method['vid'] ) && $method['vid'] == $termr->term_id ) ? 'active-term' : '';
							?>
							<li class="<?php echo esc_attr( $ca_class ); ?>" >
								<a class="vidcat" href="<?php echo esc_url( get_the_permalink() ); ?>?type=video&vid=<?php echo esc_html( $termr->term_id ); ?>" >
																					<?php echo esc_html( $termr->name ); ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
					<?php
				endif;
			endif;
			?>
		</div>
		<?php
		$paged_g = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		$args    = array(
			'post_type'      => $post_types,
			'post_status'    => 'publish',
			'posts_per_page' => $ppp,
			'paged'          => $paged_g,
		);

		if ( isset( $method ) && ! empty( $method['vid'] ) ) :
			$args['tax_query'][] = array(
				'taxonomy' => 'video_cat',
				'field'    => 'term_id',
				'terms'    => array( (int) $method['vid'] ),
			);
		endif;

		if ( isset( $method ) && 'video' === $method['type'] ) :
			get_template_part( 'partials/section', 'videos', $args );
		else :
			get_template_part( 'partials/section', 'images', $args );
		endif;

		?>
	</div>
</section>

<style>
@import url('https://fonts.googleapis.com/css2?family=Kaushan+Script&family=Montserrat:wght@100;200;300;400;500;700&display=swap');
ul.quick-links.quick-links--small.data-module-quicklinks.banner_empty {
    margin-top: 20px;
}
.banner.media-banner {
    height: 200px;
}
.media-quick-links ul.quick-links.quick-links--small {
    margin-left: 0;
    margin-top: -24px;
}
section.media-section-wraper {
    padding-top: 30px;
}
section.media-section-wraper .breadcrumbs {
    margin: 0 0 30px 0;
}
.tab-custom ul {
	border-bottom: 2px solid #000;
}
.tab-custom ul a.nav-link.active {
	background-color: #fae24c;
}
.tab-custom ul a.nav-link {
	background-color: #ededed;
	margin-right: 8px;
	font-size: 32px;
	font-size: 16px;
	color: #347844;
	font-weight: 700;
	font-family: "Montserrat";
	padding: 7px 15px !important;
}
.heading-title h1 {
	font-size: 31px;
	color: #347844;
	font-weight: 700;
	font-family: "Montserrat";
}
.col-12.heading-title {
	padding-bottom: 40px;
}

.gallery-box{
	padding-bottom: 21px;
}

.gallery-box p.gallery-title {
	font-size: 18px;
	line-height: 26px;
	color: #347844;
	font-weight: 500;
	font-family: "Montserrat";
	padding: 10px 0 0;
	margin: 0;
}
/*.gallery-box p.gallery-title {
    padding-bottom: 40px;
}*/
.gallery-box img.img {
	min-height: 244px;
	object-fit: cover;
	max-height: 244px;
	height: 100%;
	width: 100%;
}
.gallery-box img.img {
	min-height: 300px;
	max-height: 300px;
}
.gallery-box .img-box {
	position: relative;
}
.img-box .img-overlay img {
	height: 24px;
	margin-bottom: 3px;
}
.img-box .img-overlay p {
	color: #fff;
	font-size: 18px;
	margin: 0;
	padding-top:22px;

}
.gallery-box .img-box:hover .img-overlay {
	visibility: visible;
	opacity: 1;
}
.img-box .img-overlay {
	position: absolute;
	top:0;
	width: 100%;
	height: 100%;
	display: flex;
	align-items: center;
	justify-content: center;
	flex-direction: column;
	background: #347844b3;
	transition: .4s all;
	visibility: hidden;
	opacity: 0;
	background-position: center 42%;
	background-repeat: no-repeat;
	background-size: 32px;
}
.gallery-box.video-box .img-box:hover .img-overlay{
	background-position: center;
	background-size: 44px;
}
.pagination ul.page-numbers {
	display: flex;
	flex-wrap: wrap;
	padding-left: 0;
	list-style: none;
	border-radius: 0.25rem;
}
.pagination ul.page-numbers li span, .pagination ul.page-numbers li a {
	position: relative;
	display: block;
	padding: 0.5rem 0.75rem;
	margin-left: -1px;
	line-height: 1.25;
	color: #347844;
	background-color: #fff;
	border: 1px solid #dee2e6;
	font-size: 16px;
	font-weight:600;
}
.pagination ul.page-numbers li:hover a,
.pagination ul.page-numbers li span.page-numbers.current {
	color: #fff;
	text-decoration: none;
	background-color: #347844;
	border-color: #347844;
}
ul.cat-terms li a {
	padding: 4px 16px;
	cursor: pointer;
	display: block;
	font-weight:700;
	font-size: 13px;
	margin-right: 8px;
	transition:.4s all;
	color:#347844;
	background-color:#ededed;
}
.categorylisting ul.cat-terms {
	flex-wrap: wrap;
}
.categorylisting ul.cat-terms li{
	margin-bottom:10px;
}
ul.cat-terms li:hover a,
ul.cat-terms li.active-term a {
	background-color: #fae24c;
}

@media(min-width:992px){
	.media-stl .tab-custom ul{
		margin-bottom: 38px !important;
	}
}
@media only screen and (max-width: 767.98px) {
	.media-quick-links ul.quick-links.quick-links--small {
		display: flex;
		justify-content: left;
	}
}
@media only screen and (min-width:550px) and ( max-width:767px ) {
	.gallery-box img.img{
		min-height: 330px;
		max-height: 330px;
	}
	.gallery-box p.gallery-title {
		padding-bottom: 20px;
	}
}
@media only screen and ( max-width:767px ){

}
</style>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>

<?php get_footer(); ?>
