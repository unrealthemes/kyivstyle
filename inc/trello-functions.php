<?php 


/**
 * Send order to trello
 */
function send_order_to_trello($data) {

	$key    = carbon_get_theme_option('key_trello');
	$token  = carbon_get_theme_option('token_trello');
	$idList = carbon_get_theme_option('id_list_trello');
	$trelloCard  = new TrelloCard($key, $token);
	$list_string = get_title_card( $data['product_list'] );
	$name = $data['id'] . ' — ' . $list_string;
	$mail_body = "";

	/*
	if ( $data['type'] == 'c_card' || $data['type'] == 'np_card' ) {
		$name .= ' #оплачен';
	}
	*/

	/*
	if ( $data['type'] == 'c_nal' ) { // courier nal

  	// Creating a Card
	$data = array(
		// 'name' => $data['id'] . ' — ' . $list_string,
   		'desc' =>
'**Имя:** ' . $data['name'] . '
**Адрес:** ' . $data['address'] . '
**Почта:** ' . $data['email'] . '
**Телефон:** ' . $data['phone'] . '
**Комментарий:** ' . $data['note'] . '
**Способ связи:** ' . $data['communication_method'] . ' 
```' . $data['product_list'] . '``` 
**Оплата**: ' . $data['payment_method_title'] . '
' . $data['shipping_total'] . '
' . $data['total'] . '

**ЕН:** `0`',
   		'due' => null,
   		// 'idList' => $idList,
   		'urlSource' => null
  	);  

  	} else if ( $data['type'] == 'c_card' ) { // courier card

  	// Creating a Card
	$data = array(
		// 'name' => $data['id'] . ' — ' . $list_string,
   		'desc' =>
'**Имя:** ' . $data['name'] . '
**Адрес:** ' . $data['address'] . '
**Почта:** ' . $data['email'] . '
**Телефон:** ' . $data['phone'] . '
**Комментарий:** ' . $data['note'] . '
**Способ связи:** ' . $data['communication_method'] . ' 
```' . $data['product_list'] . '``` 
**Оплата**: ' . $data['payment_method_title'] . '
' . $data['shipping_total'] . '
' . $data['total'] . '

**ЕН:** `0`',
   		'due' => null,
   		// 'idList' => $idList,
   		'urlSource' => null
  	);
	}
	*/

	// nova poshta card
	// courier card
	if (($data['type'] == 'np_card') || ($data['type'] == 'c_card'))
	{
		$mail_body .= "<b>Имя:</b> " . $data['name'] . "<br>";
		$mail_body .= "<b>Адрес:</b> " . $data['address'] . "<br>";
		$mail_body .= "<b>Почта:</b> " . $data['email'] . "<br>";
		$mail_body .= "<b>Телефон:</b> " . $data['phone'] . "<br>";
		$mail_body .= "<b>Комментарий:</b> " . $data['note'] . "<br>";
		$mail_body .= "<b>Способ связи:</b> " . $data['communication_method'] . "<br>";
		
		$mail_body .= "<p>";
		$mail_body .= $data['product_list'];
		$mail_body .= "<p>";
		
		
		
		$mail_body .= "<p>";
		
		$mail_body .= $data['who_pays_shipping'] . "<br>";							//Кто платит за доставку: Мы❓❓❓
		$mail_body .= "<b>Оплата</b>: " . $data['payment_method_title'] . "<br>";	//Оплата: Оплачен
		$mail_body .= $data['back'] . "<br>";										// Обратно: Ничего
		$mail_body .= $data['total'] . "<br>";										// Стоимость без доставки: 1190 грн.
		
		$mail_body .= "</p>";
		
		
		
		$mail_body .= "<p>";
		$mail_body .= "<b>ЕН:</b> <code>0</code>";
		$mail_body .= "</p>";
	}

	// nova poshta nal
	// courier nal
	else if (($data['type'] == 'np_nal') || ($data['type'] == 'c_nal'))
	{
		$mail_body .= "<b>Имя:</b> " . $data['name'] . "<br>";
		$mail_body .= "<b>Адрес:</b> " . $data['address'] . "<br>";
		$mail_body .= "<b>Почта:</b> " . $data['email'] . "<br>";
		$mail_body .= "<b>Телефон:</b> " . $data['phone'] . "<br>";
		$mail_body .= "<b>Комментарий:</b> " . $data['note'] . "<br>";
		$mail_body .= "<b>Способ связи:</b> " . $data['communication_method'] . "<br>";
		
		$mail_body .= "<p>";
		$mail_body .= $data['product_list'];
		$mail_body .= "<p>";
		
		$mail_body .= "<p>";
		$mail_body .= $data['who_pays_shipping'] . "<br>";
		$mail_body .= "<b>Оплата:</b> " . $data['payment_method_title'] . "<br>";
		$mail_body .= "<b>Обратно:</b> " . $data['back'] . "<br>";
		$mail_body .= "</p>";
		
		$mail_body .= "<p>";
		$mail_body .= "<b>ЕН:</b> <code>0</code>";
		$mail_body .= "</p>";
	}
		/*   
	$data = array(
		// 'name' => $data['id'] . ' — ' . $list_string,
   		'desc' =>
'**Имя:** ' . $data['name'] . '
**Адрес:** ' . $data['address'] . '
**Почта:** ' . $data['email'] . '
**Телефон:** ' . $data['phone'] . '
**Комментарий:** ' . $data['note'] . '
**Способ связи:** ' . $data['communication_method'] . ' <p>
    ' . $data['product_list'] . '</p>
**Оплата**: ' . $data['payment_method_title'] . '
' . $data['back'] . '
' . $data['shipping_total'] . '
' . $data['total'] . '

**ЕН:** `0`',
   		'due' => null,
   		// 'idList' => $idList,
   		'urlSource' => null
  	);
	*/

	/*
  	} else if ( $data['type'] == 'np_card' ) { // nova poshta card

  		  	// Creating a Card
	$data = array(
		// 'name' => $data['id'] . ' — ' . $list_string,
   		'desc' =>
'**Имя:** ' . $data['name'] . '
**Адрес:** ' . $data['address'] . '
**Почта:** ' . $data['email'] . '
**Телефон:** ' . $data['phone'] . '
**Комментарий:** ' . $data['note'] . '
**Способ связи:** ' . $data['communication_method'] . ' 
```' . $data['product_list'] . '```  
' . $data['who_pays_shipping'] . '
**Оплата**: ' . $data['payment_method_title'] . '
' . $data['back'] . '
' . $data['shipping_total'] . '
' . $data['total'] . '

**ЕН:** `0`',
   		'due' => null,
   		// 'idList' => $idList,
   		'urlSource' => null
  	);  

  	} 
	  */

	//   implode("\r\n", $data)
	//$headers = 'kyivstyle.com' . "\r\n";
	$headers = "";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
	//wp_mail('dmitrijermolov+dyi4dype7oqltgcupqtc@boards.trello.com', $name, $data['desc'], $headers);
	wp_mail('dmitrijermolov+dyi4dype7oqltgcupqtc@boards.trello.com', $name, $mail_body, $headers);

	// $return = $trelloCard->post($data);
}


