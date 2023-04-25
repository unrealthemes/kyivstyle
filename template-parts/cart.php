<?php $items = WC()->cart->get_cart();
?>



<div class="cart_nav_wrap">
    <div class="wrap_edit">

        <div class="cart-preloader">
            <span class="helper"></span>
            <img class="lazyload" data-src="<?php echo get_template_directory_uri(); ?>/img/cart.gif" alt="preloader">
        </div>

        <ul class="cart_nav">
            <li class="cart_nav__items">
                <h5 class="cart_nav__head">Кошик</h5><a class="x close_cart_nav" href="#"></a>
            </li>

            <?php if ($items) { ?>

                <?php foreach ($items as $item => $values) {

                    $item_data = $values['data'];
                    $_product  = wc_get_product($values['data']->get_id());
                    $price     = get_post_meta($values['product_id'], '_price', true);
                    $thumbnail = get_the_post_thumbnail_url($values['product_id'], 'thumbnail'); ?>

                    <li class="cart_nav__items cart_product">
                        <div class="cart_product__img">

                            <?php if ( !empty($item_data->get_image_id()) ):
                                $thumbnail = wp_get_attachment_url( $item_data->get_image_id() );
                                $image_alt = get_post_meta($item_data->get_image_id(), '_wp_attachment_image_alt', true); ?>

                                <img class="lazyload" data-src="<?php echo $thumbnail; ?>" alt="<?php echo $image_alt; ?>">

                            <?php endif; ?>

                        </div>
                        <div class="cart_product__info">
                            <h3 class="cart_product__head"><a href="<?php echo get_the_permalink($_product->get_id()); ?>"><?php echo $_product->get_title(); ?></a></h3>
                            <div class="cart_product__wrap">

                                <?php 
                                $atribute  = $item_data->get_attributes(); 
                                $parent_id = wp_get_post_parent_id( $_product->get_id() );

                                if ( !empty($atribute['pa_color']) ) { ?>

                                    <div class="cart_product__select">
                                        <div class="select-wrapper"> 
                                            <select class="cart_variation" name="select" data-parent-id="<?php echo $parent_id; ?>" data-item-key="<?php echo $values['key']; ?>">
                                                <option disabled hidden>Колір</option>
                                                <!-- <option selected><?php echo get_attr_name_by_slug($atribute['pa_color']); ?></option> -->

                                                <?php $handle = new WC_Product_Variable( $parent_id );
                                                $variations1  = $handle->get_children();
                                                foreach ($variations1 as $value) {
                                                    $single_variation = new WC_Product_Variation($value); // $single_variation->price
                                                    $label = $single_variation->get_variation_attributes();
 
                                                    if ( $atribute['pa_color'] == $label['attribute_pa_color'] ) {
                                                        echo '<option data-slug="'.$label['attribute_pa_color'].'"  value="'.$value.'" selected>'.get_attr_name_by_slug($label['attribute_pa_color']).'</option>';
                                                    } else {
                                                        echo '<option data-slug="'.$label['attribute_pa_color'].'"  value="'.$value.'">'.get_attr_name_by_slug($label['attribute_pa_color']).'</option>';
                                                    }
                                                } ?>

                                            </select>
                                        </div>
                                        <input class="cart_product__count no-spinners" inputmode="numeric" pattern="[0-9]*" type="text" value="<?php echo $values['quantity']; ?>" data-item-id="<?php echo $values['key']; ?>" onKeyPress="chislo()">
                                    </div>

                                <?php } else { ?>

                                    <div class="cart_product__select no-attrs">
                                        <input class="cart_product__count no-spinners" inputmode="numeric" pattern="[0-9]*" type="text" value="<?php echo $values['quantity']; ?>" data-item-id="<?php echo $values['key']; ?>" onKeyPress="chislo()">
                                    </div>

                                <?php } ?>

                            </div>
                            <div class="cart_product__price">
                                <span><?php echo $_product->get_price_html(); ?></span>
                            </div>
                        </div>
                        <span class="x close_cart_product" data-id="<?php echo $values['key']; ?>"></span>
                    </li>

                <?php } ?>

                <?php if ( wc_coupons_enabled() ) { 

                    $applied_coupons = WC()->session->get( 'applied_coupons', array() );

                    if ( empty( $applied_coupons ) ) { ?>
                        
                        <li class="cart_nav__items certificate">
                            <a href="#">Є сертифікат?</a>
                            <div class="certificate_input">

                                <label for="enter_certificate">Сертифікат</label>
                                <input type="text" name="coupon_code" id="coupon_code" required>

                                <div class="certificate_sumbit">
                                    <button class="form_submit form_submit__sm" name="apply_coupon" type="submit" value="">
                                        <i class="fa fa-caret-right" aria-hidden="true"></i>
                                    </button>
                                    <span class="certificate_sale"></span>
                                </div>
                                <!-- /.sertificate_sumbit -->
                                <span class="certificate_error"></span>

                            </div>

                        </li>

                    <?php } else { ?>

                        <li class="cart_nav__items certificate open">
                            <div class="certificate_input littleLetter">
                                <label for="enter_certificate">Сертифікат</label>

                                <?php $cart_coupons = WC()->cart->get_coupons(); 
                                foreach ($cart_coupons as $key => $data) : 

                                    // if ($data->discount_type == 'percent') : 
                                    //     $symbol = '%'; 
                                    // else : 
                                        $symbol = get_woocommerce_currency_symbol(); 
                                    // endif; 
                                ?>

                                    <span class="certificate_code"><?php echo $data->code; ?></span>
                                    <div class="certificate_sumbit">
                                        <!-- <span class="certificate_sale" style="display: inline;">-<?php //echo $data->amount .' '. $symbol; ?></span> -->
                                        <span class="certificate_sale" style="display: inline;">
                                            -<?php echo WC()->cart->get_coupon_discount_amount( $data->code ) .' '. $symbol; ?>
                                        </span>
                                    </div>

                                <?php endforeach; ?>
                            </div>

                        </li>

                    <?php } ?>

                <?php } ?>
                
                <li class="cart_nav__items amount">
                    <span>Сума:</span>
                    <span id="cart_total"><?php echo WC()->cart->get_cart_total(); ?></span>
                </li>
                <li class="cart_nav__items order">
                    <a href="<?php echo esc_url(wc_get_checkout_url()); ?>" class="main-btn order_submit">
                        <?php esc_html_e('Proceed to checkout', 'woocommerce'); ?>
                    </a>
                </li>

            <?php } else { ?>

                <li class="cart_nav__items">
                    <h5 class="cart_nav__head">Ваш кошик поки порожній</h5>
                </li>

            <?php } ?>

        </ul>
    </div>
</div>

<script>
    function chislo(){
        if (event.keyCode < 48 || event.keyCode > 57)
            event.returnValue = false;
    }
</script>