<?php 
global $stub, $product;

$currency   = get_woocommerce_currency_symbol();
$img_hover  = carbon_get_post_meta( $product->get_id(), 'hover_img_product' );
$available_variations = $product->get_available_variations();
$thumbnail_url = get_the_post_thumbnail_url( $product->get_id(), 'medium_large' );

foreach ( $available_variations as $key => $value ) :
    $img_hover_id = get_post_meta( $value['variation_id'], '_upload_hover_id', true );

    if (!empty($value['price_html'])) {
        $main_price = $value['price_html'];
    } else {
        $main_price = $value['display_price'] . ' ' . $currency;
    } ?>

    <li id="<?php echo $value['variation_id']; ?>" class="product_item" data-attr="product_1">  
        <div class="product__img__wrap">
            <a class="product__img__link" href="<?php echo $product->get_permalink().'?color='.$value['attributes']['attribute_pa_color']; ?>">

                <?php 
                if ( $value['image']['url'] ) :
                    $data_thumb = $value['image']['url']; 
                ?> 

                    <img class="product__img lazyload" src="<?php echo $stub; ?>" data-src="<?php echo $data_thumb; ?>">

                <?php 
                elseif ( $thumbnail_url ) : 
                    $data_thumb = $thumbnail_url;
                ?>

                    <img class="product__img lazyload" src="<?php echo $stub; ?>" data-src="<?php echo $thumbnail_url; ?>">

                <?php 
                else :
                    $data_thumb = "";
                endif; 
                ?>

                <?php 
                if ( $img_hover_id ) : 
                    $img_hover_src = wp_get_attachment_image_src( $img_hover_id, 'medium_large' ); 
                ?>

                    <img class="product__img product__img__hover lazyload" src="<?php echo $stub; ?>" data-src="<?php echo $img_hover_src[0]; ?>" alt="img2">

                <?php 
                elseif ( $img_hover ) : 
                    $img_hover = wp_get_attachment_image_src( $img_hover, 'medium_large' ); 
                ?>

                    <img class="product__img product__img__hover lazyload" src="<?php echo $stub; ?>" data-src="<?php echo $img_hover[0]; ?>" alt="img2">

                <?php endif; ?>

            </a>
            <button class="product__btn"
                    name="btn_send"
                    data-product_id="<?php echo $product->get_id(); ?>"
                    data-variation_id="<?php echo $value['variation_id']; ?>"
                    data-text="Купити в 1 клік"
            ></button>
        </div>
        <a class="product__info" href="<?php echo $product->get_permalink().'?color='.$value['attributes']['attribute_pa_color']; ?>">
            <p class="product__name"><?php echo $product->get_name(); ?></p>
            <p class="product__low">
                <span class="product__color"><?php echo get_attr_name_by_slug( $value['attributes']['attribute_pa_color'] ); ?></span>
                <?php if ( !empty(get_attr_name_by_slug( $value['attributes']['attribute_pa_color'] )) || !empty($main_price) ) { ?>
                —
                <?php } ?>
                <span class="product__price"><?php echo $main_price; ?></span>
            </p>
        </a>
        <p  class="product__low btn_click"
            data-product_id="<?php echo $product->get_id(); ?>"
            data-variation_id="<?php echo $value['variation_id']; ?>"
            data-text="Купити в 1 клік"
        >
            <span>КУПИТИ В 1 КЛІК</span>
        </p>
    </li>

<?php endforeach; ?>