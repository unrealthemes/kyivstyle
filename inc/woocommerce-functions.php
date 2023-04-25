<?php
/**
 * WOOCOMMERCE FUNCTIONS
 *
 * @package notebook
 */

add_filter( 'woocommerce_currencies', 'add_my_currency' );

function add_my_currency( $currencies ) {

     $currencies['UAH'] = __( 'Українська гривня', 'woocommerce' );

     return $currencies;

}

add_filter('woocommerce_currency_symbol', 'add_my_currency_symbol', 10, 2);

function add_my_currency_symbol( $currency_symbol, $currency ) {

     switch( $currency ) {

         case 'UAH': $currency_symbol = ' грн.'; break;

     }

     return $currency_symbol;

}

/**
 * Remove product from cart
 */
function remove_item_from_cart() {

    $cart = WC()->instance()->cart;
    $id = $_POST['product_id'];
    // $cart_id = $cart->generate_cart_id($id); // с вариативным товаром не работает
    $cart_item_id = $cart->find_product_in_cart($id);

    if($cart_item_id){
       $cart->set_quantity($cart_item_id, 0);
       wp_send_json(
        array(
          'cart_total' => WC()->cart->get_cart_total(),
          'cart_count' => WC()->cart->get_cart_contents_count()
        )
       );
    }
    return false;
}

add_action('wp_ajax_remove_item_from_cart', 'remove_item_from_cart');
add_action('wp_ajax_nopriv_remove_item_from_cart', 'remove_item_from_cart');

/**
 * Get Attribute name by slug
 */
function get_attr_name_by_slug($slug){

    $taxonomy = 'pa_color';
    $term = get_term_by('slug', $slug, $taxonomy);

    return $term->name;
}

/**
 * Remove style Woocommerce
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Remove fields for checkout page
 */
function custom_checkout_fields( $fields ) {

  unset($fields['billing']['billing_last_name']);
  unset($fields['billing']['billing_postcode']);
  unset($fields['billing']['billing_state']);
  unset($fields['billing']['billing_company']);
  // unset($fields['billing']['billing_country']);
  unset($fields['billing']['billing_city']);
  // unset($fields['billing']['billing_address_1']);
  unset($fields['billing']['billing_address_2']);

  // remove shipping fields
  // unset($fields['shipping']['shipping_first_name']);
  // unset($fields['shipping']['shipping_last_name']);
  // unset($fields['shipping']['shipping_company']);
  // unset($fields['shipping']['shipping_address_1']);
  // unset($fields['shipping']['shipping_address_2']);
  // unset($fields['shipping']['shipping_city']);
  // unset($fields['shipping']['shipping_postcode']);
  // unset($fields['shipping']['shipping_country']);
  // unset($fields['shipping']['shipping_state']);
  $fields['order']['order_comments']['label'] = 'Коментар до замовлення';
  $fields['order']['order_comments']['placeholder'] = '';

  return $fields;
}
add_filter( 'woocommerce_checkout_fields' , 'custom_checkout_fields' );

/**
 * Ajax calc shipping checkout
 **/
if( wp_doing_ajax() ){
  add_action('wp_ajax_calc_shipping_checkout', 'ajax_calc_shipping_checkout');
  add_action('wp_ajax_nopriv_calc_shipping_checkout', 'ajax_calc_shipping_checkout');
}

function ajax_calc_shipping_checkout(){

  $return = array(
    'shipping_total' => WC()->cart->shipping_total . get_woocommerce_currency_symbol(),
    'totals_order'   => WC()->cart->total . get_woocommerce_currency_symbol()
  );

  wp_send_json( $return );
}

/**
 * Ajax quantity update cart
 **/
if( wp_doing_ajax() ){
  add_action('wp_ajax_quantity_update_cart', 'ajax_quantity_update_cart');
  add_action('wp_ajax_nopriv_quantity_update_cart', 'ajax_quantity_update_cart');
}

function ajax_quantity_update_cart(){

  foreach( WC()->cart->get_cart() as $cart_item ){

    if ( $_POST['cart_item_key'] == $cart_item['key'] ){

      WC()->cart->set_quantity( $_POST['cart_item_key'], $_POST['quantity'], true );

      $return = array(
        'cart_total' => WC()->cart->get_cart_total()
      );

      wp_send_json( $return );
    }
  }
}

/**
 * Ajax variation update cart
 **/
if( wp_doing_ajax() ){
  add_action('wp_ajax_variation_update_cart', 'ajax_variation_update_cart');
  add_action('wp_ajax_nopriv_variation_update_cart', 'ajax_variation_update_cart');
}

