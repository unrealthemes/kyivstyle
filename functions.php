<?php
/**
 * notebook functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package notebook
 */

/**
 * White stub image for lazy load
 */
$stub = get_template_directory_uri() . '/img/stub.png';

/**
 * Carbon Fields lib
 */
add_action( 'after_setup_theme', 'crb_load' );

function crb_load() {
    require_once( 'vendor/autoload.php' );
    \Carbon_Fields\Carbon_Fields::boot();
}
add_action( 'carbon_fields_register_fields', 'tenthouse_attach_theme_options' );

function tenthouse_attach_theme_options() {

	require get_template_directory() . '/inc/custom-fields/options.php';
	require get_template_directory() . '/inc/custom-fields/home.php';
	require get_template_directory() . '/inc/custom-fields/contacts.php';
	require get_template_directory() . '/inc/custom-fields/delivery.php';
	require get_template_directory() . '/inc/custom-fields/reviews.php';
	require get_template_directory() . '/inc/custom-fields/whitelist-blacklist.php';
	require get_template_directory() . '/inc/custom-fields/product.php';
}

add_filter('carbon_fields_map_field_api_key', 'get_gmaps_api_key');
function get_gmaps_api_key($current_key){
    return 'AIzaSyDL-pHnwb1JGvfG_7wCKcOa2aDOyexT8Ws';
}

