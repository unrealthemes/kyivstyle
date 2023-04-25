
<li class="main_reviews__items" data-post-id="<?php echo $post->ID; ?>">
  <div class="main_reviews__people">
    <div class="controls_photo">
      <img src="<?php echo wp_get_attachment_image_url( carbon_get_post_meta( $post->ID, 'img_reviews' ), 'full' ); ?>" alt="img">
    </div>
    <div class="controls_text">
      <p class="text_name"><?php the_title(); ?></p>
      <span class="text_prof"><?php echo carbon_get_post_meta( $post->ID, 'speciality_reviews' ); ?></span>
    </div>
  </div>
  <div class="main_reviews__text"><?php echo carbon_get_post_meta( $post->ID, 'text_reviews' ); ?></div>
</li>