function ajax_variation_update_cart(){

  // $attr["atribute_pa_color"] = $_POST['variation_slug'];

    $cart_item_data = (array) apply_filters( 'woocommerce_add_cart_item_data', array(), $_POST['parent_id'], $_POST['variation_id'], $_POST['quantity'] );
  $cart_id =  WC()->cart->generate_cart_id( $_POST['parent_id'], $_POST['variation_id'], $attr, $cart_item_data );
    WC()->cart->remove_cart_item( $_POST['product_key'] );

  WC()->cart->add_to_cart($_POST['parent_id'], $_POST['quantity'], $_POST['variation_id'], $attr, null);

  $thumb = '';
  $product = new WC_Product_Variable( $_POST['parent_id'] );
  $variations = $product->get_available_variations();

  foreach ($variations as $attr) {

    if ($attr['variation_id'] == $_POST['variation_id']) {

        $thumb = $attr['image']['thumb_src'];
    }
  }

  foreach (WC()->cart->get_cart() as $key => $item) {
    if ( $item['variation_id'] == $_POST['variation_id'] ) {
      $key = $item['key'];
      // unset($array[$indexCompleted]);
    }
  }

  $return = array(
    'key' => $cart_id,
    'thumb' => $thumb,
    'cart_total' => WC()->cart->get_cart_total()
  );

  wp_send_json( $return );
}



// function remove_item_from_cart() {

//     $cart = WC()->instance()->cart;
//     $id = $_POST['product_id'];
//     // $cart_id = $cart->generate_cart_id($id); // с вариативным товаром не работает
//     $cart_item_id = $cart->find_product_in_cart($id);

//     if($cart_item_id){
//        $cart->set_quantity($cart_item_id, 0);
//        wp_send_json(
//         array(
//           'cart_total' => WC()->cart->get_cart_total(),
//           'cart_count' => WC()->cart->get_cart_contents_count()
//         )
//        );
//     }
//     return false;
// }


/**
 * Manipulate default countries
 **/
function change_default_checkout_country() {

  return 'UA'; // country code
}
add_filter( 'default_checkout_billing_country', 'change_default_checkout_country' );



function get_office_number_from_string_np($string) {

  // 'Отделение №127 (до 30 кг): ул. Сяйво, 13, (р-н Левандовка)';
  $cut = strpos( $string, '№' );
  $warehpuse = substr( $string, $cut ); // Отделение №127
  $result = strpos( $warehpuse, ' ' );
  $result = substr( $warehpuse, 0, $result ); // 127
  $result = preg_replace("/[^0-9]/", '', $result);

  return $result;
}



/**
 * Sending data after creating an order
 **/
