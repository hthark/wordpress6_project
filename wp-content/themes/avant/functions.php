<?php
/**
 * Avant functions and definitions
 *
 * @package Avant
 */
define( 'AVANT_THEME_VERSION' , '1.1.51' );

// Include Avant Upgrade page
require get_template_directory() . '/upgrade/upgrade.php';

// Load WP included scripts
require get_template_directory() . '/includes/inc/template-tags.php';
require get_template_directory() . '/includes/inc/extras.php';
require get_template_directory() . '/includes/inc/jetpack.php';

// Load Customizer Library scripts
require get_template_directory() . '/customizer/customizer-options.php';
require get_template_directory() . '/customizer/customizer-library/customizer-library.php';
require get_template_directory() . '/customizer/styles.php';
require get_template_directory() . '/customizer/mods.php';

// Load TGM plugin class
require_once get_template_directory() . '/includes/inc/class-tgm-plugin-activation.php';
// Add customizer Upgrade class
require_once( get_template_directory() . '/includes/avant-pro/class-customize.php' );

if ( ! function_exists( 'avant_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function avant_setup() {

	/**
	 * Set the content width based on the theme's design and stylesheet.
	 */
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 900; /* pixels */
	}

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on avant, use a find and replace
	 * to change 'avant' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'avant', get_template_directory() . '/languages' );

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
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
        'top-bar-menu' => esc_html__( 'Top Bar Menu', 'avant' ),
		'primary' => esc_html__( 'Primary Menu', 'avant' ),
        'footer-bar' => esc_html__( 'Footer Bar Menu', 'avant' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	// Gutenberg Support
	add_theme_support( 'align-wide' );
	
	// The custom logo
	add_theme_support( 'custom-logo', array(
		'width'       => 280,
		'height'      => 145,
		'flex-height' => true,
		'flex-width'  => true,
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'avant_custom_background_args', array(
		'default-color' => 'F9F9F9',
	) ) );
	
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	add_theme_support( 'header-footer-elementor' );
}
endif; // avant_setup
add_action( 'after_setup_theme', 'avant_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function avant_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'avant' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar(array(
		'name' => __( 'Avant Footer Standard', 'avant' ),
		'id' => 'avant-site-footer-standard',
        'description' => __( 'The footer will divide into however many widgets are placed here.', 'avant' )
	));
}
add_action( 'widgets_init', 'avant_widgets_init' );

/*
 * Change Widgets Title Tags for SEO
 */
function kaira_change_widget_titles( array $params ) {
	$widget_title_tag = get_theme_mod( 'avant-seo-widget-title-tag', customizer_library_get_default( 'avant-seo-widget-title-tag' ) );
    $widget =& $params[0];
    $widget['before_title'] = '<h'.esc_attr( $widget_title_tag ).' class="widget-title">';
    $widget['after_title'] = '</h'.esc_attr( $widget_title_tag ).'>';
    return $params;
}
add_filter( 'dynamic_sidebar_params', 'kaira_change_widget_titles', 20 );

/**
 * Enqueue scripts and styles.
 */
