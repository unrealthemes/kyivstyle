<?php
/**
 * Checkout Order Receipt Template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/order-receipt.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.2.0
 */

if (!defined('ABSPATH')) {
    exit;
}
?>

<div class="order_main__pay">
    <table class="order_details">
        <tr class="order">
            <td><?php esc_html_e('Order number:', 'woocommerce'); ?></td>
            <td><strong><?php echo esc_html($order->get_order_number()); ?></strong></td>
        </tr>
        <tr class="date">
            <td><?php esc_html_e('Date:', 'woocommerce'); ?></td>
            <td><strong><?php echo esc_html(wc_format_datetime($order->get_date_created())); ?></strong></td>
        </tr>
        <tr class="total">
            <td><?php esc_html_e('Total:', 'woocommerce'); ?></td>
            <td><strong><?php echo wp_kses_post($order->get_formatted_order_total()); ?></strong></td>
        </tr>
        <?php if ($order->get_payment_method_title()) : ?>
            <tr class="method">
                <td><?php esc_html_e('Payment method:', 'woocommerce'); ?></td>
                <td><strong><?php echo wp_kses_post($order->get_payment_method_title()); ?></strong></td>
            </tr>
        <?php endif; ?>
    </table>
    <div class="order_pay__liqpay">
        <?php do_action('woocommerce_receipt_' . $order->get_payment_method(), $order->get_id()); ?>
    </div>
</div>
