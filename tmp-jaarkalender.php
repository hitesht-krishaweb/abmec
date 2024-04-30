<?php
/**
 * Template Name: Jaarkalender Page.
 *
 * @package WordPress.
 */

get_header();

get_template_part( 'partials/section', 'banner-train' ); ?>

<section class="section scholingsaanbod">
	<div class="breadcrumbs">
		<div class="container">
			<?php custom_breadcrumbs(); ?>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-12 scholingsaanbod-textarea"> 
				<?php if ( get_the_title() ) : ?>
					<h1><?php the_title(); ?></h1>
				<?php endif; ?>
				<?php the_field( 'page_descriptions' ); ?>
			</div>
			<?php
			$paged_t = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
			$args    = array(
				'post_type'      => 'training',
				'post_status'    => 'publish',
				'posts_per_page' => 50,
				'paged'          => $paged_t,
				'meta_key'       => 'jaarkalender_datum',
				'orderby'        => 'meta_value',
				'order'          => 'ASC',
			);

			$tquery = new WP_Query( $args );
			$i      = 1;
			if ( $tquery->have_posts() ) :
				?>
			<div class="col-12">
				<div class="accordion jaarkalender-acco" id="accordiontraining">
				<?php
				while ( $tquery->have_posts() ) :
					$tquery->the_post();
					$jaarkalender_datum   = get_field( 'jaarkalender_datum' );
					$kalender_starttijd   = get_field( 'kalender_starttijd' );
					$einde_kalendertijd   = get_field( 'einde_kalendertijd' );
					$jaarkalender_locatie = get_field( 'jaarkalender_locatie' );
					?>
					<div class="card <?php echo esc_attr( ( 1 === $i ) ? 'parentcollapse' : '' ); ?>">
						<div class="card-header" id="heading-<?php echo esc_attr( get_the_ID() ); ?>">
							<div class="row">
								<div class="date-head-col pl-0">
									<p class='date-head'><span class="t_arrow"></span>
										<?php
										 $dtt = gmdate( 'd M', dutch_strtotime( $jaarkalender_datum ) );
										if ( ! empty( $jaarkalender_datum ) ) :
											echo esc_html( dutch_abbr( $dtt ) );
										endif;
										// echo "<br>".$jaarkalender_datum;


										?>
									</p>
								</div>
								<div class="training_acco_title pl-0">
									<h2 class="mb-0 col-12">
										<?php the_title(); ?>
									</h2>
									<?php if ( ! empty( $kalender_starttijd ) || ! empty( $einde_kalendertijd ) || ! empty( $jaarkalender_locatie ) ) : ?>
										<div class="header-date-location col-12">
											<?php if ( ! empty( $kalender_starttijd ) || ! empty( $einde_kalendertijd ) ) : ?>
												<p class="header-date-time">
												<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
													<path fill="#666" d="M256 512C114.6 512 0 397.4 0 256S114.6 0 256 0S512 114.6 512 256s-114.6 256-256 256zM232 120V256c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2V120c0-13.3-10.7-24-24-24s-24 10.7-24 24z"/>
												</svg>
												<?php
													echo esc_html( $kalender_starttijd );
													echo ( ! empty( $kalender_starttijd ) && ! empty( $einde_kalendertijd ) ) ? '-' : '';
													echo esc_html( $einde_kalendertijd );
												?>
												</p>
											<?php endif; ?>
											<?php if ( ! empty( $jaarkalender_locatie ) ) : ?>
												<p class="header-location">
												<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
													<path fill="#666" d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 256c-35.3 0-64-28.7-64-64s28.7-64 64-64s64 28.7 64 64s-28.7 64-64 64z"/>
												</svg>
												<?php echo esc_html( $jaarkalender_locatie ); ?>
												</p>
											<?php endif; ?>
										</div>
									<?php endif; ?>
								</div>
								<div class="training_btn col-sm-12 pr-0">
									<button class="btn btn-link <?php echo esc_attr( ( 1 !== $i ) ? 'collapsed' : '' ); ?>" type="button" data-toggle="collapse" data-target="#collapse-<?php echo esc_attr( get_the_ID() ); ?>" aria-expanded="false" aria-controls="collapse-<?php echo esc_attr( get_the_ID() ); ?>">
										<span class="t_arrow"></span>Meer informatie
									</button>
									<a target="_blank" href="/aanmelden-scholing/?tid=<?php echo esc_attr( get_the_ID() ); ?>&pdname=jaarkalender" class="btn"><span class="t_arrow"></span>Aanmelden</a>
								</div>
							</div>
						</div>
						<div id="collapse-<?php echo esc_attr( get_the_ID() ); ?>"  class="accordion-collapse collapse <?php echo esc_attr( ( 1 === $i ) ? 'show' : '' ); ?>" aria-labelledby="heading-<?php echo esc_attr( get_the_ID() ); ?>" >
							<div class="card-body">
								<div class="row">
									<div class="training_acco_empty1"></div>
									<div class="training_acco_content col-sm-10 pl-0">
										<?php the_field( 'descriptions' ); ?>
										<?php
										$onderwerp          = get_field( 'onderwerp' );
										$aantal_deelnemers  = get_field( 'aantal_deelnemers' );
										$kosten_per_persoon = get_field( 'kosten_per_persoon' );
										$programma          = get_field( 'programma' );
										?>
										<table class="table table-borderless table-responsive">
											<?php if ( ! empty( $onderwerp ) ) : ?>
												<tr>
													<td>Onderwerp</td>
													<td><?php echo esc_html( $onderwerp ); ?></td>
												</tr>
											<?php endif; ?>
											<?php if ( ! empty( $aantal_deelnemers ) ) : ?>
												<tr>
													<td>Aantal deelnemers</td>
													<td><?php echo esc_html( $aantal_deelnemers ); ?></td>
												</tr>
											<?php endif; ?>
											<?php if ( ! empty( $kosten_per_persoon ) ) : ?>
												<tr>
													<td>Kosten per persoon</td>
													<td><?php echo esc_html( $kosten_per_persoon ); ?></td>
												</tr>
											<?php endif; ?>
											<?php if ( ! empty( $jaarkalender_datum ) ) : ?>
												<tr>
													<td>Datum</td>
													<td><?php echo esc_html( $jaarkalender_datum ); ?></td>
												</tr>
											<?php endif; ?>
											<?php if ( ! empty( $kosten_per_persoon ) ) : ?>
												<tr>
													<td>Tijd</td>
													<td>
													<?php
														echo esc_html( $kalender_starttijd );
														echo ( ! empty( $kalender_starttijd ) && ! empty( $einde_kalendertijd ) ) ? '-' : '';
														echo esc_html( $einde_kalendertijd );
													?>
													</td>
												</tr>
											<?php endif; ?>
											<?php if ( ! empty( $jaarkalender_locatie ) ) : ?>
												<tr>
													<td>Locatie</td>
													<td><?php echo esc_html( $jaarkalender_locatie ); ?></td>
												</tr>
											<?php endif; ?>
											<?php if ( ! empty( $programma ) ) : ?>
												<tr>
													<td>Programma</td>
													<td><?php echo wp_kses_post( $programma ); ?></td>
												</tr>
											<?php endif; ?>
										</table>
									</div>

								</div>	
							</div>
						</div>
					</div>
					<?php
					$i++;
				endwhile;
				?>
				</div>
			</div>
			<?php else : ?>
				<div class='col-12'>
					<h2>Scholingsaanbod not found!</h2>
				</div>
			<?php endif; ?>
		</div>
		<div class="row">
			<div class='col-12 mt-4 mb-sm-3 pagination d-flex justify-content-center'>
				<?php
				$big = 999999999;
				echo wp_kses_post(
					paginate_links(
						array(
							'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
							'format'    => '?paged=%#%',
							'current'   => max( 1, get_query_var( 'paged' ) ),
							'total'     => $tquery->max_num_pages,
							'type'      => 'list',
							'prev_text' => '«',
							'next_text' => '»',
						)
					)
				);
				?>
			</div>
		</div>
	</div>
