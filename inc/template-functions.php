<?php 

/**
 * Get permalink by template name
 */
function get_permalik_by_template( $template ) {

    $result = '';

    if ( !empty( $template ) ) {
        $pages = get_pages( array(
            'meta_key'   => '_wp_page_template',
            'meta_value' => $template
        ) );
        $template_id = $pages[0]->ID;
        $page = get_post( $template_id );

        $result = get_permalink( $page );
    }
    
    return $result;
}

function ut_get_page_id_by_template( $template ) {

	$result = '';

	if ( ! empty( $template ) ) {
		$pages = get_pages( [
		    'meta_key'   => '_wp_page_template',
		    'meta_value' => $template
		] );
		$result = $pages[0]->ID;
	}
	
	return $result;
}

/**
 * SVG to upload mimes.
 */
function notebook_add_svg_to_upload_mimes( $upload_mimes ) {

    $upload_mimes['svg'] = 'image/svg+xml';
    $upload_mimes['svgz'] = 'image/svg+xml';

    return $upload_mimes;
}
add_filter( 'upload_mimes', 'notebook_add_svg_to_upload_mimes', 10, 1 );

/**
 * Hide editor on choose templates
 */
function notebook_hide_editor() {
    
    $template_file = $template_file = basename( get_page_template() );

    if( 
        $template_file == 'template-contacts.php' || 
        $template_file == 'template-reviews.php'  || 
        $template_file == 'template-home.php' 
    ){
        remove_post_type_support('page', 'editor');
    }
}
add_action( 'admin_head', 'notebook_hide_editor' );



/**
 * Extend admin search post type whitelist
 */
function notebook_extend_admin_search_whitelist( $query ) {
 
    // Extend search for whitelist post type
    $post_type = 'whitelist';
    // Custom fields to search for
    $custom_fields = array(
        "_first_name",
        "_email",
        "_phone",
    );
 
    if( ! is_admin() )
        return;
    
    if ( $query->query['post_type'] != $post_type )
        return;
 
    $search_term = $query->query_vars['s'];
 
    // Set to empty, otherwise it won't find anything
    $query->query_vars['s'] = '';
 
    if ( $search_term != '' ) {
        $meta_query = array( 'relation' => 'OR' );
 
        foreach( $custom_fields as $custom_field ) {
            array_push( $meta_query, array(
                'key' => $custom_field,
                'value' => $search_term,
                'compare' => 'LIKE'
            ));
        }
 
        $query->set( 'meta_query', $meta_query );
    };
}
 
add_action( 'pre_get_posts', 'notebook_extend_admin_search_whitelist' );



/**
 * Extend admin search post type blacklist
 */
function notebook_extend_admin_search_blacklist( $query ) {
 
    // Extend search for blacklist post type
    $post_type = 'blacklist';
    // Custom fields to search for
    $custom_fields = array(
        "_first_name",
        "_email",
        "_phone",
    );
 
    if( ! is_admin() )
        return;
    
    if ( $query->query['post_type'] != $post_type )
        return;
 
    $search_term = $query->query_vars['s'];
 
    // Set to empty, otherwise it won't find anything
    $query->query_vars['s'] = '';
 
    if ( $search_term != '' ) {
        $meta_query = array( 'relation' => 'OR' );
 
        foreach( $custom_fields as $custom_field ) {
            array_push( $meta_query, array(
                'key' => $custom_field,
                'value' => $search_term,
                'compare' => 'LIKE'
            ));
        }
 
        $query->set( 'meta_query', $meta_query );
    };
}
 
add_action( 'pre_get_posts', 'notebook_extend_admin_search_blacklist' );



/**
 * Remove admin menu items
 */
function notebook_remove_menus() {
    remove_menu_page( 'index.php' );                  //Dashboard
    remove_menu_page( 'jetpack' );                    //Jetpack* 
    remove_menu_page( 'edit.php' );                   //Posts
//  remove_menu_page( 'upload.php' );                 //Media
//  remove_menu_page( 'edit.php?post_type=page' );    //Pages
//  remove_menu_page( 'edit-comments.php' );          //Comments
//  remove_menu_page( 'themes.php' );                 //Appearance
//  remove_menu_page( 'plugins.php' );                //Plugins
//  remove_menu_page( 'users.php' );                  //Users
//  remove_menu_page( 'tools.php' );                  //Tools
//  remove_menu_page( 'options-general.php' );        //Settings
}
add_action( 'admin_menu', 'notebook_remove_menus' );



/**
 * Disable Emoji start
 */
add_filter('emoji_svg_url', '__return_empty_string');
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');    
remove_filter('the_content_feed', 'wp_staticize_emoji');
remove_filter('comment_text_rss', 'wp_staticize_emoji');  
remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

function notebook_remove_emojis_tinymce($plugins) {

    if ( is_array($plugins) ) {
        return array_diff($plugins, array('wpemoji'));
    } else {
        return array();
    }
}
add_filter('tiny_mce_plugins', 'notebook_remove_emojis_tinymce');