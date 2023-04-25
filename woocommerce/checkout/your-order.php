<?php
/**
 * Your Order block
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     2.3.0
 */

if (!defined('ABSPATH')) {
    exit;
} ?>

<div id="vueToggle" v-bind:class="{ active: show }" class="order_main__info">
    <div @click='show = !show' class="your_order__head">
        <h5>
            Ваше замовлення
<!--            <svg class="toggle-arrow" id="Capa_1" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"-->
<!--                 viewBox="0 0 240.823 240.823" xml:space="preserve"><g>-->
<!--                    <path id="Chevron_Right"-->
<!--                          d="M57.633,129.007L165.93,237.268c4.752,4.74,12.451,4.74,17.215,0c4.752-4.74,4.752-12.439,0-17.179l-99.707-99.671l99.695-99.671c4.752-4.74,4.752-12.439,0-17.191c-4.752-4.74-12.463-4.74-17.215,0L57.621,111.816C52.942,116.507,52.942,124.327,57.633,129.007z"></path>-->
<!--                </g>-->
<!--                </svg>-->
        </h5>
    </div>
    <ul v-bind:class="{ show: show }" id="orderClick" class="your_order">

        <?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {

            $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
            $thumbnail = get_the_post_thumbnail_url($cart_item['product_id'], 'thumbnail');
            $item_type = $cart_item['data']->get_type();
            if ($item_type == 'variation') {
                $attributes = $cart_item['data']->get_attributes();
                $curr_attr = get_attr_name_by_slug($attributes['pa_color']);
                $thumbnail = wp_get_attachment_url( $cart_item['data']->get_image_id() );
                $image_alt = get_post_meta($cart_item['data']->get_image_id(), '_wp_attachment_image_alt', true);
            } else { // simple
                $curr_attr = '';
                $image_alt = get_post_meta($cart_item['product_id'], '_wp_attachment_image_alt', true);
            }

            if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key)) { ?>

                <li class="your_order__item">
                    <div class="your_order__img">
                        <?php if (!empty($thumbnail)): ?>

                            <img src="<?php echo $thumbnail; ?>" alt="<?php echo $image_alt; ?>">

                        <?php endif; ?>
                    </div>
                    <div class="your_order__info">
                        <h6 class="info__head">
                            <?php echo $cart_item['data']->get_title(); ?>
                            <?php //echo apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;'; ?>
                            <?php //echo apply_filters( 'woocommerce_checkout_cart_item_quantity', ' <strong class="product-quantity">' . sprintf( '&times; %s', $cart_item['quantity'] ) . '</strong>', $cart_item, $cart_item_key ); ?>
                            <?php //echo wc_get_formatted_cart_item_data( $cart_item ); ?>
                        </h6>
                        <div class="info__color"><?php echo $curr_attr; ?></div>
                        <div class="info__mass"><?php echo $cart_item['quantity']; ?> шт.</div>
                        <div class="info__amount">
                            <?php echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); ?>
                        </div>
                    </div>
                </li>

            <?php }
        } 

        if ( wc_coupons_enabled() ) { 

            $applied_coupons = WC()->session->get( 'applied_coupons', array() );

            if ( !empty( $applied_coupons ) ) { ?>

                <li class="your_order__send">
                    <span>Серитфікат:</span>

                    <?php $cart_coupons = WC()->cart->get_coupons(); 
                    foreach ($cart_coupons as $key => $data) : 

                        // if ($data->discount_type == 'percent') : 
                        //     $symbol = '%'; 
                        // else : 
                            $symbol = get_woocommerce_currency_symbol(); 
                        // endif; 
                    ?> 

                        <!-- <div id="coupon_price_html">
                            -<?php //echo $data->amount .' '. $symbol; ?>
                        </div> -->

                        <div id="coupon_price_html">
                            -<?php echo WC()->cart->get_coupon_discount_amount( $data->code ) .' '. $symbol; ?>
                        </div>

                    <?php endforeach; ?>

                </li>

            <?php } 

        } ?>

        <li class="your_order__send">
            <span>Доставка:</span>
            <div id="curr_sh_price_html"><?php echo WC()->cart->shipping_total . get_woocommerce_currency_symbol(); ?></div>
        </li>


        <li @click='show = !show' class="your_order__footer">
            <span class="your_order__pay">До оплати:</span>
            <span><?php wc_cart_totals_order_total_html(); ?></span>
        </li>

    </ul>

</div>