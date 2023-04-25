<?php

function register_post_type_lists() {

    $labels = array(
        'singular_name'       => __( 'Покупатель', 'travel' ),
        'add_new'             => _x( 'Добавить Нового Покупателя', 'travel' ),
        'add_new_item'        => __( 'Добавить Нового Покупателя', 'travel' ),
        'edit_item'           => __( 'Редактировать Покупателя', 'travel' ),
        'new_item'            => __( 'Новый Покупатель', 'travel' ),
        'view_item'           => __( 'Показать Покупателя', 'travel' ),
        'search_items'        => __( 'Искать Покупателя', 'travel' ),
        'not_found'           => __( 'Покупатели в списке не найдены', 'travel' ),
        'not_found_in_trash'  => __( 'Покупатели в списке не найдены в Корзине', 'travel' ),
        'parent_item_colon'   => __( 'Родительский Покупатель:', 'travel' ),
    );

    $argsWhite = array(
        'labels'              => $labels,
        'hierarchical'        => false,
        'description'         => 'description',
        'taxonomies'          => array(),
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => null,
        'menu_icon'           => 'dashicons-star-empty',
        'show_in_nav_menus'   => true,
        'publicly_queryable'  => true,
        'exclude_from_search' => false,
        'has_archive'         => true,
        'query_var'           => true,
        'can_export'          => true,
        'rewrite'             => true,
        'capability_type'     => 'post',
        'supports'            => array(
            'title'
        )
    );
    
    $argsBlack = array(
        'labels'              => $labels,
        'hierarchical'        => false,
        'description'         => 'description',
        'taxonomies'          => array(),
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => null,
        'menu_icon'           => 'dashicons-star-filled',
        'show_in_nav_menus'   => true,
        'publicly_queryable'  => true,
        'exclude_from_search' => false,
        'has_archive'         => true,
        'query_var'           => true,
        'can_export'          => true,
        'rewrite'             => true,
        'capability_type'     => 'post',
        'supports'            => array(
            'title'
        )
    );

    $whitelist_args = array_merge($argsWhite, array(
        'labels' => array_merge($labels, array(
            'name'                => __( 'Белый список', 'travel' ),
            'menu_name'           => __( 'Белый список', 'travel' ),
        )),
    ));

    $blacklist_args = array_merge($argsBlack, array(
        'labels' => array_merge($labels, array(
            'name'                => __( 'Чёрный список', 'travel' ),
            'menu_name'           => __( 'Чёрный список', 'travel' ),
        )),
    ));

    register_post_type( 'whitelist', $whitelist_args );
    register_post_type( 'blacklist', $blacklist_args );
}
add_action( 'init', 'register_post_type_lists' );