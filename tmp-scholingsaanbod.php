<?php
/**
 * Template Name: Scholingsaanbod Page.
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
			);

			$tquery = new WP_Query( $args );
			$i      = 1;
			if ( $tquery->have_posts() ) :
				?>
			<div class="col-12">
				<div class="accordion" id="accordiontraining">
				<?php
				while ( $tquery->have_posts() ) :
					$tquery->the_post();
					?>
					<div class="card">
						<div class="card-header" id="heading-<?php echo esc_attr( get_the_ID() ); ?>">
							<div class="row">
								<div class="training_acco_title col-lg-7 pl-0">
									<h2 class="mb-0">
										<?php the_title(); ?>
									</h2>
								</div>
								<div class="training_btn col-lg-5 pr-0">
									<button class="btn btn-link <?php echo esc_attr( ( 1 !== $i ) ? 'collapsed' : '' ); ?>" type="button" data-toggle="collapse" data-target="#collapse-<?php echo esc_attr( get_the_ID() ); ?>" aria-expanded="false" aria-controls="collapse-<?php echo esc_attr( get_the_ID() ); ?>">
										<span class="t_arrow"></span>Meer informatie
									</button>
									<a target="_blank" href="/aanmelden-scholing/?tid=<?php echo esc_attr( get_the_ID() ); ?>&pdname=scholingsaanbod" class="btn"><span class="t_arrow"></span>Aanmelden</a>
								</div>
							</div>
						</div>
						<div id="collapse-<?php echo esc_attr( get_the_ID() ); ?>" class="collapse <?php echo esc_attr( ( 1 === $i ) ? 'show' : '' ); ?>" aria-labelledby="heading-<?php echo esc_attr( get_the_ID() ); ?>">
							<div class="card-body">
								<div class="row">
									<div class="training_acco_content col-lg-8 pl-0">
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
											<?php if ( have_rows( 'sd_datum_locatie' ) ) : ?>
												<tr>
													<td>Datum / locatie</td>
													<td class="sd_datum_locatie">
													<?php
													while ( have_rows( 'sd_datum_locatie' ) ) :
														the_row();
														$datum       = get_sub_field( 'datum' );
														$locatie     = get_sub_field( 'locatie' );
														$nog_plekken = get_sub_field( 'nog_plekken' );
														echo sprintf(
															'%s - %1s %2s <br/>',
															esc_html( $datum ),
															esc_html( $locatie ),
															esc_html( $nog_plekken )
														);
														?>
														
													<?php endwhile; ?>
													</td>
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
									<div class="col-lg-4"></div>
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
get_footer();
