<?php
/*
* Template Name: AGENDA PAGE
*/
?>
<?php get_header();
global $wp;
$wp_request = home_url( $wp->request );
$requested_year = ( !empty( $_GET['year'] ) ) ? $_GET['year'] : date('Y');
$prev_year = $requested_year - 1;
$next_year = $requested_year + 1;
$month = ( !empty( $_GET['month'] ) ) ? $_GET['month'] : date('m');
$current_month = date('m');
?>
<section class="section">
  <div class="breadcrumbs">
    <div class="container">
      <?php custom_breadcrumbs(); ?>
    </div>
  </div>

  <article>
    <div class="agenda-wrap">
      <div class="container">
        <div class="row">
          <div class="col-lg-3">
            <div class="year-month-continer">
              <div class="year-listing">
                <div class="left">
                  <a href="javascript:void(0);" data-target="prev" class="nav-btn">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="10"
                      height="17.5"
                      viewBox="0 0 10 17.5"
                    >
                      <path
                        id="Path_1"
                        data-name="Path 1"
                        d="M.352-8.4A1.3,1.3,0,0,0,0-7.5a1.3,1.3,0,0,0,.352.9L7.852.9a1.3,1.3,0,0,0,.9.352A1.3,1.3,0,0,0,9.648.9,1.3,1.3,0,0,0,10,0a1.3,1.3,0,0,0-.352-.9L3.008-7.5l6.641-6.6A1.3,1.3,0,0,0,10-15a1.3,1.3,0,0,0-.352-.9,1.3,1.3,0,0,0-.9-.352,1.3,1.3,0,0,0-.9.352Z"
                        transform="translate(0 16.25)"
                        fill="#007a3d"
                      />
                    </svg>
                  </a>
                </div>
                <div class="center" data-year="<?php echo esc_html( $requested_year ); ?>"><?php echo esc_html( $requested_year ); ?></div>
                <div class="right">
                  <a href="javascript:void(0);" data-target="next" class="nav-btn">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="10"
                      height="17.5"
                      viewBox="0 0 10 17.5"
                    >
                      <path
                        id="Path_2"
                        data-name="Path 2"
                        d="M12.148-8.4a1.3,1.3,0,0,1,.352.9,1.3,1.3,0,0,1-.352.9L4.648.9a1.3,1.3,0,0,1-.9.352A1.3,1.3,0,0,1,2.852.9,1.3,1.3,0,0,1,2.5,0a1.3,1.3,0,0,1,.352-.9L9.492-7.5,2.852-14.1A1.3,1.3,0,0,1,2.5-15a1.3,1.3,0,0,1,.352-.9,1.3,1.3,0,0,1,.9-.352,1.3,1.3,0,0,1,.9.352Z"
                        transform="translate(-2.5 16.25)"
                        fill="#007a3d"
                      />
                    </svg>
                  </a>
                </div>
              </div>

              <button
                class="read-more-btn btn-icon btn-icon-left mobile-show toggle-month-btn"
                data-toggle="collapse"
                data-target="#toggle-month-wrap"
              >
                <div class="icon">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="8"
                    height="11.669"
                    viewBox="0 0 8 11.669"
                  >
                    <path
                      id="pointer-geel"
                      d="M0,11.669,8,5.834,0,0Z"
                      fill="#ffe100"
                    ></path>
                  </svg>
                </div>
                Filter op maand
              </button>

              <div class="month-listing toggle-month-wrap collpase in">
                <ul>
                  <?php
                  for ( $counter_month = 1; $counter_month <= 12; $counter_month++ ) {
                    $month_loop = date('F', mktime(0,0,0,$counter_month, 1, date('Y')));
                    $active_month = ( $counter_month == $current_month ) ? 'active' : '' ;

                    $monthQuery = $wpdb->get_var("SELECT count(ID) FROM $wpdb->posts WHERE post_type='agenda' AND (post_status = 'publish' OR post_status = 'future') AND YEAR(post_date) = ". $requested_year." AND MONTH(post_date) = ". $counter_month);

                    ?>
                    <li class="<?php echo $active_month; ?>">
                      <a href="#" data-target="month" data-month="<?php echo $counter_month; ?>">
                        <div class="left"><?php echo esc_html( dutch_format( $month_loop ) ); ?></div>
                        <div class="right"><?php echo esc_html( $monthQuery ); ?></div>
                      </a>
                    </li>
                    <?php 
                    wp_reset_postdata(); 
                  }
                  ?>
                </ul>
              </div>

              <!-- <div class="collapse" id="collapseExample">
                Some placeholder content for the collapse component. This panel
                is hidden by default but revealed when the user activates the
                relevant trigger.
              </div> -->
            </div>
          </div>
          <div class="col-lg-9">
            <div class="data-listing-wrap">
              <ul class="data-listing">
                <?php
                $args = array(
                    'posts_per_page' => -1,
                    'post_type' => 'agenda',
                    'post_status' => array( 'publish', 'future' ),
                    'orderby' => 'date',
                    'order' => 'ASC', 
                    'date_query' => array( 
                      array(
                        'year' => date( 'Y' ), 
                        'month' => $month 
                      ), 
                    ), 
                  ); 
                $the_query = new WP_Query( $args ); 
                if ( $the_query->have_posts() ) : 
                  while (
                    $the_query->have_posts() ) : $the_query->the_post();
                      get_template_part('template-parts/page', 'agenda-loop-content');
                  endwhile; 
                  wp_reset_postdata(); 
                else : ?>
                  <p><?php _e( 'Sorry, we hebben geen events in deze maand.' ); ?></p>
                <?php endif; ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </article>
