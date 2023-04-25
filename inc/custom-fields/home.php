<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make( 'post_meta', 'Data Review' )
	->show_on_template('template-home.php')
	->show_on_post_type('page') 
	->add_tab( __('Основное'), array(
        Field::make( 'image', 'img_home', 'Фоновое изображение' )->set_width( 8 ),
        Field::make( 'text', 'title_home', 'Заглавие' )->set_width( 30 ),
        Field::make( 'textarea', 'desc_home', 'Описание' )->set_width( 50 ),
        Field::make( 'association', 'products_grid_home', 'Выбор Товаров (не больше 4-x)' )
    		->set_max( 4 )
    		->set_types( array(
		        array(
		            'type' => 'post',
		            'post_type' => 'product'
		        )
		    ) ),
	    Field::make( 'association', 'all_products_home', 'Выбор Товаров' )
    		->set_types( array(
		        array(
		            'type' => 'post',
		            'post_type' => 'product'
		        )
		    ) ),
	    Field::make( 'rich_text', 'seo_text_home', 'СЕО текст' )->set_width( 50 ),
	))
	->add_tab( __('Instagram'), array(
        Field::make( 'text', 'title_inst_home', 'Заглавие' )->set_width( 33.3 ),
        Field::make( 'text', 'user_id_inst_home', 'User ID (Instagramm)' )->set_width( 33.3 ),
        Field::make( 'text', 'token_inst_home', 'Access Token (Instagramm)' )->set_width( 33.3 )
	))
	->add_tab( __('Отзывы'), array(
        Field::make( 'text', 'title_reviews_home', 'Заглавие' ),
        Field::make( 'association', 'items_reviews_home', 'Выбор Отзывов (не больше 3-х)' )
    		// ->set_max( 3 )
    		->set_types( array(
		        array(
		            'type' => 'post',
		            'post_type' => 'reviews'
		        )
		    ) ),
	    Field::make( 'text', 'text_btn_reviews_home', 'Текст ссылки' ),
	    Field::make( 'association', 'link_btn_reviews_home', 'Выбор ссылки на страницу всех Отзывов' )
	    	->set_max( 1 )
    		->set_types( array(
		        array(
		            'type' => 'post',
		            'post_type' => 'page'
		        )
		    ) )
	));