<?php
add_action( 'wp_ajax_send_sms', 'send_sms_callback' );
function send_sms_callback() {
    $text = carbon_get_theme_option("{$_POST['type']}_sms_text");

    foreach ($_POST as $key => $value) {
        $text = str_replace("__{$key}__", $value, $text);
    }

    if (!$_POST['phone'])
        wp_die('відсутній номер телефону');

    if (!$text)
        wp_die('текст не задано');

    if (strpos($text,'__') !== false)
        wp_die('недостатьно даних');

    if (send_message_turbosms($_POST['phone'], $text)) {
        if ($_POST['order_id']) {
            add_post_meta($_POST['order_id'], "{$_POST['type']}_sms_sent", true);
        }

        wp_die('success');
    } else {
        wp_die('Виникла помилка при відпраці смс');
    }

}

function get_np_sms_button($order_id, $phone, $slug, $data, $text = null) {
    if (!$slug)
        return '';

    $text = $text ?: 'Відправити смс';

    $classes = 'np_send_sms button button-primary';
    $sms_sent = get_post_meta($order_id, "{$slug}_sms_sent");

    $classes .= $sms_sent ? ' button-disabled' : '';

    $data_attributes = '';
    foreach ($data as $name => $value) {
        $data_attributes .= " data-$name='$value' ";
    }

    return "<button
            class='$classes' 
            style='width: 170px;' 
            data-type='$slug'
            data-order_id='$order_id'
            data-phone='$phone'
            $data_attributes
        >$text</button>";
}