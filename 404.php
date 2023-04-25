<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package notebook
 */

get_header(); ?>

  <main class="site_content">
    <div class="contacts_wrap">
      <div class="container contacts_container">
        <div class="contacts_main">
          <img class="img-error" src="<?php echo get_template_directory_uri(); ?>/img/404.gif" alt="error 404">
        </div>
      </div>
    </div>
  </main>

<?php get_footer();