function action_checkout_order_processed( $order_id ) {

   $order = new WC_Order($order_id);
   $data = $order->get_data();
   $statuses = array(
    'pending'     => 'В ожидании оплаты',
    'processing'  => 'Обработка',
    'on-hold'     => 'На удержании',
    'completed'   => 'Выполнен',
    'cancelled'   => 'Отменен',
    'refunded'    => 'Возвращён',
    'failed'      => 'Не удался'
   );

   // Order data
   $data_card['id']      = $data['id'];
   $data_card['date']    = $order->order_date;
   $data_card['status']  = $statuses[$data['status']];
   // $data_card['total']   = $data['total']." ".get_woocommerce_currency_symbol();
   $data_card['name']    = $data['billing']['first_name'];
   $data_card['email']   = $data['billing']['email'];
   $data_card['ip_address']     = $data['customer_ip_address'];
   // $data_card['shipping_total'] = $data['shipping_total']." ".get_woocommerce_currency_symbol();
   $data_card['payment_method'] = $data['payment_method'];
   $data_card['note'] = $order->customer_message;
   $data_card['communication_method'] = get_post_meta( $order->get_id(), "Спосіб зв'язку", true );

   // Number format +38 (000) 000-00-00
   $str = strval( $data['billing']['phone'] );
   $data_card['phone'] = substr($str, 0, 3).' ('.substr($str, 3, 3).') '.substr($str, 6, 3).'-'.substr($str, 9, 2).'-'.substr($str, 11, 2);

   // Order items
   $product_details = '';
   $order_items = $order->get_items();
   foreach( $order_items as $product ) {

      if ( $product->get_variation_id() ) {
        $_product = wc_get_product( $product->get_variation_id() );
        $attr = str_replace( $_product->get_title() . ' - ', '', $product->get_name() );

        $product_details .=  '&nbsp;&nbsp;&nbsp;&nbsp;'
        .$_product->get_title().' ('.$attr.') x '.$product['qty'].' шт. = '.$product['total'].get_woocommerce_currency_symbol() . "<br>";
      } else {
        $product_details .=  '&nbsp;&nbsp;&nbsp;&nbsp;'
        .$product['name'].' x '.$product['qty'].' шт. = '.$product['total'].get_woocommerce_currency_symbol() . "<br>";
      }
   }
   // $product_list = implode( ',', $product_details );
   $data_card['product_list'] = $product_details;
   $total_without_shipping = floatval($data['total']) - floatval($data['shipping_total']);
   // Order shipping
   // $shipping_methods = array();
   // $order->get_shipping_methods();
   // if( $order->has_shipping_method('flat_rate') ) {
      // $shipping_methods = "Способ доставки: **".$order->get_shipping_method()." - ".$data['shipping_total']." ".get_woocommerce_currency_symbol().'**';
        // $data_card['shipping_methods'] = $order->get_shipping_method();
   // }

	 // закомментировал, потому что поменял название способа оплаты в админке и в трелло стали создаваться некорректные карточки
   //if ( $order->get_shipping_method() != 'Курьер по Киеву' && $data['payment_method_title'] == 'Наличными при получении' ) { // Nova poshta nal
   if ( $order->get_shipping_method() != 'Адресна доставка Новою поштою' && $data['payment_method_title'] == 'Накладений платіж (Нова пошта)' ) { // Nova poshta nal

      $data_card['type'] = 'np_nal';
      $number = get_office_number_from_string_np( $data['billing']['address_1'] );
      $data_card['payment_method_title'] = 'Наложенный платеж'; 
      $data_card['address'] = 'НП, ' . $data['billing']['city'] . ' (' . $number . '), ' . $data['billing']['state'] . ' обл.';
      $data_card['who_pays_shipping'] = "<b>Кто платит за доставку</b>: Получатель";
      //$data_card['back'] = '**Обратно**: ' . $total_without_shipping . ' ' . get_woocommerce_currency_symbol();
      $data_card['back'] = $total_without_shipping . ' ' . get_woocommerce_currency_symbol();
      $data_card['shipping_total'] = '';
      $data_card['total'] = '';

   } else if ( $order->get_shipping_method() == 'Адресна доставка Новою поштою' && $data['payment_method_title'] == 'Накладений платіж (Нова пошта)' ) { // Courier nal

      $data_card['type'] = 'c_nal';
      $data_card['payment_method_title'] = 'Наложенный платеж';
      $data_card['address'] = "Адресная доставка: " . $data['billing']['address_1'];
      $data_card['who_pays_shipping'] = "<b>Кто платит за доставку</b>: Получатель";
      $data_card['back'] = $total_without_shipping . ' ' . get_woocommerce_currency_symbol();
      $data_card['shipping_total'] = "<b>Доставка:</b> " . $data['shipping_total']." ".get_woocommerce_currency_symbol();
      $data_card['total'] = "<b>Всего:</b> " . $data['total']." ".get_woocommerce_currency_symbol();

   } else if ( $data['payment_method_title'] == 'Оплата через WayForPay' && $order->get_shipping_method() != 'Адресна доставка Новою поштою' ) { // Nova poshta card

      $data_card['type'] = 'np_card';
      $number = get_office_number_from_string_np( $data['billing']['address_1'] );
      $data_card['address'] = 'НП, ' . $data['billing']['city'] . ' (' . $number . '), ' . $data['billing']['state'] . ' обл.';
      $data_card['payment_method_title'] = "Оплачен❓";
      $data_card['who_pays_shipping'] = "<b>Кто платит за доставку</b>: Мы❓";
      $data_card['back'] = "<b>Обратно</b>: Ничего❓";
      $data_card['shipping_total'] = "";
      $data_card['total'] = "<b>Стоимость без доставки:</b> " . $total_without_shipping . " " . get_woocommerce_currency_symbol();

   } else if ( $data['payment_method_title'] == 'Оплата через WayForPay' && $order->get_shipping_method() == 'Адресна доставка Новою поштою' ) { // Courier card

      $data_card['type'] = 'c_card';
      $data_card['address'] = "Адресная доставка: " . $data['billing']['address_1'];
      $data_card['payment_method_title'] = "Оплачен❓";
      $data_card['who_pays_shipping'] = "<b>Кто платит за доставку</b>: Мы❓";
      $data_card['back'] = "<b>Обратно</b>: Ничего❓";
      //$data_card['shipping_total'] = '**Доставка:** ' . 'Уже оплачена❓❓❓';
      $data_card['total'] = "<b>Стоимость без доставки:</b> " . $total_without_shipping . " " . get_woocommerce_currency_symbol();

   } else {

      $data_card['type'] = 'other';
      $data_card['address'] = $data['billing']['address_1'];
      $data_card['payment_method_title'] = $data['payment_method_title'];
      $data_card['who_pays_shipping'] = '';
      $data_card['back'] = '';
      $data_card['shipping_total'] = "<b>Доставка:</b> " . $data['shipping_total']." ".get_woocommerce_currency_symbol();
      $data_card['total'] = "<b>Всего:</b> " . $data['total'] . " " . get_woocommerce_currency_symbol();
   }

   send_order_to_trello($data_card);
   $response = send_message_turbosms($data_card['phone'], carbon_get_theme_option('text_turbosms'));
}
add_action('woocommerce_checkout_order_processed', 'action_checkout_order_processed', 10, 1);



/**
 * Custom notification on single-product page
 */
//wc_add_notice( apply_filters( 'wc_add_to_cart_message', $message, $product_id ) );

function handler_function_name($message, $product_id) {

    return __('Товар успішно додано до кошика', 'notebook') /*. $product_id*/;
}
add_filter('wc_add_to_cart_message', 'handler_function_name', 10, 2);

