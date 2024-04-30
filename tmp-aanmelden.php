<?php
/**
 * Template Name: Aanmelden Scholing Page.
 *
 * @package WordPress.
 */

get_header();

//get_template_part( 'partials/section', 'banner-train' ); ?>

<section class="section aanmelden-choling">
	<div class="breadcrumbs">
		<div class="container">
			<?php custom_breadcrumbs(); ?>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 scholingsaanbod-textarea">
				<?php if ( get_the_title() ) : ?>
						<h1><?php the_title(); ?></h1>
					<?php endif; ?>
				</div>
			<div class="aanmelden-form scholingsaanbod-textarea"> 
				<?php the_field( 'page_descriptions' ); ?>
				<div class="col-lg-12 aanmelden-form-inn">
					<hr>
					<?php echo do_shortcode( '[contact-form-7 id="2357345" title="Aanmelden Scholing"]' ); ?>
				</div>
			</div>
			<?php
			$info_heading = get_field( 'info_heading' );
			$info_image   = get_field( 'info_image' );
			$info_content = get_field( 'info_content' );
			?>
			<div class="aanmelden-heept-info">
				<?php if ( ! empty( $info_heading ) || ! empty( $info_content ) || ! empty( $info_image ) ) : ?>
					<div class="heept-info">
						<div class="heept-text">
							<div>
								<?php echo ( ! empty( $info_heading ) ) ? '<h3>' . esc_html( $info_heading ) . '</h3>' : ''; ?>
								<?php echo wp_kses_post( $info_content ); ?>
							</div>
						</div>
						<div class="heept-img" style="background-image:url('<?php echo esc_url( $info_image ); ?>');">
							
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
<?php
if ( isset( $_GET['tid'] ) && isset( $_GET['pdname'] ) || ! empty( $_GET['tid'] ) && ! empty( $_GET['pdname	'] ) ) :
	$getdata     = wp_unslash( $_GET );
	$tpost_id    = $getdata['tid'];
	$f_onderwerp = get_the_title( $tpost_id );
	$f_locatie   = get_field( 'jaarkalender_locatie', $tpost_id );
	$f_date      = get_field( 'jaarkalender_datum', $tpost_id );
	$f_time_s    = get_field( 'kalender_starttijd', $tpost_id );
	$f_time_e    = get_field( 'einde_kalendertijd', $tpost_id );
	$f_comb      = $f_date . '-' . $f_time_s . '-' . $f_time_e;

	?>
<script type="text/javascript" >
	(function($){
		$(window).bind('load',function(){
			<?php if ( 'scholingsaanbod' === $getdata['pdname'] ) : ?>
				$("select[name='scholing']").val("<?php echo esc_js( trim( $tpost_id ) ); ?>").change();
				setTimeout(() => {
					$("select[name='scholing']").trigger('change');
				}, 100);
			<?php else : ?>
				setTimeout(() => {
					$("select[name='scholing']").trigger('change');
				}, 100);
				
				$("select[name='scholing']").val("<?php echo esc_js( trim( $tpost_id ) ); ?>").change();

			<?php endif; ?>
		});
	})(jQuery);
</script>