</section>
<div class="lcp-loading"><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div></div>
<style>
  .lcp-loading{display: none;position:fixed;z-index:999;height:2em;width:2em;overflow:show;margin:auto;top:0;left:0;bottom:0;right:0}
  .lcp-loading:before{content:'';display:block;position:fixed;top:0;left:0;width:100%;height:100%;background-color:#148dcd8a}
  .lds-ellipsis{display:inline-block;position:relative;width:80px;height:80px}
  .lds-ellipsis div{position:absolute;top:33px;width:13px;height:13px;border-radius:50%;background:#fff;animation-timing-function:cubic-bezier(0,1,1,0)}
  .lds-ellipsis div:nth-child(1){left:8px;animation:lds-ellipsis1 .6s infinite}
  .lds-ellipsis div:nth-child(2){left:8px;animation:lds-ellipsis2 .6s infinite}
  .lds-ellipsis div:nth-child(3){left:32px;animation:lds-ellipsis2 .6s infinite}
  .lds-ellipsis div:nth-child(4){left:56px;animation:lds-ellipsis3 .6s infinite}
  @keyframes lds-ellipsis1{
    0%{transform:scale(0)}
    100%{transform:scale(1)
    }
  }
  @keyframes lds-ellipsis3{
    0%{transform:scale(1)}
    100%{transform:scale(0)}
  }
  @keyframes lds-ellipsis2{
    0%{transform:translate(0,0)}
    100%{transform:translate(24px,0)}
  }
</style>
<script type="text/javascript" >
  (function($){
    $(document).on('click', '.year-month-continer .month-listing ul li a, .year-month-continer .year-listing .nav-btn' ,function(){
      //console.log($(this).attr('data-target'));
      
      var data_year = $('.year-month-continer .year-listing .center').attr('data-year');
      var $dataTarget = $(this).attr('data-target');
      var trigger_year = 'no';
      var data_month = $(this).attr('data-month');
      if ( $dataTarget == 'next' ) {
        var trigger_year = 'yes';
        var $dataTager_year = $('.year-month-continer .year-listing .center').attr('data-year');
        var $dataTager_year = parseInt($dataTager_year) + parseInt(1);
        var data_year = $dataTager_year;
        $( '.year-month-continer .year-listing .center' ).html( $dataTager_year );
        $( '.year-month-continer .year-listing .center' ).attr( 'data-year', $dataTager_year );
        var data_month = 1;
      }
      if ( $dataTarget == 'prev' ) {
        var trigger_year = 'yes';
        var $dataTager_year = $('.year-month-continer .year-listing .center').attr('data-year');
        var $dataTager_year = parseInt($dataTager_year) - parseInt(1);
        var data_year = $dataTager_year;
        $( '.year-month-continer .year-listing .center' ).html( $dataTager_year );
        $( '.year-month-continer .year-listing .center' ).attr( 'data-year', $dataTager_year );
        var data_month = 1;
      }

      $('.year-month-continer .month-listing ul li').removeClass('active');
      $(this).parent().addClass('active');
      var $loader = $('.lcp-loading');
      $.ajax({
        url:'<?php echo admin_url( 'admin-ajax.php' ); ?>',
        method:'post',
        data: {
          'action': 'agenda_post_load',
          'data_month' : data_month,
          'trigger_year' : trigger_year,
          'data_year' : data_year,
          'nonce' : '<?php echo wp_create_nonce( 'agenda-post-nonce' ); ?>',
        },
        beforeSend: function() {
          $loader.show();
        },
        success:function(data) {
          // console.log(data.found_posts);
          $('.data-listing-wrap ul.data-listing').html('');
          $('.data-listing-wrap ul.data-listing').append(data.found_posts);
          if ( data.year_content != "" ) {
            $('.year-month-continer .month-listing ul').html('');
            $('.year-month-continer .month-listing ul').append(data.year_content);
          }

          $loader.hide();
        },
        complete:function(data){
          $loader.hide();
        },
        error: function(errorThrown){
          console.log(errorThrown);
          $loader.hide();
        }
      });
    });

  })(jQuery);
</script>
<?php get_footer(); ?>