function process_lists($order_id, $order_post, $update) {

    if ($order_post->post_type != 'shop_order' || $update)
        return;

    $user_email = $_POST['billing_email'];
    $user_phone = $_POST['billing_phone'];
    $user_phone_escaped = preg_replace('/[^0-9+]/', '', $user_phone);
    $user_first_name = $_POST['billing_first_name'];

    $args = array(
        'numberposts' => 1,
        'meta_query' => array(
            'relation' => 'OR',
            /*array(
                'key' => '_email',
                'value' => $user_email,
            ),*/
            array(
                'key' => '_phone',
                'value' => $user_phone_escaped,
            ),
        )
    );

    if ( !empty($user_email) ) {

      $args['meta_query'][] = array(
          'key'   => '_email',
          'value' => $user_email,
      );
    }

    $blacklist = get_posts(array_merge(
        $args,
        array(
            'post_type' => 'blacklist'
        )
    ));

    $whitelist = get_posts(array_merge(
        $args,
        array(
            'post_type' => 'whitelist'
        )
    ));

    $lists = array_merge($blacklist, $whitelist);

    foreach ($lists as $list) {
        $list_name = get_post_type($list) === 'whitelist' ? 'белого 👍' : 'черного 😡';

        $subject = "Заказ из $list_name списка";
        $headers = 'From: Сайт «Kyiv Style» 💥 <mail@kyivstyle.com>' . "\r\n";
        $reason  = carbon_get_post_meta( $list->ID, 'reason' );
        $reason_string = $reason ? "\r\nПричина: $reason" : '';
        //$message = "Пользователь из $list_name списка $user_first_name (email: $user_email, телефон: {$user_phone}{$reason_string}) сделал заказ #$order_id";
        $message = "Заказ: $order_id $reason_string";
        $admin_email = get_bloginfo('admin_email');
        // $admin_email = 'romchyk16@gmail.com';

        wp_mail($admin_email, $subject, $message, $headers);
        
        foreach (carbon_get_theme_option('admin_phones') as $phone) {
            send_message_turbosms($phone['phone'], $message);
        }
    }
}
add_action('wp_insert_post', 'process_lists', 20, 3);

function add_to_whitelist($order_id, $order_post, $update) {

    if ( $order_post->post_type != 'shop_order' || $update )
        return;

    $user_email = $_POST['billing_email'];
    $user_phone = $_POST['billing_phone'];
    $user_first_name = $_POST['billing_first_name'];
    $user_phone_escaped = preg_replace('/[^0-9+]/', '', $user_phone);

    $args_prev = array(
        'post_type'       => 'shop_order',
        'post_status'     => 'wc-processing,wc-completed,wc-pending',
        'posts_per_page'  => -1,
        'exclude'         => $order_id,
        'meta_query'      => array(
          'relation' => 'OR',
            /*array(
                'key' => '_billing_email',
                'value' => $user_email,
                'compare' => '=',
            ),*/
             array(
                'key'     => '_billing_phone',
                'value'   => $user_phone_escaped,
                'compare' => '=',
            ),
        )
    );

    if ( !empty($user_email) ) {

      $args_prev['meta_query'][] = array(
          'key'   => '_email',
          'value' => $user_email,
      );
    }

    $prev_orders = get_posts( $args_prev );

    // update_option( 'my_option', $user_phone );
    // update_option( 'my_option', $user_phone );

    $args_whitelist = array(
        'post_type' => 'whitelist',
        'meta_query' => array(
           'relation' => 'OR',
            /*array(
                'key' => '_email',
                'value' => $user_email,
                'compare' => '=',
            ),*/
             array(
                'key' => '_phone',
                'value' => $user_phone_escaped,
                'compare' => '=',
            ),
        )
    );

    if ( !empty($user_email) ) {

      $args_whitelist['meta_query'][] = array(
          'key'     => '_email',
          'value'   => $user_email,
          'compare' => '=',
      );

      $user_email = 'Email не указан';
    }

    $whitelist = get_posts( $args_whitelist );

    if ($prev_orders && empty($whitelist)) {
        $post_data = array(
            'post_title'    => $user_email,
            'post_status'   => 'publish',
            'post_type'     => 'whitelist',
        );

        $post_id = wp_insert_post( $post_data );

        carbon_set_post_meta($post_id, 'email', $user_email);
        carbon_set_post_meta($post_id, 'phone', $user_phone);
        carbon_set_post_meta($post_id, 'first_name', $user_first_name);
    }
}
add_action('wp_insert_post', 'add_to_whitelist', 10, 3);

function wc_new_order_column( $columns ) {

    $columns['invoice_id'] = 'Номер накладной';
    $columns['send_sms'] = 'Смс';

    return $columns;
}
add_filter( 'manage_edit-shop_order_columns', 'wc_new_order_column' );

function wc_new_order_column_content( $column ) {
  
    global $post;
    $invoice_id = get_post_meta($post->ID, 'invoice_id', true);
    $phone = get_post_meta($post->ID, '_billing_phone', true);
    $cardnumber = carbon_get_theme_option('number_card_turbosms');
    $order = wc_get_order($post->ID);
    $total = $order->get_total();

    if ('invoice_id' === $column) {
        echo $invoice_id;
    } elseif ('send_sms' === $column) {
        if ($phone && $invoice_id)
            echo get_np_sms_button($post->ID, $phone, 'invoice', ['invoice_id' => $invoice_id], 'накладна');
        if ($cardnumber)
            echo get_np_sms_button($post->ID, $phone, 'cardnumber', ['cardnumber' => $cardnumber, 'total' => $total], 'номер картки');
    }
}
add_action( 'manage_shop_order_posts_custom_column', 'wc_new_order_column_content' );