function one_click_send_order_to_trello($order) {

	$key    = carbon_get_theme_option('key_trello');
	$token  = carbon_get_theme_option('token_trello');
	$idList = carbon_get_theme_option('id_list_trello');
	$trelloCard  = new TrelloCard($key, $token);
	$data        = $order->get_data();
	$statuses    = array(
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
	$data_card['total']   = $data['total']." ".get_woocommerce_currency_symbol();
	$data_card['name']    = $data['billing']['first_name'];
	$data_card['address'] = $data['billing']['address_1'];
	$data_card['email']   = $data['billing']['email'];
	$data_card['note']    = $order->customer_message;
	$data_card['shipping_total'] = $data['shipping_total']." ".get_woocommerce_currency_symbol();
	$data_card['payment_method'] = $data['payment_method'];
	$data_card['payment_method_title'] = $data['payment_method_title'];
	$data_card['communication_method'] = get_post_meta( $order->id, "Спосіб зв'язку", true ); 

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

	    $product_details .=  '
	'.$_product->get_title().' ('.$attr.') x '.$product['qty'].' шт. = '.$product['total'].get_woocommerce_currency_symbol();
	  } else {
	    $product_details .=  '
	'.$product['name'].' x '.$product['qty'].' шт. = '.$product['total'].get_woocommerce_currency_symbol();
	  }
	}
	
	$data_card['product_list'] = $product_details;
  	$list_string = get_title_card( $data_card['product_list'] );
  	$name = '⚡️' . $data_card['id'] . ' — ' . $list_string;

	// Creating a Card
	$data = array(
		// 'name' => '*' . $data_card['id'] . ' — ' . $list_string,
   		'desc' =>
'#Заказ в 1 клик
**Имя:** ' . $data_card['name'] . '
**Адрес:** ' . $data_card['address'] . '
**Почта:** ' . $data_card['email'] . '
**Телефон:** ' . $data_card['phone'] . '
**Комментарий:** ' . $data_card['note'] . '
**Способ связи:** ' . $data_card['communication_method'] . ' 
```' . $data_card['product_list'] . '``` 
**Оплата**: ' . $data_card['payment_method_title'] . '
**Доставка:** ' . $data_card['shipping_total'] . '
**Всего:** ' . $data_card['total'] . '

**ЕН:** `0`',
   		'due' 		=> null,
   		// 'idList' 	=> $idList,
   		'urlSource' => null
  	);

  	$headers = 'kyivstyle.com' . "\r\n";
	wp_mail('dmitrijermolov+dyi4dype7oqltgcupqtc@boards.trello.com', $name, implode("\r\n", $data), $headers);

	// return $trelloCard->post($data);
}



function get_title_card( $product_list ) {

	$list_string = '';

	if (strpos($product_list, 'Мамочкин') !== false) {
        $list_string .= 'МБ ';
    }

    if (strpos($product_list, 'Гаманець') !== false) {
        $list_string .= 'КОШ ';
    }

    if (strpos($product_list, 'Чохол') !== false) {
        $list_string .= 'ЧЕХОЛ ';
    }

    if (strpos($product_list, 'Блокнот для дела') !== false) {
        $list_string .= 'БДД ';
    }

    if (strpos($product_list, 'Тревел бук') !== false) {
        $list_string .= 'ТРЕВЕЛ ';
    }

    if (strpos($product_list, 'Взрослый блокнот') !== false) {
        $list_string .= 'ВБ ';
    }

    if (strpos($product_list, 'А5') !== false) {
        $list_string .= 'А5 ';
    }
    
    if (strpos($product_list, 'Фитнес блокнот') !== false) {
        $list_string .= 'ФБ ';
    }
	
	if (strpos($product_list, 'Обкладинка') !== false) {
		$list_string .= 'ОБЛОЖКА ';
	}

    return $list_string;
}