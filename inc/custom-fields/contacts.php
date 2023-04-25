<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('post_meta', 'Custom Data')
	->show_on_template('template-contacts.php')
	->show_on_post_type('page') 
    ->add_tab( 'Main', array(
        Field::make( "text", "title_top_block_contacts", "Заглавие")->set_width( 33.3 ),
        Field::make( "text", "phone_top_block_contacts", "Телефон")->set_width( 33.3 ),
        Field::make( "text", "mail_top_block_contacts", "Электронная почта")->set_width( 33.3 ),
        Field::make( "text", "title_bottom_block_contacts", "Заглавие")->set_width( 33.3 ),
        Field::make( "text", "phone_bottom_block_contacts", "Телефон")->set_width( 33.3 ),
        Field::make( "text", "mail_bottom_block_contacts", "Электронная почта")->set_width( 33.3 ),
        Field::make( "text", "title_form_contacts", "Заглавие блока формы")->set_width( 50 ),
        Field::make( "text", "shortcode_form_contacts", "Шорткод формы CF7")->set_width( 50 )

    ));