/**
 * Ajax coupone
 */
if( wp_doing_ajax() ){
  add_action('wp_ajax_coupon', 'ajax_coupon');
  add_action('wp_ajax_nopriv_coupon', 'ajax_coupon');
}

function ajax_coupon(){

  $ret = false;

  if (isset($_POST['coupon']) && !empty($_POST['coupon'])) {

    global $woocommerce;
    WC()->cart->remove_coupons();
    $ret = WC()->cart->add_discount( $_POST['coupon'] );
  }

  $return = array(
    'return'     => $ret,
    'cart_total' => WC()->cart->get_cart_total(),
    'discount_amount' => WC()->cart->get_coupon_discount_amount( $_POST['coupon'] )
  );

  wp_send_json( $return );
}

/**
 * After add to cart product - redirect to current product page
 */
function resolve_dupes_add_to_cart_redirect($url = false) {

  if ( isset($_SESSION['color']) && !empty($_SESSION['color']) ) {
    $result_url = get_bloginfo('wpurl').add_query_arg(array(), remove_query_arg('add-to-cart')) . '?color=' . $_SESSION['color'];
  } else {
    $result_url = get_bloginfo('wpurl').add_query_arg(array(), remove_query_arg('add-to-cart'));
  }

  global $wp;
  // If another plugin beats us to the punch, let them have their way with the URL
  if(!empty($url)) { return $url; }

  // Redirect back to the original page, without the 'add-to-cart' parameter.
  // We add the `get_bloginfo` part so it saves a redirect on https:// sites.
  return $result_url;

}

add_action('add_to_cart_redirect', 'resolve_dupes_add_to_cart_redirect');


 /**
  * Session start
  */
function do_session_start() {

    if ( !session_id() ) {
      session_start();
    }
}
add_action( 'init', 'do_session_start' );


/**
 * Redirect to custom thank's page
 */
function woo_custom_redirect_after_purchase() {

  global $wp;

  if ( is_checkout() && !empty( $wp->query_vars['order-received'] ) ) {

    $pages = get_pages(array(
      'meta_key'   => '_wp_page_template',
      'meta_value' => 'template-thanks.php'
    ));

    if (isset($pages[0])) {
      $page_id = $pages[0]->ID;
      wp_redirect( get_permalink($page_id) .'?order='.$wp->query_vars['order-received'] );
      exit;
    }
  }
}
add_action( 'template_redirect', 'woo_custom_redirect_after_purchase' );


//Display Fields
add_action( 'woocommerce_product_after_variable_attributes', 'variable_fields', 10, 3 );
//JS to add fields for new variations
add_action( 'woocommerce_product_after_variable_attributes_js', 'variable_fields_js' );
//Save variation fields
add_action( 'woocommerce_process_product_meta_variable', 'save_variable_fields', 10, 1 );

/**
 * Create new fields for variations
 */
function variable_fields( $loop, $variation_data, $variation ) {
    ?>
    <style>
        .wc-metaboxes-wrapper .toolbar .cancel-variation-changes, .wc-metaboxes-wrapper .toolbar .save-variation-changes {
            display: none;
        }
    </style>

    <?php $upload_hover_id = get_post_meta( $variation->ID, '_upload_hover_id', true ); ?>

    <p>Картинка при наведении (на главной)</p>
    <p class="form-row form-row-first upload_image">

        <?php if (!empty($upload_hover_id)) : ?>
        <a href="#" class="upload_image_button remove" rel="<?php echo $variation->ID; ?>">
            <img src="<?php echo wp_get_attachment_url( $upload_hover_id ); ?>">
            <?php else : ?>
            <a href="#" class="upload_image_button tips" rel="<?php echo $variation->ID; ?>">
                <img src="<?php echo home_url(); ?>/wp-content/plugins/woocommerce/assets/images/placeholder.png">
                <?php endif; ?>

                <input type="hidden" name="_upload_hover_id[<?php echo $loop; ?>]" class="upload_image_id" value="<?php echo $upload_hover_id; ?>">
            </a>
    </p>

    <?php
}


/**
 * Save new fields for variations
 */
function save_variable_fields( $post_id ) {
    if (isset( $_POST['variable_sku'] ) ) :
        $variable_sku          = $_POST['variable_sku'];
        $variable_post_id      = $_POST['variable_post_id'];

        $_text_field = $_POST['_upload_hover_id'];
        for ( $i = 0; $i < sizeof( $variable_sku ); $i++ ) :
            $variation_id = (int) $variable_post_id[$i];
            if ( isset( $_text_field[$i] ) ) {
                update_post_meta( $variation_id, '_upload_hover_id', stripslashes( $_text_field[$i] ) );
            }
        endfor;

    endif;
}