<?php endif; ?>
<script type="text/javascript" >
	(function($){


		$(window).bind('load',function(){
			$("select[name='scholing'] option").each( function(){
				var $vl = $(this).val(), $txt = $(this).text();
				$(this).attr('data-trainingid', $vl).val($txt);
			});
		});
		$(document).on('change', 'select[name="scholing"]' ,function(){
			var $loader = $('.lcp-loading');
			var traningid = $(this).find('option:selected').attr('data-trainingid');
			$.ajax({
				url:'<?php echo admin_url( 'admin-ajax.php' ); ?>',
				method:'post',
				data: {
					'action': 'option_generat',
					'traningid' : traningid,
					'nonce' : '<?php echo wp_create_nonce( 'option-generat-nonce' ); ?>',
				},
				beforeSend: function() {
					$loader.show();
					$('select#locate-id').empty().append('<option></option>');
					$('select[name="datum"]').empty().append('<option></option>');
				},
				success:function(data) {
					$('select#locate-id').append(data.locations);
					$('select[name="datum"]').append(data.datetimes);
					<?php if ( isset( $getdata['pdname'] ) && 'jaarkalender' === $getdata['pdname'] ) : ?>
						$("select#locate-id").val('<?php echo $f_locatie; ?>').change();
						setTimeout(() => {
							$('select[name="datum"]').val('<?php echo $f_comb; ?>').change();
						}, 100);
					<?php endif; ?>
					
					$loader.hide();
				},
				complete:function(data){
					$('select[name="datum"] option[data-locate="<?php echo $f_locatie; ?>"]').show();
				},
				error: function(errorThrown){
					console.log(errorThrown);
					$loader.hide();
				}
			});
		});


		
		$(document).on('change', '.aanmelden-form-inn select' ,function(event){
			
			if( 'locatie' === $(this).attr('name') ){
				var attr = $(this).find('option:selected').val();
				var $val = $('select[name="datum"] option[data-locate="'+attr+'"]').val();
				$('select[name="datum"] option').hide()
				$('select[name="datum"] option[data-locate="'+attr+'"]').show();
				$('select[name="datum"]').val($val).trigger('click');
			}else if( 'datum' === $(this).attr('name') ){
				// var attr = $(this).find('option:selected').val();
				// var $val = $('select[name="locatie"] option[data-time="'+attr+'"]').val();
				// $('select[name="locatie"]').val($val).trigger('click');
			}
		});


		document.addEventListener( 'wpcf7submit', function( event ) {
			jQuery(event.target).removeClass('init');
		}, false );
		document.addEventListener( 'wpcf7invalid', function( event ) {
			setTimeout(function(){
				jQuery(event.target).removeClass('invalid').addClass('init');
			}, 4000 );
		}, false );

		document.addEventListener( 'wpcf7spam', function( event ) {
			setTimeout(function(){
				jQuery(event.target).removeClass('spam').addClass('init');
			}, 4000 );
		}, false );

		document.addEventListener( 'wpcf7mailsent', function( event ) {
			setTimeout(function(){
				jQuery(event.target).removeClass('mailsent').addClass('init');
			}, 4000 );
		}, false );

		document.addEventListener( 'wpcf7mailfailed', function( event ) {
			setTimeout(function(){
				jQuery(event.target).removeClass('mailfailed').addClass('init');
			}, 4000 );
		}, false );

	})(jQuery);
</script>
<div class="lcp-loading"><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div></div>
<style>
	.lcp-loading{display: none;position:fixed;z-index:999;height:2em;width:2em;overflow:show;margin:auto;top:0;left:0;bottom:0;right:0}.lcp-loading:before{content:'';display:block;position:fixed;top:0;left:0;width:100%;height:100%;background-color:#148dcd8a}.lds-ellipsis{display:inline-block;position:relative;width:80px;height:80px}.lds-ellipsis div{position:absolute;top:33px;width:13px;height:13px;border-radius:50%;background:#fff;animation-timing-function:cubic-bezier(0,1,1,0)}.lds-ellipsis div:nth-child(1){left:8px;animation:lds-ellipsis1 .6s infinite}.lds-ellipsis div:nth-child(2){left:8px;animation:lds-ellipsis2 .6s infinite}.lds-ellipsis div:nth-child(3){left:32px;animation:lds-ellipsis2 .6s infinite}.lds-ellipsis div:nth-child(4){left:56px;animation:lds-ellipsis3 .6s infinite}@keyframes lds-ellipsis1{0%{transform:scale(0)}100%{transform:scale(1)}}@keyframes lds-ellipsis3{0%{transform:scale(1)}100%{transform:scale(0)}}@keyframes lds-ellipsis2{0%{transform:translate(0,0)}100%{transform:translate(24px,0)}}
	input#btn-sub:hover + span + span.t_arrow {
		border-left-color: #fff;
	}
	.form-inner-btn input#btn-sub:hover {
		background-color: #007a3d;
		color: #ffff;
	}
	select[name="locatie"] option:empty,
	select[name="datum"] option:not(:checked) {
		display: none;
	}
</style>
<?php
get_footer();