function avant_scripts() {
	if ( !get_theme_mod( 'avant-disable-google-fonts', customizer_library_get_default( 'avant-disable-google-fonts' ) ) ) {
		if ( !get_theme_mod( 'avant-disable-default-fonts-only', customizer_library_get_default( 'avant-disable-default-fonts-only' ) ) ) {
			wp_enqueue_style( 'avant-title-font', '//fonts.googleapis.com/css?family=Parisienne', array(), AVANT_THEME_VERSION );
			wp_enqueue_style( 'avant-body-font-default', '//fonts.googleapis.com/css?family=Open+Sans', array(), AVANT_THEME_VERSION );
			wp_enqueue_style( 'avant-heading-font-default', '//fonts.googleapis.com/css?family=Poppins', array(), AVANT_THEME_VERSION );
		}
	}

	wp_enqueue_style( 'avant-font-awesome', get_template_directory_uri().'/includes/font-awesome/css/all.min.css', array(), '5.15.3' );
	wp_enqueue_style( 'avant-style', get_stylesheet_uri(), array(), AVANT_THEME_VERSION );

	if ( get_theme_mod( 'avant-header-layout' ) == 'avant-header-layout-seven' ) :
		wp_enqueue_style( 'avant-header-style', get_template_directory_uri()."/templates/header/css/header-seven.css", array(), AVANT_THEME_VERSION );
	elseif ( get_theme_mod( 'avant-header-layout' ) == 'avant-header-layout-six' ) :
		wp_enqueue_style( 'avant-header-style', get_template_directory_uri()."/templates/header/css/header-six.css", array(), AVANT_THEME_VERSION );
	elseif ( get_theme_mod( 'avant-header-layout' ) == 'avant-header-layout-five' ) :
		wp_enqueue_style( 'avant-header-style', get_template_directory_uri()."/templates/header/css/header-five.css", array(), AVANT_THEME_VERSION );
	elseif ( get_theme_mod( 'avant-header-layout' ) == 'avant-header-layout-four' ) :
		wp_enqueue_style( 'avant-header-style', get_template_directory_uri()."/templates/header/css/header-four.css", array(), AVANT_THEME_VERSION );
	elseif ( get_theme_mod( 'avant-header-layout' ) == 'avant-header-layout-three' ) :
		wp_enqueue_style( 'avant-header-style', get_template_directory_uri()."/templates/header/css/header-three.css", array(), AVANT_THEME_VERSION );
	elseif ( get_theme_mod( 'avant-header-layout' ) == 'avant-header-layout-two' ) :
		wp_enqueue_style( 'avant-header-style', get_template_directory_uri()."/templates/header/css/header-two.css", array(), AVANT_THEME_VERSION );
	else :
		wp_enqueue_style( 'avant-header-style', get_template_directory_uri()."/templates/header/css/header-one.css", array(), AVANT_THEME_VERSION );
	endif;
	
	if ( avant_is_woocommerce_activated() ) :
		wp_enqueue_style( 'avant-woocommerce-style', get_template_directory_uri()."/includes/css/woocommerce.css", array(), AVANT_THEME_VERSION );
	endif;

	if ( get_theme_mod( 'avant-footer-layout' ) == 'avant-footer-layout-custom' ) :
		wp_enqueue_style( 'avant-footer-style', get_template_directory_uri()."/templates/footer/css/footer-custom.css", array(), AVANT_THEME_VERSION );
	elseif ( get_theme_mod( 'avant-footer-layout' ) == 'avant-footer-layout-social' ) :
		wp_enqueue_style( 'avant-footer-style', get_template_directory_uri()."/templates/footer/css/footer-social.css", array(), AVANT_THEME_VERSION );
	elseif ( get_theme_mod( 'avant-footer-layout' ) == 'avant-footer-layout-none' ) :
		wp_enqueue_style( 'avant-footer-style', get_template_directory_uri()."/templates/footer/css/footer-none.css", array(), AVANT_THEME_VERSION );
	else :
		wp_enqueue_style( 'avant-footer-style', get_template_directory_uri()."/templates/footer/css/footer-standard.css", array(), AVANT_THEME_VERSION );
	endif;
	
	wp_enqueue_script( 'avant-custom-js', get_template_directory_uri() . "/js/custom.js", array('jquery'), AVANT_THEME_VERSION, true );
	
	wp_enqueue_script( 'caroufredsel-js', get_template_directory_uri() . "/js/caroufredsel/jquery.carouFredSel-6.2.1-packed.js", array('jquery'), AVANT_THEME_VERSION, true );
    wp_enqueue_script( 'avant-home-slider', get_template_directory_uri() . '/js/home-slider.js', array('jquery'), AVANT_THEME_VERSION, true );
	
	if ( get_theme_mod( 'avant-blog-layout', customizer_library_get_default( 'avant-blog-layout' ) ) == 'blog-blocks-layout' ) :
		wp_enqueue_script( 'jquery-masonry' );
        wp_enqueue_script( 'avant-masonry-custom', get_template_directory_uri() . '/js/layout-blocks.js', array('jquery'), AVANT_THEME_VERSION, true );
	endif;
	if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) :
		wp_enqueue_script( 'jquery-masonry' );
		wp_enqueue_script( 'avant-jetpack-scroll', get_template_directory_uri() . '/js/jetpack-infinite-scroll.js', array('jquery'), AVANT_THEME_VERSION, true );
	endif;

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'avant_scripts' );