add_filter( 'woocommerce_checkout_fields' , 'custom_rename_wc_checkout_fields' );
// Change placeholder and label text
function custom_rename_wc_checkout_fields( $fields ) {
    $fields['billing']['billing_first_name']['label'] = 'ПІБ';
    $fields['billing']['billing_address_1']['placeholder'] = '';
    $fields['billing']['billing_phone']['input_class'][] = 'phone-mask';

    $fields['billing']['billing_nova_poshta_region']['label'] = 'Область';
    $fields['billing']['billing_nova_poshta_warehouse']['label'] = 'Відділення';
    $fields['billing']['billing_nova_poshta_city']['label'] = 'Місто';

    return $fields;
}

//add_filter("woocommerce_checkout_fields", "order_fields");
//
//function order_fields($fields) {
//
//    $order = array(
//        "billing_first_name",
//        "billing_email",
//        "billing_phone"
//    );
//    foreach($order as $field)
//    {
//        $ordered_fields[$field] = $fields["billing"][$field];
//        var_dump( $ordered_fields[$field]);
//    }
//
//    $fields["billing"] = $ordered_fields;
//    return $fields;
//
//}


/**
 * Create woocommerce order after send form "Buy in one click"
 */
function one_click_create_order($productID, $variationID, $name, $mail, $phone, $comment, $communication_method) {

  global $woocommerce;

  /*$membershipProduct = new WC_Product_Variable($productID);
  $theMemberships  = $membershipProduct->get_available_variations();
  $variationsArray = array();

  foreach ($theMemberships as $membership) {
      if ($membership['sku'] == $chosenVariation) {
          $variationID = $membership['variation_id'];
          $variationsArray['variation'] = $membership['attributes'];
      }
  }

  $productID = new WC_Product_Variation($variationID);*/

  $user_phone_escaped = preg_replace('/[^0-9+]/', '', $phone);
  $_POST['billing_email'] = $mail;
  $_POST['billing_phone'] = $user_phone_escaped;

  if ($productID) {
    $address = array(
      'first_name' => $name,
      'email'      => $mail,
      'phone'      => $user_phone_escaped,
      // 'last_name'  => 'Conlin',
      // 'company'    => 'Speed Society',
      // 'address_1'  => '123 Main st.',
      // 'address_2'  => '104',
      // 'city'       => 'San Diego',
      // 'state'      => 'Ca',
      // 'postcode'   => '92121',
      // 'country'    => 'US'
    );
    $varProduct = new WC_Product_Variation($variationID);
    $order = wc_create_order();

    if (!empty($variationID)) {
      $order->add_product(wc_get_product($varProduct), 1);
    } else {
      $order->add_product(wc_get_product($productID), 1);
    }

    $order->set_address( $address, 'billing' );
    $order->set_customer_note( $comment );
    $order->calculate_totals();
    $order->update_status("pending", 'Imported order', true);
    $order->save();

    update_post_meta( $order->id, "Спосіб зв'язку", $communication_method );

    $mailer = WC()->mailer();
    $mails = $mailer->get_emails();
    if ( ! empty( $mails ) ) {
        foreach ( $mails as $mail ) {
            if ( $mail->id == 'customer_processing_order' || $mail->id == 'admin_new_order' ) {
                update_post_meta( $order->id, 'is_one_click', 1 );
                $mail->trigger( $order->id );
            }
          }
    }

    return $order;
  } 
}



function after_order_create ($order) {
  $user_phone_escaped = preg_replace('/[^0-9+]/', '', $order->get_billing_phone());
  $order->set_billing_phone($user_phone_escaped);

  return $order;
}
add_filter( 'woocommerce_checkout_create_order', 'after_order_create', 10, 1 );



/**
 * Saving custom fields data of custom products tab metabox
 */
function notebook_product_meta_fields_save( $post_id ){

  if ( isset( $_POST['_display_thumbnail_variation'] ) ) {
    update_post_meta( $post_id, '_display_thumbnail_variation', esc_attr( $_POST['_display_thumbnail_variation'] ) );
  } else {
    update_post_meta( $post_id, '_display_thumbnail_variation', '' );
  }

  if ( isset( $_POST['_dnot_display_all_variations'] ) ) {
    update_post_meta( $post_id, '_dnot_display_all_variations', esc_attr( $_POST['_dnot_display_all_variations'] ) );
  } else {
    update_post_meta( $post_id, '_dnot_display_all_variations', '' );
  }

  if ( isset( $_POST['_common_product_name'] ) ) {
    update_post_meta( $post_id, '_common_product_name', esc_attr( $_POST['_common_product_name'] ) );
  } else {
    update_post_meta( $post_id, '_common_product_name', '' );
  }
}
add_action( 'woocommerce_process_product_meta', 'notebook_product_meta_fields_save' );



function notebook_add_fields_to_general_tab() {

    global $post;
    ?>

        <div class="options_group">

          <?php
            woocommerce_wp_checkbox( 
              array( 
                'id'    => '_display_thumbnail_variation', 
                'label' => 'Выводить миниатюры вариаций', 
              )
            );
            woocommerce_wp_checkbox( 
              array( 
                'id'    => "_dnot_display_all_variations", 
                'label' => 'Не выводить все вариации на главной',  
              )
            );
            $args = array(
              'id'    => '_common_product_name',
              'label' => 'Общее название для товара',
            );
            woocommerce_wp_text_input( $args );
          ?>

        </div>

    <?php
}
add_action( 'woocommerce_product_options_general_product_data', 'notebook_add_fields_to_general_tab' );

















