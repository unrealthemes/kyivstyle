<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

$fields = array(
    Field::make( 'text', 'first_name', 'Имя' )->set_width(33),
    Field::make( 'text', 'email', 'Email' )->set_width(33),
    Field::make( 'text', 'phone', 'Телефон' )->set_width(33),
);

Container::make( 'post_meta', 'Customer data' )
    ->where( 'post_type', '=', 'whitelist' )
    ->add_fields($fields);

Container::make( 'post_meta', 'Customer data' )
    ->where( 'post_type', '=', 'blacklist' )
    ->add_fields(array_merge($fields,
            array(
                Field::make( 'textarea', 'reason', 'Причина' )->set_width(100),
            )
        ));