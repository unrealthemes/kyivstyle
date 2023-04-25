<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package notebook
 */

get_header(); ?>

	<main class="site_content">
      <div class="order_wrap">
        <div class="container">
          <div class="fullHD">

          	<?php
  				while ( have_posts() ) :
  					the_post();

  					get_template_part( 'template-parts/content', 'page' );

  				endwhile; // End of the loop.
			?>

          </div>
        </div>
      </div>
  </main>

<?php get_footer();