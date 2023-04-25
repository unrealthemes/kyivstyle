<?php 
global $stub, $product;

$thumbnail_url = get_the_post_thumbnail_url( $product->get_id(), 'medium_large' );
// $image_alt = get_post_meta($product->get_id(), '_wp_attachment_image_alt', true);
$img_hover_id  = carbon_get_post_meta( $product->get_id(), 'hover_img_product' );
$img_hover = wp_get_attachment_image_src( $img_hover_id, 'medium_large' );
?>

<li id="<?php echo $product->get_id(); ?>" class="product_item" data-attr="product_1">  
    <div class="product__img__wrap">
        <a class="product__img__link" href="<?php echo $product->get_permalink(); ?>">

            <?php if ( $thumbnail_url ) : ?>
                <img class="product__img lazyload"  src="<?php echo $stub; ?>" data-src="<?php echo $thumbnail_url; ?>" alt="<?php // echo $image_alt; ?>">
            <?php endif; ?>

            <?php if ( $img_hover ) : ?>
                <img class="product__img product__img__hover lazyload" src="<?php echo $stub; ?>" data-src="<?php echo $img_hover[0]; ?>" alt="img2">
            <?php else: ?>
                <img class="product__img product__img__hover lazyload" src="<?php echo $stub; ?>" data-src="<?php echo get_template_directory_uri(); ?>/img/blocnot_hover.jpg" alt="img2">
            <?php endif; ?>

        </a>
        <button class="product__btn"
                name="btn_send"
                data-product_id="<?php echo $product->get_id(); ?>"
                data-variation_id=""
                data-text="Купити в 1 клік"
        ></button>
    </div>
    <a class="product__info" href="<?php echo $product->get_permalink(); ?>">
        <p class="product__name"><?php echo $product->get_name(); ?></p>
        <p class="product__low">

            <?php if ( isset($product_color_default) ) : ?>

                <span class="product__color"><?php echo $product_color_default; ?></span>
                <span class="product__price"><?php echo json_decode($price); ?></span>

            <?php 
                $product_color_default = null; 
            else: 
            ?>
                <span class="product__price"><?php echo $product->get_price_html(); ?></span>
            <?php endif; ?>

        </p>
    </a>
    <p  class="product__low btn_click"
        data-product_id="<?php echo $product->get_id(); ?>"
        data-variation_id=""
        data-text="Купити в 1 клік"
    >
        <span>КУПИТИ В 1 КЛІК</span>
    </p>
</li>