/**
 * Fix skip link focus in IE11. Too small to load as own script
 */
function avant_custom_footer_scripts() {
	// The following is minified via 'terser --compress --mangle -- js/skip-link-focus-fix.js' ?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script><?php
}
add_action( 'wp_print_footer_scripts', 'avant_custom_footer_scripts' );

/**
 * To maintain backwards compatibility with older versions of WordPress
 */
function avant_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}

/**
 * Add theme stying to the theme content editor
 */
function avant_add_editor_styles() {
    add_editor_style( 'style-theme-editor.css' );
}
add_action( 'admin_init', 'avant_add_editor_styles' );

/**
 * Add pingback to header
 */
function avant_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'avant_pingback_header' );

/**
 * Enqueue admin styling.
 */
function avant_load_admin_script() {
	wp_enqueue_style( 'avant-admin-css', get_template_directory_uri() . '/upgrade/css/admin-css.css', array(), AVANT_THEME_VERSION );
}
add_action( 'admin_enqueue_scripts', 'avant_load_admin_script' );

/**
 * Enqueue avant custom customizer styling.
 */
function avant_load_customizer_script() {
	wp_enqueue_script( 'avant-customizer-js', get_template_directory_uri() . "/customizer/customizer-library/js/customizer-custom.js", array('jquery'), AVANT_THEME_VERSION, true );
    wp_enqueue_style( 'avant-customizer-css', get_template_directory_uri() . "/customizer/customizer-library/css/customizer.css", array(), AVANT_THEME_VERSION );
}
add_action( 'customize_controls_enqueue_scripts', 'avant_load_customizer_script' );

/**
 * Check if WooCommerce exists.
 */
if ( ! function_exists( 'avant_is_woocommerce_activated' ) ) :
	function avant_is_woocommerce_activated() {
	    if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
	}
endif; // avant_is_woocommerce_activated

// If WooCommerce exists include ajax cart
if ( avant_is_woocommerce_activated() ) {
	require get_template_directory() . '/includes/inc/woocommerce-header-inc.php';
}

/**
 * Add classed to the body tag from settings
 */
function avant_add_body_class( $classes ) {
	if ( get_theme_mod( 'avant-page-remove-titlebar' ) ) {
		$classes[] = 'avant-shop-remove-titlebar';
	}
	if ( get_theme_mod( 'avant-remove-wc-page-titles' ) ) {
		$classes[] = 'avant-onlyshop-remove-titlebar';
	}
	
	if ( get_theme_mod( 'avant-remove-blog-title' ) ) {
		$classes[] = 'avant-blog-remove-titlebar';
	}

	return $classes;
}
add_filter( 'body_class', 'avant_add_body_class' );

/**
 * Add classes to the blog list for styling.
 */
function avant_add_blog_post_classes ( $classes ) {
	global $current_class;

	if ( is_home() || is_archive() || is_search() ) :
		$avant_blog_layout = sanitize_html_class( customizer_library_get_default( 'avant-blog-layout' ) );
		if ( get_theme_mod( 'avant-blog-layout' ) ) :
		    $avant_blog_layout = sanitize_html_class( get_theme_mod( 'avant-blog-layout' ) );
		endif;
		$classes[] = $avant_blog_layout;

		$avant_blog_style = sanitize_html_class( 'blog-style-postblock' );
		if ( get_theme_mod( 'avant-blog-layout' ) == 'blog-blocks-layout' ) :
			if ( get_theme_mod( 'avant-blog-blocks-style' ) ) :
			    $avant_blog_style = sanitize_html_class( get_theme_mod( 'avant-blog-blocks-style' ) );
			endif;
		endif;
		$classes[] = $avant_blog_style;

		$avant_blog_img = sanitize_html_class( 'blog-post-noimg' );
		if ( has_post_thumbnail() ) :
		    $avant_blog_img = sanitize_html_class( 'blog-post-hasimg' );
		endif;
		$classes[] = $avant_blog_img;

		$classes[] = $current_class;
		$current_class = ( $current_class == 'blog-alt-odd' ) ? sanitize_html_class( 'blog-alt-even' ) : sanitize_html_class( 'blog-alt-odd' );
	endif;

	return $classes;
}
global $current_class;
$current_class = 'blog-alt-odd';
add_filter ( 'post_class' , 'avant_add_blog_post_classes' );

