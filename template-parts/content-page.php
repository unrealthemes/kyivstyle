<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package notebook
 */

?>

<div id="post-<?php the_ID(); ?>" <?php post_class("about"); ?>>
	<div class="about__img">

	<?php if (has_post_thumbnail()):
		$image_alt = get_post_meta($post->ID, '_wp_attachment_image_alt', true); ?>

		<img src="<?php echo get_the_post_thumbnail_url($post->ID, 'full'); ?>" alt="<?php echo $image_alt; ?>">

	<?php endif; ?>

	</div>
	<h2 class="about__head"><?php the_title(); ?></h2>
	<div class="about__text"><?php the_content(); ?></div>

</div>
<!-- #post-<?php the_ID(); ?> -->