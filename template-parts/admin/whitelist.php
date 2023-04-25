<style>
    .order-data {
        padding: 8px 16px;
        border-bottom: 1px solid #ccc;
        margin: 0 -12px;
    }
    .order-data:nth-child(odd) {
        background: #f7f7f7;
    }
    .order-data p {
        margin-bottom: 10px;
    }
    .order-data__number {
        font-size: 18px;
        font-weight: 600;
    }
    .order-data__name {
        font-size: 16px;
    }
    .order-data__total {
        font-size: 16px;
    }
    .order-data__price {
        font-weight: 600;
    }

    .order-data__total-price {
        font-size: 20px;
        font-weight: 600;
        padding-top: 11px;
    }
</style>

<?php
global $post;

$user_email = carbon_get_post_meta($post->ID, 'email');
$user_phone = carbon_get_post_meta($post->ID, 'phone');

$orders = get_posts(array(
    'post_type' => 'shop_order',
    'post_status' => 'wc-processing,wc-completed,wc-pending',
    'posts_per_page' => -1,
    'meta_query' => array(
        'relation' => 'OR',
        array(
            'key' => '_billing_email',
            'value' => $user_email,
            'compare' => '=',
        ),
        array(
            'key' => '_billing_phone',
            'value' => $user_phone,
            'compare' => '=',
        ),
    )
)); 
?>


<?php
$orders_total = 0;
foreach ($orders as $order) {
    $order = wc_get_order($order->ID);
    $orders_total += $order->get_total();
    ?>
    <div class="order-data">

        <p class="order-data__number">Заказ №<?php echo $order->get_id(); ?></p>

        <?php
        foreach ($order->get_items() as $product) {
//        var_dump($product);
            ?>
            <p class="order-data__name"><?php echo $product['name'] . ' (' . $product['quantity'] . ') ' . $product['total']; ?></p>
            <?php
        } ?>
        <p class="order-data__total">Итого: <span class="order-data__price"><?php echo $order->get_total(); ?></span></p>
    </div>

    <?php
} ?>
<p class="order-data__total-price">В целом на сумму: <?php echo $orders_total; ?></p>