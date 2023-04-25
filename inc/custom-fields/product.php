<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('post_meta', 'Image product')
	->show_on_post_type('product') 
    ->set_context('side')
    ->add_fields( array(
        Field::make( "image", "hover_img_product", "при наведении (на главной)")
            // ->set_value_type( "url" )
            ->set_default_value( get_template_directory_uri() . "/img/blocnot_hover.jpg" )
    ));

Container::make('post_meta', 'Block Generator')
    ->show_on_post_type('product') 
    ->add_fields( array(
        Field::make( 'complex', 'rep_product', 'Блоки' )->set_collapsed( true )
            ->add_fields( array(
                Field::make( "image", "img_delivery", "160×160 px")->set_width( 8 ),
                Field::make( "text", "title_rep_product", "Крупный текст")->set_width( 40 ),
                Field::make( "rich_text", "desc_rep_product", "Мелкий текст")->set_width( 40 )
            ))
    ));

Container::make('post_meta', 'Sliders')
    ->show_on_post_type('product') 
    ->add_fields( array(
        Field::make( 'complex', 'rep_sl1_product', 'Слайдер #1' )->set_collapsed( true )
            ->add_fields( array(
                Field::make( "image", "img_rep_sl1_product", "Изображение")->set_width( 8 ),
                Field::make( "text", "title_rep_sl1_product", "Заглавие")->set_width( 40 ),
                Field::make( "textarea", "desc_rep_sl1_product", "Описание")->set_width( 40 )
            )),

        Field::make( "separator", "info_product", "Инфо блок"),
        Field::make( "image", "img_info_product", "Изображение")->set_width( 8 ),
        Field::make( "text", "title_info_product", "Заглавие")->set_width( 40 ),
        Field::make( "textarea", "desc_info_product", "Описание")->set_width( 40 ),

        Field::make( 'complex', 'rep_sl2_product', 'Слайдер #2' )->set_collapsed( true )
            ->add_fields( array(
                Field::make( "image", "img_rep_sl2_product", "Изображение")->set_width( 8 ),
                Field::make( "text", "title_rep_sl2_product", "Заглавие")->set_width( 40 ),
                Field::make( "textarea", "desc_rep_sl2_product", "Описание")->set_width( 40 )
            ))
    ));