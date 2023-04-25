<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see       https://docs.woocommerce.com/document/template-structure/
 * @author    WooThemes
 * @package   WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

get_header();

  while ( have_posts() ) : the_post();

    // is product type variable
    if ( !$product->is_type('simple') && isset($_GET['color']) && !empty($_GET['color']) ) {

      $_SESSION['color'] = $_GET['color'];
    } else {

      if ( isset($_SESSION['color']) ) {
        unset($_SESSION['color']);
      }
    } 

    $stock = get_post_meta( $product->get_ID(), '_stock', true );
    ?>

    <main class="site_content">
        <div class="card_product_wrap">
          <div class="container container-sm card_container">

            <?php do_action( 'woocommerce_before_single_product' ); ?>

            <div class="card_product">

              <?php get_template_part( 'template-parts/product/slider' ); ?>

              <div class="card_product__info">
                <h3 class="card_product__name"><?php the_title(); ?></h3>

                 <div class="card_product__attributes">
                     <?php get_template_part( 'template-parts/product/attributes' ); ?>
                     <span class="card_product__price">
<!--                         <span class="price_product__single">-->
                             <?php echo $product->get_price_html(); ?>
<!--                         </span>-->
                     </span>
                 </div>
                
                <?php if ( $stock > 0 ) : ?>
                  
                  <p class="stock in-stock">Є в наявності</p>

                <?php endif; ?>

                <?php //echo wc_get_stock_html( $product ); ?>

                <?php get_template_part( 'template-parts/product/add-to-cart' ); ?>

                <p 
                  class="btn_one_click"
                  data-product_id="<?php echo $product->get_ID(); ?>"
                  data-variation_id=""
                  data-preorder="<?php // echo $preorder; ?>"
                  data-text="Купить в 1 клик"
                  data-title="<?php the_title(); ?>"
                  data-url="<?php echo get_the_permalink($product->get_ID()); ?>"
                  data-price='<?php echo json_encode( $product->get_price_html() ); ?>'
                  data-select="select-wrapper"
                  data-thumb="<?php echo get_the_post_thumbnail_url($product->get_ID(), 'shop_single'); ?>"

	              style="padding-bottom: 0px; margin-bottom: 30px; margin-top: -20px; <!--width: fit-content;-->"
                >
                  <span>КУПИТИ В 1 КЛІК</span>
                </p>

                <p class="card_product__text"><?php
	                $page_cont = wpautop($product->get_description());
					$added_class = str_replace('<p>', '<p class="card_product__text">', $page_cont);
					echo $added_class;
	                
	                ?></p>
              </div>
            </div>
          </div>
        </div>

        <?php get_template_part( 'template-parts/product/blocks' ); ?>

        <?php get_template_part( 'template-parts/product/sliders' ); ?>

    </main>

  <?php endwhile; // end of the loop. ?>

<?php get_footer();
