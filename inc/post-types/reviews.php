<?php 

/**
 * Registers a new post type "Отзывы"
 */
function register_post_type_reviews() {

	$labels = array(
		'name'                => __( 'Отзывы', 'travel' ),
		'singular_name'       => __( 'Отзыв', 'travel' ),
		'add_new'             => _x( 'Добавить новый отзыв', 'travel' ),
		'add_new_item'        => __( 'Добавить новый отзыв', 'travel' ),
		'edit_item'           => __( 'Редактировать Отзыв', 'travel' ),
		'new_item'            => __( 'Новый Отзыв', 'travel' ),
		'view_item'           => __( 'Показать Отзыв', 'travel' ),
		'search_items'        => __( 'Искать Отзывы', 'travel' ),
		'not_found'           => __( 'Отзывы не найдены', 'travel' ),
		'not_found_in_trash'  => __( 'Отзывы не найдены в Корзине', 'travel' ),
		'parent_item_colon'   => __( 'Родительский Отзыв:', 'travel' ),
		'menu_name'           => __( 'Отзывы', 'travel' ),
	);

	$args = array(
		'labels'              => $labels,
		'hierarchical'        => false,
		'description'         => 'description',
		'taxonomies'          => array(),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => null,
		'menu_icon'           => 'dashicons-format-chat',
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

	register_post_type( 'reviews', $args );
}

add_action( 'init', 'register_post_type_reviews' );