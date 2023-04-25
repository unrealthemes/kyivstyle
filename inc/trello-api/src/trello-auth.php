<?php
// define ('TRELLO_DEV_KEY', 'e71d705c2ee75a3e867585be63229b96');
// define ('TRELLO_USER_TOKEN', '6220fedc1858cd83de68f08e5478eeb950b32875879c95d17fe65257aaf66183');

$key    = get_option('_key_trello');
$token  = get_option('_token_trello');

define ( 'TRELLO_DEV_KEY', $key );
define ( 'TRELLO_USER_TOKEN', $token );
?>