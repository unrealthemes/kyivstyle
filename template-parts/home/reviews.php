<?php 
global $stub;
$i = 1;
$args = array(
  'posts_per_page'   => 3,
  'post_status'      => 'publish',
  'post_type'        => 'reviews',
  'orderby'          => 'rand',
  
);
$query = new WP_Query( $args );

if ( $query->have_posts() ):
    while ( $query->have_posts() ): $query->the_post(); 

        $reviews[ $i ]['id']    = $post->ID;
        $reviews[ $i ]['img']   = carbon_get_post_meta($post->ID, 'img_reviews');
        $reviews[ $i ]['text']  = carbon_get_post_meta($post->ID, 'text_reviews');
        $reviews[ $i ]['title'] = get_the_title($post->ID);
        $reviews[ $i ]['speciality'] = carbon_get_post_meta($post->ID, 'speciality_reviews');
        $i++;

    endwhile; 
endif; 
wp_reset_postdata(); 
?> 

<div class="reviews_wrap">
    <div class="container">
        <h2 class="reviews__head"><?php echo carbon_get_post_meta($post->ID, 'title_reviews_home'); ?></h2>
        <div class="swiper-container reviews_slider">
            <div class="swiper-wrapper">

                <?php foreach ($reviews as $review): ?>

                    <div class="swiper-slide reviews">
                        <div class="previews__text"><?php echo $review['text']; ?></div>
                        <div class="reviews_controls__items">
                            <div class="controls_photo">
                                <img class="controls_img lazyload" src="<?php echo $stub; ?>" data-src="<?php echo wp_get_attachment_image_url($review['img'], 'full'); ?>" alt="img">
                            </div>
                            <div class="controls_text">
                                <p class="text_name"><?php echo $review['title']; ?></p>
                                <span class="text_prof"><?php echo $review['speciality']; ?></span>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>

            </div>
            <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
        <div class="reviews_controls">

            <?php $i = 1;
            foreach ($reviews as $review):

            if ($i == 1): ?>
            <div class="reviews_controls__items active_photo">
                <?php else: ?>
                <div class="reviews_controls__items">
                    <?php endif; ?>

                    <div class="controls_photo">
                        <img class="controls_img lazyload" src="<?php echo $stub; ?>" data-src="<?php echo wp_get_attachment_image_url($review['img'], 'thumbnail'); ?>" alt="img">
                    </div>
                    <div class="controls_text">
                        <p class="text_name"><?php echo $review['title']; ?></p>
                        <span class="text_prof"><?php echo $review['speciality']; ?></span>
                    </div>
                </div>

                <?php ++$i;
            endforeach; ?>

            </div>
            <div class="all_reviews__wrap">
                <?php $page_all_review = carbon_get_post_meta($post->ID, 'link_btn_reviews_home'); ?>

                <?php if (isset($page_all_review[0])): ?>
                    <a class="read_all_reviews" href="<?php echo get_the_permalink($page_all_review[0]['id']); ?>">
                        <?php echo carbon_get_post_meta($post->ID, 'text_btn_reviews_home'); ?>
                    </a>
                <?php endif; ?>

            </div>
        </div>
    </div>
