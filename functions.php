<?php
/**
 * Maze Streetwear Theme Functions
 *
 * @package MazeStreetwear
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Setup theme defaults and register support for various WordPress & WooCommerce features.
 */
function mazestreetwear_setup() {
    // Add default title tag support managed by WordPress
    add_theme_support( 'title-tag' );

    // Enable support for Post Thumbnails on posts, pages, and products
    add_theme_support( 'post-thumbnails' );

    // Custom logo support
    add_theme_support( 'custom-logo', array(
        'height'      => 60,
        'width'       => 240,
        'flex-height' => true,
        'flex-width'  => true,
    ) );

    // HTML5 markup support
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );

    // Full WooCommerce Support
    add_theme_support( 'woocommerce', array(
        'thumbnail_image_width' => 600,
        'single_image_width'    => 1000,
        'product_grid'          => array(
            'default_rows'    => 4,
            'min_rows'        => 2,
            'max_rows'        => 10,
            'default_columns' => 4,
            'min_columns'     => 2,
            'max_columns'     => 6,
        ),
    ) );

    // Register full WooCommerce product gallery features
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );

    // Register Navigation Menus
    register_nav_menus( array(
        'primary' => __( 'Primary Navigation', 'mazestreetwear' ),
        'footer'  => __( 'Footer Navigation', 'mazestreetwear' ),
    ) );
}
add_action( 'after_setup_theme', 'mazestreetwear_setup' );

/**
 * Enqueue scripts and styles.
 */
function mazestreetwear_scripts() {
    $theme_version = wp_get_theme()->get( 'Version' );

    // Enqueue Google Fonts: Space Grotesk & JetBrains Mono for brutalist streetwear aesthetic
    wp_enqueue_style(
        'mazestreetwear-fonts',
        'https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;700&family=Space+Grotesk:wght@300;400;500;600;700&display=swap',
        array(),
        null
    );

    // Compiled Tailwind CSS Bundle
    $bundle_css_path = get_template_directory() . '/assets/css/bundle.css';
    $bundle_version  = file_exists( $bundle_css_path ) ? filemtime( $bundle_css_path ) : $theme_version;

    wp_enqueue_style(
        'mazestreetwear-tailwind',
        get_template_directory_uri() . '/assets/css/bundle.css',
        array(),
        $bundle_version
    );

    // Core theme style.css for metadata/fallbacks
    wp_enqueue_style(
        'mazestreetwear-style',
        get_stylesheet_uri(),
        array( 'mazestreetwear-tailwind' ),
        $theme_version
    );

    // Theme JavaScript (Streetwear interactions, mobile menu, dynamic size pill variation sync)
    $main_js_path = get_template_directory() . '/assets/js/main.js';
    $js_version   = file_exists( $main_js_path ) ? filemtime( $main_js_path ) : $theme_version;

    wp_enqueue_script(
        'mazestreetwear-main',
        get_template_directory_uri() . '/assets/js/main.js',
        array( 'jquery' ),
        $js_version,
        true
    );

    // Pass data to JS (e.g. AJAX URLs, cart status)
    wp_localize_script( 'mazestreetwear-main', 'mazeData', array(
        'ajaxUrl'   => admin_url( 'admin-ajax.php' ),
        'cartUrl'   => function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : '',
        'shopUrl'   => function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : '',
    ) );
}
add_action( 'wp_enqueue_scripts', 'mazestreetwear_scripts' );

/**
 * Dynamic WooCommerce AJAX Cart Count Fragment
 * Updates the shopping bag count badge dynamically on AJAX add-to-cart events without page reloads.
 */
function mazestreetwear_cart_count_fragments( $fragments ) {
    if ( ! function_exists( 'WC' ) || ! WC()->cart ) {
        return $fragments;
    }

    $count = WC()->cart->get_cart_contents_count();

    // Generate updated badge HTML fragment
    ob_start();
    ?>
    <span class="maze-cart-count absolute -top-1.5 -right-2 inline-flex items-center justify-center min-w-[18px] h-[18px] px-1 text-[10px] font-mono font-bold tracking-tight text-black bg-[#ccff00] rounded-full transition-transform duration-200 <?php echo $count > 0 ? 'scale-100' : 'scale-90 opacity-75'; ?>">
        <?php echo esc_html( $count ); ?>
    </span>
    <?php
    $fragments['span.maze-cart-count'] = ob_get_clean();

    return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'mazestreetwear_cart_count_fragments' );

/**
 * Custom WooCommerce hooks & layout customizations
 */
// Remove default WooCommerce wrapper markup and replace with custom theme containers if needed
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

// Custom wrapper start
function mazestreetwear_wrapper_start() {
    echo '<main id="primary" class="site-main min-h-screen bg-[#09090b] text-[#f4f4f5] antialiased selection:bg-[#ccff00] selection:text-black">';
}
add_action( 'woocommerce_before_main_content', 'mazestreetwear_wrapper_start', 10 );

// Custom wrapper end
function mazestreetwear_wrapper_end() {
    echo '</main>';
}
add_action( 'woocommerce_after_main_content', 'mazestreetwear_wrapper_end', 10 );

/**
 * Filter WooCommerce breadcrumb defaults for minimalist dark aesthetic
 */
function mazestreetwear_breadcrumbs_defaults( $defaults ) {
    $defaults['delimiter']   = '<span class="text-[#52525b] mx-2">/</span>';
    $defaults['wrap_before'] = '<nav class="woocommerce-breadcrumb text-xs font-mono uppercase tracking-widest text-[#a1a1aa] mb-6 flex flex-wrap items-center" aria-label="Breadcrumb">';
    $defaults['wrap_after']  = '</nav>';
    $defaults['before']      = '<span class="text-[#f4f4f5]">';
    $defaults['after']       = '</span>';
    $defaults['home']        = _x( 'HOME', 'breadcrumb', 'mazestreetwear' );
    return $defaults;
}
add_filter( 'woocommerce_breadcrumb_defaults', 'mazestreetwear_breadcrumbs_defaults' );

/**
 * Custom Sale Flash Badge
 */
function mazestreetwear_sale_flash( $html, $post, $product ) {
    return '<span class="maze-sale-badge absolute top-3 left-3 z-10 px-2 py-0.5 text-[10px] font-mono font-bold tracking-widest uppercase bg-[#ccff00] text-black border border-black shadow-sm">' . esc_html__( 'SALE', 'mazestreetwear' ) . '</span>';
}
add_filter( 'woocommerce_sale_flash', 'mazestreetwear_sale_flash', 10, 3 );