add_action('woocommerce_after_checkout_billing_form', 'ut_checkout_field');

function ut_checkout_field( $checkout ) {
	
	echo '<div class="woocommerce-billing-fields__field-wrapper not-border">';
				
	woocommerce_form_field( 'ut_communication_method', array( 
		'type' => 'select', 
    'options' => [
      "" => "---",
      "Не зв’язуватися ніяк" => "Не зв’язуватися ніяк",
      'Зателефонувати за вказаним телефоном' => 'Зателефонувати за вказаним телефоном',
      'Viber' => 'Viber',
      'Telegram' => 'Telegram',
      'Email' => 'Email',
    ],
		'class' => array('woocommerce-input-wrapper'), 
		'required' => true,
		'label' => __("Спосіб зв’язку"),
		), $checkout->get_value( 'ut_communication_method' ));

	echo '</div>';
}

/**
 * Process the checkout
 **/
add_action('woocommerce_checkout_process', 'ut_checkout_field_process');

function ut_checkout_field_process() {
	global $woocommerce;
	
	if ( ! $_POST['ut_communication_method'] ) {
    wc_add_notice( __( "Поле Спосіб зв’язку обов'язкове для заповнення" ), 'error' ); 
  }
}

/**
 * Update the user meta with field value
 **/
add_action('woocommerce_checkout_update_user_meta', 'ut_checkout_field_update_user_meta');

function ut_checkout_field_update_user_meta( $user_id ) {
	if ($user_id && $_POST['ut_communication_method']) {
    update_user_meta( $user_id, 'ut_communication_method', esc_attr($_POST['ut_communication_method']) );
  }
}

/**
 * Update the order meta with field value
 **/
add_action('woocommerce_checkout_update_order_meta', 'ut_checkout_field_update_order_meta');

function ut_checkout_field_update_order_meta( $order_id ) {
	if ($_POST['ut_communication_method']) {
    update_post_meta( $order_id, "Спосіб зв'язку", esc_attr($_POST['ut_communication_method']));
  }
}

/**
 * Add the field to order emails
 **/
add_filter('woocommerce_email_order_meta_keys', 'ut_checkout_field_order_meta_keys');

function ut_checkout_field_order_meta_keys( $keys ) {
	$keys[] = "Спосіб зв'язку";
	return $keys;
} 

function ut_order_phone_backend($order) {
  $val = get_post_meta( $order->get_id(), "Спосіб зв'язку", true );
  $options = [
    "" => "---",
    "Не зв’язуватися ніяк" => "Не зв’язуватися ніяк",
    'Зателефонувати за вказаним телефоном' => 'Зателефонувати за вказаним телефоном',
    'Viber' => 'Viber',
    'Telegram' => 'Telegram',
    'Email' => 'Email',
  ];

  if ( isset( $options[ $val ] ) ) {
    echo "<p><strong>Спосіб зв’язку:</strong><br>" . $options[ $val ] . "</p><br>";
  }
} 
add_action( 'woocommerce_admin_order_data_after_billing_address','ut_order_phone_backend', 10, 1 );






function ut_load_products() {

  check_ajax_referer( 'home_nonce', 'ajax_nonce' );

  $cache_key = 'load_products';
	$template = wp_cache_get( $cache_key );

	if ( false !== $template ) {
		wp_send_json_success([
      'products' => $template,
    ]);
  }

  ob_start();
  get_template_part('template-parts/home/product');
  $template = ob_get_clean();

	wp_cache_set( $cache_key, $template ); // добавим данные в кэш


  wp_send_json_success([
    'products' => $template,
  ]);
}

if ( wp_doing_ajax() ) {
  add_action( 'wp_ajax_load_products', 'ut_load_products' );
  add_action( 'wp_ajax_nopriv_load_products', 'ut_load_products' );
}






