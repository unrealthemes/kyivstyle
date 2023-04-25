<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('post_meta', 'Custom Data')
	->show_on_template('template-delivery.php')
	->show_on_post_type('page') 
    ->add_tab( 'Доставка', array(
        Field::make( "image", "img_delivery", "Изображение")->set_width( 8 ),
        Field::make( "text", "title_delivery", "Заглавие")->set_width( 50 ),
        Field::make( 'complex', 'rep_delivery', 'Bloks' )->set_collapsed( true )
            ->add_fields( array(
                Field::make( "text", "title_rep_delivery", "Title")->set_width( 50 ),
                Field::make( "textarea", "desc_rep_delivery", "Description")->set_width( 50 )
            ))
    ))
    ->add_tab( 'Оплата', array(
        Field::make( "image", "img_payment", "Изображение")->set_width( 8 ),
        Field::make( "text", "title_payment", "Заглавие")->set_width( 50 ),
        Field::make( 'complex', 'rep_payment', 'Bloks' )->set_collapsed( true )
            ->add_fields( array(
                Field::make( "text", "title_rep_payment", "Title")->set_width( 50 ),
                Field::make( "textarea", "desc_rep_payment", "Description")->set_width( 50 )
            ))
    ));