<?php
/**
 * Template name: Contract
 */

get_header(); ?>

<?php if (have_posts()) : ?>

    <?php while (have_posts()) : the_post(); ?>

      <main class="site_content">
        <div class="about_wrap">
          <div class="container container-sm">
            <div class="about">
              <div class="contract_text"><?php the_content(); ?></div>
            </div>
          </div>
        </div>
      </main>

    <?php endwhile; ?>

<?php endif; ?>

<?php get_footer();