function ut_get_product_data_one_click() {

  check_ajax_referer( 'home_nonce', 'ajax_nonce' );

  if ( ! isset($_POST['product_id']) ) {
    return false;
  }

  if ( isset($_POST['variation_id']) && ! empty($_POST['variation_id']) ) {
    $product = wc_get_product($_POST['variation_id']);
  } else {
    $product = wc_get_product($_POST['product_id']);
  }
  
  if ( ! $product ) {
    return false;
  }

  $attributes = wc_get_product_terms( $product->get_id(), 'pa_color' );
  $currency   = get_woocommerce_currency_symbol();
  $price      = get_post_meta( $product->get_id(), '_regular_price', true);
  $img_hover  = carbon_get_post_meta( $product->get_id(), 'hover_img_product' );
  $thumbnail_url = get_the_post_thumbnail_url( $product->get_id(), 'medium_large' );
  $preorder   = get_post_meta( $product->get_id(), '_ywpo_preorder' );
  $select_html = '';

  if ( isset($preorder[0]) ) {
      $preorder = $preorder[0];
  } else {
      $preorder = 'no';
  }

  if ( $product->get_id() == 5728 ) { 
      $option = "<option selected disabled>Розмір</option>"; //чехол Faces
  } elseif ( $product->get_id() == 5766 ) { 
      $option = "<option selected disabled>Розмір</option>"; //чехол Flowers
  } elseif ( $product->get_id() == 5778 ) { 
      $option = "<option selected disabled>Розмір</option>"; //чехол Black
  } elseif ( $product->get_id() == 5976 ) { 
      $option = "<option selected disabled>Розмір</option>"; //чехол We Bad
  } elseif ( $product->get_id() == 6399 ) { 
      $option = "<option selected disabled>Розмір</option>"; //чехол Sale 30%
  } elseif ( $product->get_id() == 418 ) { 
      $option = "<option selected disabled>Дизайн</option>"; //кошельки
  } elseif ( $product->get_id() == 283 ) { 
      $option = "<option selected disabled>Колір обкладинки</option>"; //БДД
  } elseif ( $product->get_id() == 96 ) { 
      $option = "<option selected disabled>Мова</option>"; //МБ
  } elseif ( $product->get_id() == 966 ) { 
      $option = "<option selected disabled>Колір обкладинки</option>"; //Тревел бук
  } else {
      $option = "<option selected disabled>Колір</option>";
  } 

  if ( $product->is_type( 'variable' ) ) {
    $available_variations = $product->get_available_variations();
    $attrs = $product->get_available_variations();
    $default_value = $product->get_default_attributes();
    $select_html .= '
    <div class="wrapper-home-select">
        <div class="select-wrapper select-one-click-' . $product->get_id() . '">
            <select class="card_product__select" name="select">';
                $select_html .= $option;
                foreach ( $attrs as $attr ) {
                    // $_price       = json_encode( $attr['price_html'] );
                    $_price       = $attr['display_price'] . ' ' . $currency;
                    $variation_id = $attr['variation_id'];
                    $attr_slug    = $attr['attributes']['attribute_pa_color'];
                    if ( isset($default_value['pa_color']) && $default_value['pa_color'] == $attr_slug ) {
                        $product_color_default = get_attr_name_by_slug($attr_slug); 
                        $select_html .= '<option value="' . $attr_slug . '" data-variation-id="' . $variation_id . '" data-price="' . $_price . '" data-thumb="' . $attr['image']['url'] . '" selected>';
                    } else {
                        $select_html .= '<option value="' . $attr_slug . '" data-variation-id="' . $variation_id . '" data-price="' . $_price . '" data-thumb="' . $attr['image']['url'] . '">';
                    } 

                    $select_html .= get_attr_name_by_slug($attr_slug); 
                    $select_html .= '</option>';
                }
            $select_html .= '</select>
        </div>
    </div>';
    
  } else {
    ////////////////////////////////////////////
    $_product = wc_get_product($_POST['product_id']);
    if ($_product && $_product->is_type( 'variable' )) {
      $available_variations = $_product->get_available_variations();
      $attrs = $_product->get_available_variations();
      $default_value = $_product->get_default_attributes();
      $select_html .= '
      <div class="wrapper-home-select">
          <div class="select-wrapper select-one-click-' . $product->get_id() . '">
              <select class="card_product__select" name="select">';
                  $select_html .= $option;
                  foreach ( $attrs as $attr ) {
                      // $_price       = json_encode( $attr['price_html'] );
                      $_price       = $attr['display_price'] . ' ' . $currency;
                      $variation_id = $attr['variation_id'];
                      $attr_slug    = $attr['attributes']['attribute_pa_color'];
                      if ( isset($default_value['pa_color']) && $default_value['pa_color'] == $attr_slug ) {
                          $product_color_default = get_attr_name_by_slug($attr_slug); 
                          $select_html .= '<option value="' . $attr_slug . '" data-variation-id="' . $variation_id . '" data-price="' . $_price . '" data-thumb="' . $attr['image']['url'] . '" selected>';
                      } else {
                          $select_html .= '<option value="' . $attr_slug . '" data-variation-id="' . $variation_id . '" data-price="' . $_price . '" data-thumb="' . $attr['image']['url'] . '">';
                      } 

                      $select_html .= get_attr_name_by_slug($attr_slug); 
                      $select_html .= '</option>';
                  }
              $select_html .= '</select>
          </div>
      </div>';
    }
    ////////////////////////////////////////////
  }

  wp_send_json_success([
    'preorder' => $preorder,
    'text' => 'Купити в 1 клік',
    'title' => $product->get_name(),
    // 'url' => $product->get_permalink().'?color=' . $value['attributes']['attribute_pa_color'],
    'url' => $product->get_permalink(),
    'price' => $product->get_price() . ' ' . $currency,
    'select_html' => $select_html,
    'select' => "select-one-click-" . $product->get_id(),
    'thumb' => $thumbnail_url,
  ]);
}

if ( wp_doing_ajax() ) {
  add_action( 'wp_ajax_get_product_data_one_click', 'ut_get_product_data_one_click' );
  add_action( 'wp_ajax_nopriv_get_product_data_one_click', 'ut_get_product_data_one_click' );
}