if ( ! function_exists( 'notebook_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function notebook_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on notebook, use a find and replace
		 * to change 'notebook' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'notebook', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Главное 1', 'notebook' ),
			'menu-2' => esc_html__( 'Главное 2', 'notebook' ),
			'menu-3' => esc_html__( 'Подвал сайта 1', 'notebook' ),
			'menu-4' => esc_html__( 'Подвал сайта 2', 'notebook' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'notebook_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'notebook_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function notebook_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'notebook_content_width', 640 );
}
add_action( 'after_setup_theme', 'notebook_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function notebook_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'notebook' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'notebook' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'notebook_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function notebook_scripts() {
	//==================================================== CSS ====================================================//
	wp_enqueue_style( 'notebook-css', get_stylesheet_uri() );
	wp_enqueue_style( 'notebook-fontawesome-css', get_template_directory_uri() . '/font-awesome/css/font-awesome.min.css' );
    wp_enqueue_style( 'book-swiper-css', get_template_directory_uri() . '/libs/swiper/swiper.min.css' );
    wp_enqueue_style( 'book-style-css', get_template_directory_uri() . '/css/style.css' );
	wp_enqueue_style('select2-css', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css' );
	//==================================================== JS ====================================================//
	wp_enqueue_script( 'notebook-libs-js', get_template_directory_uri() . '/js/libs.min.js', array(), date("Ymd"), true );
	wp_enqueue_script( 'notebook-lazyload-js', get_template_directory_uri() . '/libs/lazyload/lazysizes.min.js', array(), date("Ymd"), true );
	wp_enqueue_script( 'notebook-common-js', get_template_directory_uri() . '/js/common.min.js', array(), date("Ymd"), true );
	wp_enqueue_script( 'notebook-navigation', get_template_directory_uri() . '/js/navigation.js', array(), date("Ymd"), true );
	wp_enqueue_script( 'notebook-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), date("Ymd"), true );
	wp_enqueue_script(
		'select2-js',
		'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
		[],
		date("Ymd"), 
		true
	);

    if( is_front_page() || is_page_template('template-checkout.php') ) {
        wp_enqueue_script( 'notebook-mask-phone-js', get_template_directory_uri() . '/libs/mask_number_phone/jquery.maskedinput.js', array(), date("Ymd"), true );
    }
	wp_enqueue_script( 'notebook-main-js', get_template_directory_uri() . '/js/main.js', array(), date("Ymd"), true );
	wp_localize_script('notebook-main-js', 'params', array(
	    'ajaxurl'       => admin_url('admin-ajax.php'),
	    'directory_uri' => get_template_directory_uri(),
	    'thanks_url'    => get_permalik_by_template('template-thanks.php'),
	));

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_page_template('template-home.php') ) {
		wp_enqueue_script('ut-home', get_template_directory_uri() . '/js/home.js', ['jquery'], null, true );
		wp_localize_script('ut-home', 'ut_home', [
			'ajax_url' => admin_url('admin-ajax.php'),
			'ajax_nonce' => wp_create_nonce('home_nonce'),
			'theme_uri' => get_template_directory_uri(),
		]);
	}
}

function admin_notebook_scripts() {
	wp_enqueue_script( 'np-send-sms', get_template_directory_uri() . '/js/np_sms_button.js', array(), date("Ymd"), true );
}
add_action( 'wp_enqueue_scripts', 'notebook_scripts' );
add_action( 'admin_enqueue_scripts', 'admin_notebook_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/woocommerce-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Custom post types.
 */
require get_template_directory() . '/inc/post-types/reviews.php';
require get_template_directory() . '/inc/post-types/lists.php';

/**
 * Include Trello api
 */
require get_template_directory() . '/inc/trello-api/src/trello.php';

require get_template_directory() . '/inc/np.php';

/**
 * Trello functionss
 */
require get_template_directory() . '/inc/trello-functions.php';

/**
 * Template functions 
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


/**
 * Ajax load more
 **/
add_action('wp_ajax_loadmore', 'ajax_loadmore');
add_action('wp_ajax_nopriv_loadmore', 'ajax_loadmore');

function ajax_loadmore(){

	$count = 1;
	$args  = array(
		'post__not_in'   => $_POST['post_ids'],
		'posts_per_page' => 3,
		'post_type' 	 => 'reviews',
		'post_status' 	 => 'publish'
	);

	$query = new WP_Query($args);

	if( $query->have_posts() ) :

		while( $query->have_posts() ): $query->the_post();

			get_template_part('template-parts/reviews', 'loop');

		endwhile; ?>
		<script>
		    found_posts = '<?php echo $query->found_posts; ?>';
		    post_ids = '<?php echo $_POST['post_ids']; ?>';
		</script>
	<?php endif; 

	wp_reset_postdata();
	wp_die();
}

/**
 * Instagram api get data
 */
function instagram_api( $link ){

	$c_podkl = curl_init(); 
	curl_setopt($c_podkl, CURLOPT_URL, $link); 
	curl_setopt($c_podkl, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($c_podkl, CURLOPT_TIMEOUT, 20); 
	$json_result = curl_exec($c_podkl); 
	curl_close($c_podkl); 

	return json_decode( $json_result ); 
}

/**
 * Send message turbosms
 *
 * @param $phone
 * @param null $text
 */
function send_message_turbosms($phone, $text = null) {

    try {

	    $client = new SoapClient('http://turbosms.in.ua/api/wsdl.html');

	    $auth = [
	        'login'    => carbon_get_theme_option('login_turbosms'),
	        'password' => carbon_get_theme_option('pass_turbosms')
	    ];

	    $result_auth = $client->Auth($auth);

	    $sms  = [
	        'sender' => 'Kyiv Style',
	        'destination' => $phone,
	        'text' => $text
	    ];
	    $result = $client->SendSMS($sms);

	    return $result->SendSMSResult->ResultArray[0] . PHP_EOL;

    // TODO: process unsuccessful requests
    } catch(Exception $e) {

    	return false;
    }
}

/**
 * Adds a metabox to the right side of the screen under the â€œPublishâ€ box
 */
function add_whitelist_orders_metaboxes() {
    add_meta_box(
        'whitelist_orders',
        'Orders data',
        'whitelist_orders_metabox',
        'whitelist',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'add_whitelist_orders_metaboxes');

function whitelist_orders_metabox(){
    get_template_part( 'template-parts/admin/whitelist');
}

function whitelist_new_column( $columns ) {
    array_insert(
        $columns,
        'date',
        [
            'user_name' => 'Имя',
            'user_email' => 'Email',
            'user_phone' => 'Телефон',
            'order_quantity' => 'Количество заказов',
        ]
    );

    return $columns;
}
add_filter( 'manage_edit-whitelist_columns', 'whitelist_new_column' );

function blacklist_new_column( $columns ) {
    array_insert(
        $columns,
        'date',
        [
            'user_name' => 'Имя',
            'user_email' => 'Email',
            'user_phone' => 'Телефон',
            'reason' => 'Причина',
        ]
    );

    return $columns;
}
add_filter( 'manage_edit-blacklist_columns', 'blacklist_new_column' );

function lists_new_column_content( $column ) {
    global $post;

    $user_name = carbon_get_post_meta($post->ID, 'first_name');
    $user_email = carbon_get_post_meta($post->ID, 'email');
    $user_phone = carbon_get_post_meta($post->ID, 'phone');
    $user_reason = carbon_get_post_meta($post->ID, 'reason');

    if ('order_quantity' === $column) {
        $orders = get_posts(array(
		    'post_type' => 'shop_order',
		    'post_status' => 'wc-processing,wc-completed,wc-pending',
		    'posts_per_page' => -1,
		    'meta_query' => array(
		        'relation' => 'OR',
		        array(
		            'key' => '_billing_email',
		            'value' => $user_email,
		            'compare' => '=',
		        ),
		        array(
		            'key' => '_billing_phone',
		            'value' => $user_phone,
		            'compare' => '=',
		        ),
		    )
		));

        echo count($orders);
    } elseif ('reason' === $column) {
        echo $user_reason;
    }  elseif ('user_name' === $column) {
        echo $user_name;
    } elseif ('user_email' === $column) {
        echo $user_email;
    } elseif ('user_phone' === $column) {
        echo $user_phone;
    }
}
add_action( 'manage_whitelist_posts_custom_column', 'lists_new_column_content' );
add_action( 'manage_blacklist_posts_custom_column', 'lists_new_column_content' );

function array_insert(&$array, $position, $insert)
{
    if (is_int($position)) {
        array_splice($array, $position, 0, $insert);
    } else {
        $pos   = array_search($position, array_keys($array));
        $array = array_merge(
            array_slice($array, 0, $pos),
            $insert,
            array_slice($array, $pos)
        );
    }
}




add_action('wpcf7_before_send_mail', function ( $WPCF7_ContactForm ) {

    if ( $WPCF7_ContactForm->id == 168 ) : 
    	$product_id   = $_POST['product_id'];
    	$variation_id = $_POST['variation_id'];
    	$mail     = $_POST['mail'];
		// $mail = 'test@gmail.com';
    	$name     = $_POST['name-7'];
    	$phone    = $_POST['phone-7'];
    	$comment  = $_POST['textarea-781'];
    	$communication_method  = $_POST['ut_communication_method'];
		
    	$response = send_message_turbosms($phone, carbon_get_theme_option('text_turbosms'));
    	$order    = one_click_create_order($product_id, $variation_id, $name, $mail, $phone, $comment, $communication_method);
    	one_click_send_order_to_trello($order);

    	// add number order to subject message
    	$wpcf7 = WPCF7_ContactForm :: get_current() ;
		$submission = WPCF7_Submission :: get_instance() ;

		if ( $submission ) {
			$posted_data = $submission->get_posted_data() ;

			if ( empty ( $posted_data ) )
				return;
			// do some replacements in the cf7 email body
			$mail = $WPCF7_ContactForm->prop('mail') ;
			$mail['subject'] = $mail['subject'] . " " . $order->id ; // "Заказ в 1 клик #1234"
			// Save the email body
			$WPCF7_ContactForm->set_properties( array("mail" => $mail)) ;

			return $WPCF7_ContactForm ;
		}
    	//

	endif;
});

add_filter( 'body_class', 'custom_class' );
function custom_class( $classes ) {
    if ( is_page_template( 'template-checkout.php' ) ) {
        $classes[] = 'hide';
    }
    return $classes;
}

add_filter( 'add_post_metadata', 'escape_phone_meta', 10, 5 );
function escape_phone_meta( $check, $object_id, $meta_key, $meta_value, $unique ){
    //removes all characters except + and digits from phone meta
    if ($meta_key === '_phone') {
        preg_match('/[^0-9+]/', $meta_value, $matches);

        if (!empty($matches)) {
            $meta_value = preg_replace('/[^0-9+]/', '', $meta_value);
            update_post_meta($object_id, $meta_key, $meta_value);

            $check = false;
        }
    }

    return $check;
}


 //    $user_email = 'VooDi121.ua@gmail.com';
 //    $user_phone = '+38 (093) 025-4432';
 //    // $user_first_name = $_POST['billing_first_name'];
 //    $user_phone_escaped = preg_replace('/[^0-9+]/', '', $user_phone);

 // $prev_orders = get_posts(array(
 //        'post_type' => 'shop_order',
 //        'posts_per_page' => -1,
 //        'post_status' => 'wc-processing,wc-completed',
 //        'exclude' => 861,
 //        'meta_query' => array(
 //          'relation' => 'OR',

 //            array(
 //                'key' => '_billing_email',
 //                'value' => $user_email,
 //                'compare' => '=',
 //            ),
 //            array(
 //                'key' => '_billing_phone',
 //                'value' => $user_phone,
 //                'compare' => '=',
 //            ),
             
 //        )
 //    ));
// var_dump(count($prev_orders));


 //    $whitelist = get_posts(array(
 //        'post_type' => 'whitelist',
 //        'meta_query' => array(
 //           'relation' => 'OR',
 //            array(
 //                'key' => '_email',
 //                'value' => $user_email,
 //                'compare' => '=',
 //            ),
 //             array(
 //                'key' => '_phone',
 //                'value' => $user_phone_escaped,
 //                'compare' => '=',
 //            ),
 //        )
 //    ));
// var_dump(count($whitelist));
    // if ($prev_orders && empty($whitelist)) {
        // $post_data = array(
        //     'post_title'    => $user_email,
        //     'post_status'   => 'publish',
        //     'post_type'     => 'whitelist',
        // );

        // $post_id = wp_insert_post( $post_data );

        // carbon_set_post_meta($post_id, 'email', $user_email);
        // carbon_set_post_meta($post_id, 'phone', $user_phone);
        // carbon_set_post_meta($post_id, 'first_name', $user_first_name);
        // var_dump(count($prev_orders));
        // var_dump(count($whitelist));
    // }

// echo get_option('my_option');