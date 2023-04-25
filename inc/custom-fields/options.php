<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make( 'theme_options', __( 'Theme Options', 'notebook' ) )
    ->set_icon( 'dashicons-hammer' )
    ->set_page_menu_title( 'Настройка шаблона' )
	->add_tab( __('Шапка сайта'), array(
        Field::make( 'image', 'logo_header', 'Логотип (SVG)' )->set_width( 20 ),
        Field::make( 'image', 'cart_header', 'Иконка корзины (SVG)' )->set_width( 20 ),
        Field::make( 'text', 'phone_header', 'Телефон' )->set_width( 60 ),
        Field::make( 'complex', 'rep_social_header', 'Cоциальные иконки (боковое меню)' )->set_collapsed( true )
            ->add_fields( array(
                Field::make( 'icon', 'icons_rep_social_header', __( 'Иконка' ) )->set_width( 50 ),
                Field::make( "text", "url_rep_social_header", "Ссылка")->set_width( 50 )->set_default_value( 'https://www.google.ru/' )
            ))
    ))
    ->add_tab( __('Подвал сайта'), array(
        Field::make( 'image', 'logo_footer', 'Логотип (SVG)' )->set_width( 20 ),
        Field::make( 'text', 'title_subscr_footer', 'Заглавие блока "Подписка"' )->set_width( 50 ),
        Field::make( 'complex', 'rep_social_footer', 'Cоциальные иконки' )->set_collapsed( true )
            ->add_fields( array(
                Field::make( 'icon', 'icons_rep_social_footer', __( 'Иконка' ) )->set_width( 50 ),
                Field::make( "text", "url_rep_social_footer", "Ссылка")->set_width( 50 )->set_default_value( 'https://www.google.ru/' )
            ))
    ))
    ->add_tab( __('Trello'), array(
        Field::make( 'text', 'key_trello', 'Ключ (key)' )->set_width( 33.3 ),
        Field::make( 'text', 'token_trello', 'Токен (token)' )->set_width( 33.3 ),
        Field::make( 'text', 'id_list_trello', 'ID колонки (Id list)' )->set_width( 33.3 )
    ))
    ->add_tab( __('TurboSMS'), array(
        Field::make( 'text', 'login_turbosms', 'Логин' )->set_width( 50 ),
        Field::make( 'text', 'pass_turbosms', 'Пароль' )->set_width( 50 ),
        Field::make( 'text', 'number_card_turbosms', 'Номер карты' )->set_width( 50 ),
        Field::make( 'textarea', 'text_turbosms', 'Текст сообщения' )->set_width( 50 ),
        Field::make( 'textarea', 'invoice_sms_text', 'Текст сообщения с номером накладной' )
            ->set_help_text('Используйте __invoice_id__ в качестве шаблона (Вместе со знаками нижнего подчёркивания). Вместо шаблона будет подставлен номер накладной из заказа')
            ->set_width( 50 ),
        Field::make( 'textarea', 'cardnumber_sms_text', 'Текст сообщения с номером карты' )
            ->set_help_text('Используйте __cardnumber__ и __total__ в качестве шаблона (Вместе со знаками нижнего подчёркивания). Вместо шаблонов будут подставлены значение из поля "Номер карты" и общая сумма заказа соответственно')
            ->set_width( 50 ),
        Field::make( 'complex', 'admin_phones', 'Номера рассылки' )->set_collapsed( true )
            ->add_fields( array(
                Field::make( "text", "phone", "Телефон")
            ))
            ->set_help_text('Номера телефонов на которые будет осуществляться рассылка.'),
    ));