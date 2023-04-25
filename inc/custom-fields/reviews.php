<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make( 'post_meta', 'Data Review' )
	->where( 'post_type', '=', 'reviews' )
	->add_fields( array(
        Field::make( 'image', 'img_reviews', 'Изображение' )->set_width( 8 ),
        // Field::make( 'text', 'name_reviews', 'ФИО' )->set_width( 40 ),
        Field::make( 'text', 'speciality_reviews', 'Специальность' )->set_width( 20 ),
        Field::make( 'rich_text', 'text_reviews', 'Текст Отзыва' )->set_width( 60 )
	));