/**
 * Adjust is_home query if avant-blog-cats is set
 */
function avant_set_blog_queries( $query ) {
    $blog_query_set = '';
    if ( get_theme_mod( 'avant-blog-cats' ) ) {
        $blog_query_set = get_theme_mod( 'avant-blog-cats' );
    }

    if ( $blog_query_set ) {
        // do not alter the query on wp-admin pages and only alter it if it's the main query
        if ( !is_admin() && $query->is_main_query() ){
            if ( is_home() ){
                $query->set( 'cat', $blog_query_set );
            }
        }
    }
}
add_action( 'pre_get_posts', 'avant_set_blog_queries' );

/**
 * Display recommended plugins with the TGM class
 */
function avant_register_required_plugins() {
	$plugins = array(
		// The recommended WordPress.org plugins.
		array(
			'name'      => __( 'WooCommerce', 'avant' ),
			'slug'      => 'woocommerce',
			'required'  => false,
		),
		array(
			'name'      => __( 'Elementor Page Builder', 'avant' ),
			'slug'      => 'elementor',
			'required'  => false,
		),
		array(
			'name'      => __( 'Contact Form by WPForms', 'avant' ),
			'slug'      => 'wpforms-lite',
			'required'  => false,
		),
		array(
			'name'      => __( 'StoreCustomizer', 'avant' ),
			'slug'      => 'woocustomizer',
			'required'  => false,
		),
		array(
			'name'      => __( 'Breadcrumb NavXT', 'avant' ),
			'slug'      => 'breadcrumb-navxt',
			'required'  => false,
		),
		array(
			'name'      => __( 'Google Analytics for WordPress by MonsterInsights', 'avant' ),
			'slug'      => 'google-analytics-for-wordpress',
			'required'  => false,
        )
	);
	$config = array(
		'id'           => 'avant',
		'menu'         => 'tgmpa-install-plugins',
		'strings'     => array(
			'notice_can_install_recommended'  => _n_noop(
				/* translators: 1: plugin name(s). */
				'Avant recommends the following plugin: %1$s.',
				'Avant recommends the following plugins: %1$s.',
				'avant'
			),
			'notice_ask_to_update'            => _n_noop(
				/* translators: 1: plugin name(s). */
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with Avant: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with Avant: %1$s.',
				'avant'
			),
		),
	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'avant_register_required_plugins' );

/**
 * Add classes to the admin body class
 */
function avant_add_admin_body_class( $avant_admin_class ) {
	if ( get_theme_mod( 'avant-footer-layout' ) ) {
		$avant_admin_class .= ' ' . sanitize_html_class( get_theme_mod( 'avant-footer-layout' ) );
	} else {
		$avant_admin_class .= ' ' . sanitize_html_class( 'avant-footer-layout-standard' );
	}
	return $avant_admin_class;
}
add_filter( 'admin_body_class', 'avant_add_admin_body_class' );

/**
 * Function to remove Category pre-title text
 */
function avant_cat_title_remove_pretext( $avant_cat_title ) {
	if ( is_category() ) {
        $avant_cat_title = single_cat_title( '', false );
    } elseif ( is_post_type_archive() ) {
		$avant_cat_title = post_type_archive_title( '', false );
    } elseif ( is_tag() ) {
        $avant_cat_title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $avant_cat_title = '<span class="vcard">' . get_the_author() . '</span>' ;
    }
    return $avant_cat_title;
}
if ( get_theme_mod( 'avant-remove-cat-pre-title' ) ) :
	add_filter( 'get_the_archive_title', 'avant_cat_title_remove_pretext' );
endif;

/**
 * Register a custom Post Categories ID column
 */
function avant_edit_cat_columns( $avant_cat_columns ) {
    $avant_cat_in = array( 'cat_id' => 'Category ID <span class="cat_id_note">For the Default Slider</span>' );
    $avant_cat_columns = avant_cat_columns_array_push_after( $avant_cat_columns, $avant_cat_in, 0 );
    return $avant_cat_columns;
}
add_filter( 'manage_edit-category_columns', 'avant_edit_cat_columns' );

/**
 * Print the ID column
 */
function avant_cat_custom_columns( $value, $name, $cat_id ) {
    if( 'cat_id' == $name )
        echo $cat_id;
}
add_filter( 'manage_category_custom_column', 'avant_cat_custom_columns', 10, 3 );

/**
 * Insert an element at the beggining of the array
 */
function avant_cat_columns_array_push_after( $src, $avant_cat_in, $pos ) {
    if ( is_int( $pos ) ) {
        $R = array_merge( array_slice( $src, 0, $pos + 1 ), $avant_cat_in, array_slice( $src, $pos + 1 ) );
    } else {
        foreach ( $src as $k => $v ) {
            $R[$k] = $v;
            if ( $k == $pos )
                $R = array_merge( $R, $avant_cat_in );
        }
    }
    return $R;
}

if ( ! function_exists( 'avant_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable / Excludes slider posts IF set.
 */
function avant_post_nav() {
    // Don't print empty markup if there's nowhere to navigate.
    $previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
    $next     = get_adjacent_post( false, '', false );

    if ( ! $next && ! $previous ) {
        return;
    } ?>
    <nav class="navigation post-navigation" role="navigation">
        <span class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'avant' ); ?></span>
        <div class="nav-links">
            <?php
            $slider_categories 	= get_theme_mod( 'avant-blog-cats' );
            $slider_type 		= get_theme_mod( 'avant-slider-type', customizer_library_get_default( 'avant-slider-type' ) );
            $exclude_categories = '';

            if ( $slider_type == 'avant-slider-default' && $slider_categories ) {
                $exclude_categories = ( '-' == $slider_categories[0] ) ? substr( get_theme_mod( 'avant-blog-cats' ), 1 ) : get_theme_mod( 'avant-blog-cats' );;
            }

            previous_post_link( '<div class="nav-previous">%link</div>', _x( '%title', 'Previous post link', 'avant' ), false, $exclude_categories );
            next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title', 'Next post link',     'avant' ), false, $exclude_categories );
            ?>
        </div><!-- .nav-links -->
    </nav><!-- .navigation -->
    <?php
}
endif;

/**
 * Adjust the Recent Posts widget query if avant-blog-cats is set
 */
function avant_filter_recent_posts_widget_parameters( $params ) {
	$slider_categories = get_theme_mod( 'avant-blog-cats' );
    $slider_type 	   = get_theme_mod( 'avant-slider-type', customizer_library_get_default( 'avant-slider-type' ) );
	
	if ( $slider_categories && $slider_type == 'avant-slider-default' ) {
		if ( !empty( $slider_categories ) ) { // if ( count( $slider_categories ) > 0 ) {
			// do not alter the query on wp-admin pages and only alter it if it's the main query
			$params['category__not_in'] = $slider_categories;
		}
	}
	
	return $params;
}
add_filter( 'widget_posts_args', 'avant_filter_recent_posts_widget_parameters' );

/**
 * Adjust the widget categories query if avant-blog-cats is set
 */
function avant_set_widget_categories_args($args){
	$slider_categories = get_theme_mod( 'avant-blog-cats' );
    $slider_type 	   = get_theme_mod( 'avant-slider-type', customizer_library_get_default( 'avant-slider-type' ) );
	
	if ( $slider_categories && $slider_type == 'avant-slider-default' ) {
		//if ( count($slider_categories) > 0) {
			//$exclude = implode(',', $slider_categories);
			$args['exclude'] = $slider_categories;
		//}
	}
	
	return $args;
}
add_filter( 'widget_categories_args', 'avant_set_widget_categories_args' );

function avant_set_widget_categories_dropdown_arg($args){
	$slider_categories = get_theme_mod( 'avant-blog-cats' );
    $slider_type 	   = get_theme_mod( 'avant-slider-type', customizer_library_get_default( 'avant-slider-type' ) );
	
	if ( $slider_categories && $slider_type == 'avant-slider-default' ) {
		// if ( count($slider_categories) > 0) {
			// $exclude = implode(',', $slider_categories);
			$args['exclude'] = $slider_categories;
		// }
	}
	
	return $args;
}
add_filter( 'widget_categories_dropdown_args', 'avant_set_widget_categories_dropdown_arg' );

/**
 * Admin notice to enter a purchase license
 */
function avant_add_license_notice() {
	global $pagenow;
	global $current_user;
	$avant_user_id = $current_user->ID;
	$avantpage = isset( $_GET['page'] ) ? $pagenow . '?page=' . $_GET['page'] : $pagenow;

	if ( !get_user_meta( $avant_user_id, 'avant_admin_notice_ignore' ) ) : ?>
		<div class="notice notice-info avant-admin-notice avant-notice-add">
			<h4>
				<?php esc_html_e( 'Thank you for using Avant!', 'avant' ); ?>
			</h4>
            <p><?php printf( __( 'We pride ourselves on <a href="%1$s" target="_blank">good products and 5 Star Support</a>! Please read through our <a href="%2$s" class="avant-admin-notice-topbtn">About Avant</a> page for more help on using the Avant theme, or for theme support - <a href="%2$s" class="avant-admin-notice-topbtn">Get In Contact</a>', 'avant' ), 'https://wordpress.org/support/theme/avant/reviews/?filter=5', admin_url( 'themes.php?page=avant_theme_info' ) ); ?></p>
            <p>
                <?php
                /* translators: 1: 'Read More here'. */
                printf( esc_html__( '%1$s on the Shortcode slider included FREE with Avant Premium!', 'avant' ), wp_kses( '<a href="' . admin_url( 'themes.php?page=avant_theme_info' ) . '">' . __( 'Read More here', 'avant' ) . '</a>', array( 'a' => array( 'href' => array() ) ) ) ); ?>
            </p>
			<?php if ( $avantpage == 'themes.php?page=avant_theme_info' ) : ?>
				<div class="avant-admin-notice-blocks">
					<div class="avant-admin-notice-block">
						<h5><?php esc_html_e( 'Popular links to get you started', 'avant' ); ?></h5>
						<ul>
							<li><a href="<?php echo esc_url( 'https://kairaweb.com/wordpress-theme/avant/#premium-features' ); ?>"><?php esc_html_e( 'See what the Avant Premium theme offers', 'avant' ); ?></a></li>
							<li><a href="<?php echo esc_url( 'https://kairaweb.com/documentation/setting-up-the-default-slider/' ); ?>"><?php esc_html_e( 'Setting up the Avant default slider', 'avant' ); ?></a></li>
							<li><a href="<?php echo esc_url( 'https://kairaweb.com/documentation/install-the-premium-theme/' ); ?>"><?php esc_html_e( 'How to install Avant Premium', 'avant' ); ?></a></li>
							<li><a href="<?php echo esc_url( 'https://kairaweb.com/documentation/adding-custom-css-to-wordpress/' ); ?>"><?php esc_html_e( 'Adding Custom CSS to WordPress', 'avant' ); ?></a></li>
						</ul>
						<a href="<?php echo esc_url( 'https://kairaweb.com/documentation/' ) ?>" class="avant-admin-notice-btn-grey">
							<?php esc_html_e( 'Go To Documentation', 'avant' ); ?>
						</a>
					</div>
					<div class="avant-admin-notice-block">
						<h5><?php esc_html_e( 'Start customizing your site:', 'avant' ); ?></h5>
						<p>
							<?php esc_html_e( 'All Avant Settings are built into the WordPress Customizer for easy, visual site editing.', 'avant' ); ?>
						</p>
						<a href="<?php echo esc_url( admin_url( 'customize.php' ) ) ?>" class="avant-admin-notice-btn">
							<?php esc_html_e( 'Start Customizing Avant', 'avant' ); ?>
						</a>
					</div>
					<div class="avant-admin-notice-block avant-nomargin">
						<h5><?php esc_html_e( 'Need Help with Avant?', 'avant' ); ?></h5>
						<p>
							<?php esc_html_e( 'Need help upgrading? Have a question about using the Avant theme? We\'re here to help... Contact us.', 'avant' ); ?>
						</p>
						<a href="<?php echo esc_url( 'https://kairaweb.com/contact/' ) ?>" class="avant-admin-notice-btn-in" target="_blank">
							<?php esc_html_e( 'Get in contact', 'avant' ); ?>
						</a>
					</div>
				</div>
				<h5>
					<?php
					/* translators: %s: 'Recommended Resources' */
					printf( esc_html__( 'Avant Premium is %1$s for all the extra %2$s plus FREE shortcode slider plugin included', 'avant' ), wp_kses( __( '<a href="https://kairaweb.com/wordpress-theme/avant/#purchase-premium" target="_blank">currently selling for only $25</a>', 'avant' ), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ), wp_kses( __( '<a href="https://kairaweb.com/wordpress-theme/avant/#premium-features" target="_blank">Avant Premium features</a>', 'avant' ), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ) );
					?>
				</h5>
			<?php endif; ?>
			<a href="?avant_add_license_notice_ignore=" class="avant-notice-close"><?php esc_html_e( 'Dismiss Notice', 'avant' ); ?></a>
		</div><?php
	endif;
}
add_action( 'admin_notices', 'avant_add_license_notice' );
/**
 * Admin notice save dismiss to wp transient
 */
function avant_add_license_notice_ignore() {
    global $current_user;
	$avant_user_id = $current_user->ID;

    if ( isset( $_GET['avant_add_license_notice_ignore'] ) ) {
		update_user_meta( $avant_user_id, 'avant_admin_notice_ignore', true );
    }
}
add_action( 'admin_init', 'avant_add_license_notice_ignore' );

/**
 * Dismissable Admin notice with Avant setup/general help
 */
function avant_add_sale_notice() {
	global $pagenow;
	global $current_user;
	$avant_user_id = $current_user->ID;

	if ( !get_user_meta( $avant_user_id, 'avant_sale_notice_ignore' ) ) : ?>
		<div class="notice avant-admin-notice notice-info">
			<h3 style="margin-top: 0;">
				<?php esc_html_e( 'Avant Pro on special !', 'avant' ); ?>
			</h3>
			<p>
                <?php
                /* translators: 1: 'Avant Pro for only $20'. */
                printf( esc_html__( 'Get %1$s... Use the limited coupon code "SALE21" now.', 'avant' ), wp_kses( '<a href="' . esc_url( 'https://kairaweb.com/wordpress-theme/avant/#purchase-premium' ) . '" target="_blank">' . __( 'Avant Pro for only $20', 'avant' ) . '</a>', array( 'a' => array( 'href' => array(), 'target' => array() ) ) ) ); ?>
			</p>
			<a href="?avant_add_sale_notice_ignore=" class="avant-notice-close"><?php esc_html_e( 'Dismiss Notice', 'avant' ); ?></a>
		</div><?php
	endif;
}
add_action( 'admin_notices', 'avant_add_sale_notice' );
/**
 * Admin notice save dismiss to wp transient
 */
function avant_add_sale_notice_ignore() {
    global $current_user;
	$avant_user_id = $current_user->ID;

    if ( isset( $_GET['avant_add_sale_notice_ignore'] ) ) {
		update_user_meta( $avant_user_id, 'avant_sale_notice_ignore', true );
    }
}
add_action( 'admin_init', 'avant_add_sale_notice_ignore' );
