<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package notebook
 */

get_header(); ?>

	<main class="site_content">
      <div class="order_wrap">
        <div class="container">
            <div class="newsletter-success">

              <?php
      				while ( have_posts() ) :
      					the_post();

      					get_template_part( 'template-parts/content', 'page' );

      				endwhile;
      				?>
            </div>

        </div>
      </div>
  </main>

<?php get_footer();