<?php 
global $product;

if ( $product->is_type('variable') ) {

    $attrs = $product->get_available_variations();
    $thumb_id = get_post_thumbnail_id( $product->get_id() );
} 
?>

<div class="card_product__wrapper">
    <div class="card_product__slider">
        <div class="swiper-container product_slider_wrap swiper-container-horizontal">
            <div class="swiper-wrapper card_product__img">

                <?php 
                $attachment_ids = $product->get_gallery_image_ids();
                $i = 1; 

                foreach ($attachment_ids as $attachment_id) { 

                    if ($i == 1) {
                        $slide_class = 'swiper-slide-active';
                    } else {
                        $slide_class = '';
                    } 

                    $video_link = '';
                    $image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'full' ) );
                    // $image_class = esc_attr( implode( ' ', $classes ) );
                    $image_title = esc_attr( get_the_title( $attachment_id ) );
                    $videolink_id = get_post_meta( $attachment_id, 'videolink_id', true );            
                    $video_site = get_post_meta( $attachment_id, 'video_site', true );  
                    $style = ( !empty( $videolink_id ) && !empty($video_site) ) ? 'style="padding-bottom: 0%;"' : '' ;                  
                    ?>

                    <div class="swiper-slide card_product__slide bg-video <?php echo $slide_class; ?>" <?php echo $style; ?>>

                        <?php if ( !empty( $videolink_id ) && 'vimeo' == $video_site ) : ?>
                            
                            <div class='embed-container'>
                                <iframe width="560" height="315" src="<?php echo $videolink_id; ?>" frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                            </div>

                        <?php elseif ( !empty( $videolink_id ) && 'youtube' == $video_site ) : 
                            parse_str( parse_url( $videolink_id, PHP_URL_QUERY ), $youtube_id ); ?>
                            
                            <div class='embed-container'>
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $youtube_id['v']; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>

                        <?php else : ?>

                            <img class="card_img" src="<?php echo wp_get_attachment_image_url($attachment_id, 'full'); ?>" alt="img">

                        <?php endif; ?>

                    </div>
                    <?php ++$i;
                } 

                if ( isset( $attrs ) && get_post_meta( $product->get_id(), '_display_thumbnail_variation', true ) == 'yes' ) {

                    foreach ($attrs as $attr) {

                        if ($attr['image_id']) { ?>
                            <div class="swiper-slide card_product__slide">
                                <img class="card_img" src="<?php echo $attr['image']['url']; ?>" alt="img">
                            </div>
                            <?php
                        }
                    }
                }
                ?>

            </div>
            <div class="swiper-pagination"></div>
        </div>
        <div class="card_product__thumbnail">
            <div class="card_product__mini">

                <?php 
                    $j = 1; 

                    foreach ($attachment_ids as $attachment_id) { 

                        if ($j == 1) {
                            $slide_class = 'active_mini';
                        } else {
                            $slide_class = '';
                        } 
                ?>

                    <div class="card_mini swiper-slide <?php echo $slide_class; ?>">
                        <div class="card_mini__image-wrap">
                            <img src="<?php echo wp_get_attachment_image_url($attachment_id, 'thumbnail'); ?>"
                                 alt="img">
                        </div>
                    </div>

                <?php 
                        ++$j;
                    } 

                    if ( isset( $attrs ) && get_post_meta( $product->get_id(), '_display_thumbnail_variation', true ) == 'yes' ) {

                        foreach ( $attrs as $attr ) {

                            if ( $attr['image_id'] ) { ?>

                                <!-- gallery_thumbnail_src -->
                                <div class="card_mini swiper-slide" data-slide="<?php echo $attr['variation_id']; ?>">
                                    <div class="card_mini__image-wrap">
                                        <img src="<?php echo $attr['image']['thumb_src']; ?>" alt="img">
                                    </div>
                                </div>

                                <?php
                            }
                        }
                    }
                ?>

            </div>
        </div>
    </div>
</div>
