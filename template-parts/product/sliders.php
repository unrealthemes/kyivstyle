<?php
global $product, $stub;
$slider_1 = carbon_get_post_meta( $post->ID, 'rep_sl1_product' );
$slider_2 = carbon_get_post_meta( $post->ID, 'rep_sl2_product' );
?>

<div class="two_sliders_wrap">
  <div class="container container-sm">

    <!-- ==================================== SLIDER #1 ==================================== -->
    <ul class="flex_wrapper">
      <li class="swiper-container flex_wrapper__text slider_one_text swiper-container-horizontal">
        <div class="swiper-wrapper">

            <?php foreach($slider_1 as $item): ?>

                <div class="swiper-slide text_slides">
                    <h5 class="text_slides__head"><?php echo $item['title_rep_sl1_product']; ?></h5>
                    <p class="text_slides__text"><?php echo $item['desc_rep_sl1_product']; ?></p>
                </div>

            <?php endforeach; ?>

        </div>
        <div class="swiper-pagination swiper-pagination-fraction"></div>
        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
      </li>
      <li class="swiper-container flex_wrapper__foto slider_one_foto swiper-container-horizontal">
        <div class="swiper-wrapper">

            <?php foreach($slider_1 as $item):

                $src = wp_get_attachment_image_url( $item['img_rep_sl1_product'], 'full' );

                if(!empty($src)): ?>

              <div class="swiper-slide">
                  <img class="lazyload" src="<?php echo $stub; ?>" data-src="<?php echo $src; ?>" alt="img">
              </div>

            <?php endif;

            endforeach; ?>

        </div>
        <div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets"></div>
        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></li>
    </ul>

    <!-- ==================================== INFO BLOCK ==================================== -->
    <ul class="flex_wrapper_revers">
      <li class="swiper-container flex_wrapper__text swiper-container-horizontal">
        <div class="swiper-wrapper">
            <div class="swiper-slide text_slides">
                <h5 class="text_slides__head"><?php echo carbon_get_post_meta( $post->ID, 'title_info_product' ); ?></h5>
                <p class="text_slides__text"><?php echo carbon_get_post_meta( $post->ID, 'desc_info_product' ); ?></p>
            </div>
        </div>
        <div class="swiper-pagination swiper-pagination-fraction"></div>
        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
      </li>
      <li class="swiper-container flex_wrapper__foto swiper-container-horizontal slider_three_reverse">
        <div class="swiper-wrapper">

            <?php if(!empty(carbon_get_post_meta( $post->ID, 'img_info_product' ))):

                $src = wp_get_attachment_image_url( carbon_get_post_meta( $post->ID, 'img_info_product' ), 'full' ); ?>

                <div class="swiper-slide">
                    <img class="lazyload" src="<?php echo $stub; ?>" data-src="<?php echo $src; ?>" alt="img">
                </div>

            <?php endif; ?>

        </div>
        <div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets"></div>
        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></li>
    </ul>

    <!-- ==================================== SLIDER #2 ==================================== -->
    <ul class="flex_wrapper">
      <li class="swiper-container flex_wrapper__text slider_two_text swiper-container-horizontal">
        <div class="swiper-wrapper">

            <?php foreach($slider_2 as $item): ?>

                <div class="swiper-slide text_slides">
                    <h5 class="text_slides__head"><?php echo $item['title_rep_sl2_product']; ?></h5>
                    <p class="text_slides__text"><?php echo $item['desc_rep_sl2_product']; ?></p>
                </div>

            <?php endforeach; ?>

        </div>
        <div class="swiper-pagination swiper-pagination-fraction"></div>
        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
      </li>
      <li class="swiper-container flex_wrapper__foto slider_two_foto swiper-container-horizontal">
        <div class="swiper-wrapper">

            <?php foreach($slider_2 as $item):

                $src = wp_get_attachment_image_url( $item['img_rep_sl2_product'], 'full' );

                if(!empty($src)): ?>

                    <div class="swiper-slide">
                        <img class="lazyload" src="<?php echo $stub; ?>" data-src="<?php echo $src; ?>" alt="img">
                    </div>

                <?php endif;

            endforeach; ?>

        </div>
        <div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets"></div>
        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></li>
    </ul>

  </div>
</div>
