<?php  
global $stub;
?>

<div class="previews">
  <div class="previews__img">
    <img class="lazyload" src="<?php echo $stub; ?>" data-src="<?php echo wp_get_attachment_image_url( carbon_get_post_meta( $post->ID, 'img_home' ), 'full' ); ?>" alt="img">
    <!-- <img data-src="<?php //echo wp_get_attachment_image_url( carbon_get_post_meta( $post->ID, 'img_home' ), 'full' ); ?>" alt="img"> -->
  </div>
  <div class="previews__title">
    <h1 class="previews__head"><?php echo carbon_get_post_meta( $post->ID, 'title_home' ); ?></h1>
    <p class="previews__text"><?php echo carbon_get_post_meta( $post->ID, 'desc_home' ); ?></p>
  </div>
</div>