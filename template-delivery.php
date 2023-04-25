<?php
/**
 * Template name: Delivery
 */

get_header(); ?>

<?php if (have_posts()) : ?>

    <?php while (have_posts()) : the_post(); 

      $blocks_delivery = carbon_get_post_meta( $post->ID, 'rep_delivery' ); 
      $blocks_payment  = carbon_get_post_meta( $post->ID, 'rep_payment' ); ?>

      <style>
        .delivery_low__head:after {
            content: "";
            position: absolute;
            top: 50%;
            left: 0;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translateY(-50%);
            width: 60px;
            height: 60px;
            background: url(<?php echo wp_get_attachment_image_url( carbon_get_post_meta( $post->ID, 'img_delivery' ), 'full' ); ?>) no-repeat center center;
            -webkit-background-size: contain;
            background-size: contain;
        }
        .delivery_low__items:nth-child(2) .delivery_low__head:after {
          background: url(<?php echo wp_get_attachment_image_url( carbon_get_post_meta( $post->ID, 'img_payment' ), 'full' ); ?>) no-repeat center center;
          -webkit-background-size: contain;
          background-size: contain;
        }
      </style>

      <main class="site_content">
        <div class="delivery_wrap">
          <div class="container delivery-container">
            <div class="delivery">
              <h2 class="delivery__head"><?php the_title(); ?></h2>
              <div class="delivery__text"><?php the_content(); ?></div>
              <ul class="delivery_low">
                <li class="delivery_low__items">
                  <h3 class="delivery_low__head"><?php echo carbon_get_post_meta( $post->ID, 'title_delivery' ); ?></h3>

                  <?php foreach((array)$blocks_delivery as $block): ?>
                    <h5 class="delivery_low__subhead"><?php echo $block['title_rep_delivery']; ?></h5>
                    <p class="delivery_low__subtext"><?php echo $block['desc_rep_delivery']; ?></p>
                  <?php endforeach; ?>

                </li>
                <li class="delivery_low__items">
                  <h3 class="delivery_low__head"><?php echo carbon_get_post_meta( $post->ID, 'title_payment' ); ?></h3>

                  <?php foreach((array)$blocks_payment as $block): ?>
                    <h5 class="delivery_low__subhead"><?php echo $block['title_rep_payment']; ?></h5>
                    <p class="delivery_low__subtext"><?php echo $block['desc_rep_payment']; ?></p>
                  <?php endforeach; ?>

                </li>
              </ul>
              <div class="back_to"><a class="main-btn back_to__shop" href="<?php echo home_url(); ?>">Повернутись до магазину</a></div>
            </div>
          </div>
        </div>
      </main>

    <?php endwhile; ?>

<?php endif; ?>

<?php get_footer();