<?php
/**
 * Template name: Partners
 */

get_header(); ?>

<?php if (have_posts()) : ?>

    <?php while (have_posts()) : the_post(); ?>

      <main class="site_content">
        <div class="about_wrap">
          <div class="container container-sm">
            <div class="about">
              <div class="about__img">

                <?php if (has_post_thumbnail()):
                  $image_alt = get_post_meta($post->ID, '_wp_attachment_image_alt', true); ?>

                  <img src="<?php echo get_the_post_thumbnail_url($post->ID, 'full'); ?>" alt="<?php echo $image_alt; ?>">

                <?php endif; ?>

              </div>
              <!-- <h2 class="about__head"><?php //the_title(); ?></h2> -->
              <div class="about__text"><?php the_content(); ?></div>

            </div>
          </div>
        </div>
      </main>

    <?php endwhile; ?>

<?php endif; ?>

<?php get_footer();
