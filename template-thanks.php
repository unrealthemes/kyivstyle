<?php
/**
 * Template name: Thanks
 */

get_header(); 
global $woocommerce;
$woocommerce->cart->empty_cart();
?>

<?php if (have_posts()) : ?>

    <?php while (have_posts()) : the_post(); ?>

      <main class="site_content" style="position: relative;">
        <div class="thanks_wrap">
          <div class="container thanks_container">
            <div class="thanks">
              <h2 class="thanks__head"><?php the_title(); ?></h2>
              <div class="thanks__text">
                <p>
                  Ваше замовлення

                  <?php if ( isset($_GET['order']) && !empty($_GET['order']) ) : ?>

                    <?php echo "№" . $_GET['order']; ?>

                  <?php endif; ?>

                  успішно оформлене. Ми зв'яжемося з вами найближчим часом для уточнення деталей.
                </p><br>
                <?php the_content(); ?>
              </div>
              <div class="back_to">
                <a class="main-btn back_to__magazine" href="<?php echo home_url(); ?>">Повернутися до магазину</a>
              </div>
            </div>
          </div>
        </div>
      </main>

    <?php endwhile; ?>

<?php endif; ?>

<?php get_footer();