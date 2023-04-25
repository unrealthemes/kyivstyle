<?php
/**
 * Template name: Reviews
 */

get_header(); ?>

<?php if (have_posts()) : ?>

    <?php while (have_posts()) : the_post(); ?>

      <main class="site_content">
        <div class="all_reviews_wrap">
          <div class="container">
            <div class="all_reviews">
              <h2 class="all_reviews__head"><?php the_title(); ?></h2>
              <ul class="main_reviews">

                <?php
                  $args = array(
                      'posts_per_page'   => 6,
                      'post_status'      => 'publish',
                      'post_type'        => 'reviews'
                      
                  );
                  $query = new WP_Query( $args );

                  if ($query->found_posts <= 15) {
                      $class_btn = 'hide-btn';
                  } else {
                      $class_btn = '';
                  } 

                  if ( $query->have_posts() ):
                    while ( $query->have_posts() ): $query->the_post(); 

                      get_template_part('template-parts/reviews', 'loop');
                  
                    endwhile; 
                  endif; wp_reset_postdata(); ?>

              </ul>
            </div>

            <div class="see_all_wrap <?php echo $class_btn; ?>"><span class="main-btn load-more">Показать еще</span></div>
            <script>found_posts = '<?php echo $query->found_posts; ?>';</script>

          </div>
        </div>
      </main>

    <?php endwhile; ?>

<?php endif; ?>

<?php get_footer();