</section>
<script>
	(function($){
		$('#accordiontraining').on('hide.bs.collapse', function (e) {
			$(e.target).parent().removeClass('parentcollapse');
		});
		$('#accordiontraining').on('show.bs.collapse', function (e) {
			$(e.target).parent().addClass('parentcollapse');
		});
	})(jQuery)
</script>

<?php

function dutch_strtotime($datetime) {

    $months = array(
        "januari"   => "January",
        "februari"  => "February",
        "maart"     => "March",
        "april"     => "April",
        "mei"       => "May",
        "juni"      => "June",
        "juli"      => "July",
        "augustus"  => "August",
        "september" => "September",
        "oktober"   => "October",
        "november"  => "November",
        "december"  => "December"
    );

    $array = explode(" ", $datetime);

    $array[1] = $months[strtolower($array[1])];
    return strtotime(implode(" ", $array));
}

function dutch_abbr($date) {

    $months = array(
        "jan"  => "jan",
        "feb"  => "feb",
        "mar"  => "mrt",
        "apr"  => "apr",
        "may"  => "mei",
        "Jun"  => "juni",
        "jul"  => "juli",
        "aug"  => "aug",
        "sept" => "sep",
        "oct"  => "okt",
        "nov"  => "nov",
        "dec"  => "dec"
    );

    $array = explode(" ", $date);
    $array[1] = $months[strtolower($array[1])];
    return implode(" ", $array);
}

get_footer();
