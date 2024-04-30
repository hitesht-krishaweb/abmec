<li class="data-card">
  <div class="content">
    <div class="inner">
      <div class="left">
        <div class="date"><?php echo esc_attr( get_field( 'agenda_date' ) ); ?></div>
        <h2 class="h2 data-title">
          <?php echo esc_attr( get_the_title() ); ?>
        </h2>
        <div class="location">
          <span class="title">Locatie:</span> <?php echo esc_attr( get_field( 'locations' ) ); ?>
        </div>
      </div>
      <div class="right">
        <div class="img-box">
          <?php
          the_post_thumbnail(
              'post-thumbnail',
              array(
                  'sizes' => '(max-width: 960px) 50vw, 430px', // Just an example.
              ),
          );
          ?>
        </div>
      </div>
    </div>

    <div class="read-more-wrap">
      <button class="read-more-btn btn-icon btn-icon-left">
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
            />
          </svg>
        </div>
        Meer informatie
      </button>
      <div class="read-more-content">
        <?php 
        $event_website_link_arr = get_field( 'event_website_link' );
        $event_website_link_title = $event_website_link_arr['title'];
        $event_website_link_url = $event_website_link_arr['url'];
        $event_website_link_target = ( '' !== $event_website_link_arr['target'] ) ? $event_website_link_arr['target'] : '_self';
        the_content();
        ?>
        <a target="<?php echo esc_attr( $event_website_link_target ); ?>" href="<?php echo esc_attr( $event_website_link_url ); ?>"><?php echo esc_attr( $event_website_link_title ); ?></a>
      </div>
    </div>
  </div>
</li>
