<?php
/**
 * Template name: Home
 */

get_header(); 

// $cache_key = 'load_products';
// $template = wp_cache_get( $cache_key );
?>

<?php if (have_posts()) : ?>

    <?php while (have_posts()) : the_post(); ?>

      <main class="site_content">

        <?php get_template_part('template-parts/home/main'); ?>

        <?php // get_template_part('template-parts/home/demo'); ?>

        <?php // if ( false !== $template ) : ?>

          <?php // echo $template; ?>

        <?php // else : ?>

          <!-- <div id="load_products">
            <div class="preloader-wrapper">
              <img src="<?php // echo get_template_directory_uri(); ?>/img/preloader.gif" alt="Preloader">
            </div>
            <?php // get_template_part('template-parts/home/product'); ?> 
          </div> -->

        <?php // endif; ?>

        <?php get_template_part('template-parts/home/product'); ?> 

        <?php get_template_part('template-parts/home/instagram'); ?>

        <?php get_template_part('template-parts/home/reviews'); ?>

      </main>

      <div class="seo-text"><?php echo carbon_get_post_meta( $post->ID, 'seo_text_home' ); ?></div>

    <?php endwhile; ?>

<?php endif; ?>

<script>
    var homeUrl = window.location.origin;
    document.addEventListener( 'wpcf7mailsent', function( event ) {
        location = homeUrl + '/thanks';
    }, false );
</script>

<?php get_footer();
