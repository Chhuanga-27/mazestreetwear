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

    // Enqueue Google Fonts: Space Grotesk, Inter (Ultra Bold display) & JetBrains Mono for brutalist streetwear aesthetic
    wp_enqueue_style(
        'mazestreetwear-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@800;900&family=JetBrains+Mono:wght@400;500;700&family=Space+Grotesk:wght@300;400;500;600;700&display=swap',
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

    // Generate updated badge HTML fragment: Black bag badge with white number counter
    ob_start();
    ?>
    <span class="maze-cart-count absolute -top-1.5 -right-2 inline-flex items-center justify-center min-w-[16px] h-[16px] px-1 text-[9px] font-mono font-bold tracking-tight text-white bg-black border border-white rounded-full transition-transform duration-200 <?php echo $count > 0 ? 'scale-100' : 'scale-90 opacity-80'; ?>">
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
// Remove default WooCommerce wrapper markup and replace with custom theme containers
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

// Minimalist theme rules: Strip ratings, sale badges, and add-to-bag buttons from shop loops
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

// Filter Add to Cart button text to "ADD TO BAG"
add_filter( 'woocommerce_product_single_add_to_cart_text', function() {
    return __( 'ADD TO BAG', 'mazestreetwear' );
} );

// Custom wrapper start
function mazestreetwear_wrapper_start() {
    echo '<main id="primary" class="site-main min-h-screen bg-white text-black antialiased selection:bg-black selection:text-white">';
}
add_action( 'woocommerce_before_main_content', 'mazestreetwear_wrapper_start', 10 );

// Custom wrapper end
function mazestreetwear_wrapper_end() {
    echo '</main>';
}
add_action( 'woocommerce_after_main_content', 'mazestreetwear_wrapper_end', 10 );

/**
 * Filter WooCommerce breadcrumb defaults for minimalist monochrome aesthetic
 */
function mazestreetwear_breadcrumbs_defaults( $defaults ) {
    $defaults['delimiter']   = '<span class="text-neutral-400 mx-2">/</span>';
    $defaults['wrap_before'] = '<nav class="woocommerce-breadcrumb text-xs font-mono uppercase tracking-widest text-neutral-600 mb-6 flex flex-wrap items-center" aria-label="Breadcrumb">';
    $defaults['wrap_after']  = '</nav>';
    $defaults['before']      = '<span class="text-black">';
    $defaults['after']       = '</span>';
    $defaults['home']        = _x( 'HOME', 'breadcrumb', 'mazestreetwear' );
    return $defaults;
}
add_filter( 'woocommerce_breadcrumb_defaults', 'mazestreetwear_breadcrumbs_defaults' );

/**
 * ============================================================================
 * LEGAL PAGES ROUTING, AUTO-PUBLISHING & SAFE URL HELPERS
 * Ensures Privacy Policy and Terms & Conditions load reliably without 404
 * or accidental redirection to the homepage.
 * ============================================================================
 */

/**
 * Safe Legal Link Helper: Privacy Policy
 */
function mazestreetwear_get_privacy_policy_url() {
    // 1. Check if a published page exists with slug 'privacy-policy'
    $page = get_page_by_path( 'privacy-policy', OBJECT, 'page' );
    if ( $page && 'publish' === $page->post_status ) {
        return get_permalink( $page->ID );
    }

    // 2. Check WordPress core privacy policy setting
    $privacy_id = (int) get_option( 'wp_page_for_privacy_policy' );
    if ( $privacy_id > 0 && 'publish' === get_post_status( $privacy_id ) ) {
        return get_permalink( $privacy_id );
    }

    // 3. Fallback to /privacy-policy/ permalink
    return home_url( '/privacy-policy/' );
}

/**
 * Safe Legal Link Helper: Terms & Conditions
 */
function mazestreetwear_get_terms_url() {
    $front_page_id = (int) get_option( 'page_on_front' );

    // 1. Check WooCommerce terms page setting (must be valid, published, and NOT front page)
    if ( function_exists( 'wc_terms_and_conditions_page_id' ) ) {
        $wc_terms_id = (int) wc_terms_and_conditions_page_id();
        if ( $wc_terms_id > 0 && $wc_terms_id !== $front_page_id && 'publish' === get_post_status( $wc_terms_id ) ) {
            return get_permalink( $wc_terms_id );
        }
    }

    // 2. Check if a published page exists with slug 'terms-and-conditions'
    $page = get_page_by_path( 'terms-and-conditions', OBJECT, 'page' );
    if ( $page && 'publish' === $page->post_status ) {
        return get_permalink( $page->ID );
    }

    // 3. Check if a published page exists with slug 'terms'
    $page_terms = get_page_by_path( 'terms', OBJECT, 'page' );
    if ( $page_terms && 'publish' === $page_terms->post_status ) {
        return get_permalink( $page_terms->ID );
    }

    // 4. Fallback to /terms-and-conditions/ permalink
    return home_url( '/terms-and-conditions/' );
}

/**
 * Register rewrite rules and query vars for legal pages.
 */
function mazestreetwear_legal_rewrite_rules() {
    add_rewrite_rule( '^privacy-policy/?$', 'index.php?mazepage=privacy-policy', 'top' );
    add_rewrite_rule( '^terms-and-conditions/?$', 'index.php?mazepage=terms-and-conditions', 'top' );
    add_rewrite_rule( '^terms/?$', 'index.php?mazepage=terms-and-conditions', 'top' );
}
add_action( 'init', 'mazestreetwear_legal_rewrite_rules', 10 );

function mazestreetwear_legal_query_vars( $vars ) {
    $vars[] = 'mazepage';
    return $vars;
}
add_filter( 'query_vars', 'mazestreetwear_legal_query_vars' );

/**
 * Prevent WordPress canonical redirect from bouncing /terms-and-conditions or /privacy-policy to homepage.
 */
function mazestreetwear_prevent_legal_canonical_redirect( $redirect_url, $requested_url ) {
    if ( preg_match( '#/(privacy-policy|terms-and-conditions|terms)/?$#i', $requested_url ) ) {
        return false;
    }
    return $redirect_url;
}
add_filter( 'redirect_canonical', 'mazestreetwear_prevent_legal_canonical_redirect', 10, 2 );

/**
 * Template routing fallback for legal pages.
 * Ensures the custom templates are ALWAYS loaded even before rewrite rules or database records are synced.
 */
function mazestreetwear_legal_template_include( $template ) {
    // 1. Check custom query var from rewrite rule
    $mazepage = get_query_var( 'mazepage' );
    if ( 'privacy-policy' === $mazepage ) {
        global $wp_query;
        if ( $wp_query ) {
            $wp_query->is_404  = false;
            $wp_query->is_page = true;
        }
        status_header( 200 );
        $custom = get_template_directory() . '/page-privacy-policy.php';
        if ( file_exists( $custom ) ) {
            return $custom;
        }
    }

    if ( 'terms-and-conditions' === $mazepage ) {
        global $wp_query;
        if ( $wp_query ) {
            $wp_query->is_404  = false;
            $wp_query->is_page = true;
        }
        status_header( 200 );
        $custom = get_template_directory() . '/page-terms-and-conditions.php';
        if ( file_exists( $custom ) ) {
            return $custom;
        }
    }

    // 2. Native WordPress template or page slug match
    if ( is_page_template( 'page-privacy-policy.php' ) || is_page( 'privacy-policy' ) ) {
        $custom = get_template_directory() . '/page-privacy-policy.php';
        if ( file_exists( $custom ) ) {
            return $custom;
        }
    }

    if ( is_page_template( 'page-terms-and-conditions.php' ) || is_page( array( 'terms-and-conditions', 'terms' ) ) ) {
        $custom = get_template_directory() . '/page-terms-and-conditions.php';
        if ( file_exists( $custom ) ) {
            return $custom;
        }
    }

    // 3. Direct URI inspection (handles missing rewrite rules, subdirectory setups, or 404 state)
    $request_uri = isset( $_SERVER['REQUEST_URI'] ) ? esc_url_raw( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '';
    $path = trim( parse_url( $request_uri, PHP_URL_PATH ), '/' );

    $site_path = trim( parse_url( home_url(), PHP_URL_PATH ), '/' );
    if ( ! empty( $site_path ) && 0 === strpos( $path, $site_path ) ) {
        $path = trim( substr( $path, strlen( $site_path ) ), '/' );
    }

    if ( $path === 'privacy-policy' || preg_match( '#(^|/)privacy-policy/?$#i', $path ) ) {
        global $wp_query;
        if ( $wp_query ) {
            $wp_query->is_404  = false;
            $wp_query->is_page = true;
        }
        status_header( 200 );
        $custom = get_template_directory() . '/page-privacy-policy.php';
        if ( file_exists( $custom ) ) {
            return $custom;
        }
    }

    if ( $path === 'terms-and-conditions' || $path === 'terms' || preg_match( '#(^|/)(terms-and-conditions|terms)/?$#i', $path ) ) {
        global $wp_query;
        if ( $wp_query ) {
            $wp_query->is_404  = false;
            $wp_query->is_page = true;
        }
        status_header( 200 );
        $custom = get_template_directory() . '/page-terms-and-conditions.php';
        if ( file_exists( $custom ) ) {
            return $custom;
        }
    }

    return $template;
}
add_filter( 'template_include', 'mazestreetwear_legal_template_include', 99 );

/**
 * Ensure document title is correct when legal pages are routed directly.
 */
function mazestreetwear_legal_document_title_parts( $title_parts ) {
    $request_uri = isset( $_SERVER['REQUEST_URI'] ) ? esc_url_raw( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '';
    $path = trim( parse_url( $request_uri, PHP_URL_PATH ), '/' );
    $site_path = trim( parse_url( home_url(), PHP_URL_PATH ), '/' );
    if ( ! empty( $site_path ) && 0 === strpos( $path, $site_path ) ) {
        $path = trim( substr( $path, strlen( $site_path ) ), '/' );
    }

    if ( $path === 'privacy-policy' || preg_match( '#(^|/)privacy-policy/?$#i', $path ) || get_query_var( 'mazepage' ) === 'privacy-policy' ) {
        $title_parts['title'] = __( 'Privacy Policy', 'mazestreetwear' );
    } elseif ( $path === 'terms-and-conditions' || $path === 'terms' || preg_match( '#(^|/)(terms-and-conditions|terms)/?$#i', $path ) || get_query_var( 'mazepage' ) === 'terms-and-conditions' ) {
        $title_parts['title'] = __( 'Terms & Conditions', 'mazestreetwear' );
    }

    return $title_parts;
}
add_filter( 'document_title_parts', 'mazestreetwear_legal_document_title_parts', 10 );

/**
 * Auto-publish and sync legal pages in WordPress database.
 * If pages do not exist, or are stuck in Draft/Trash status, publishes them
 * and links them to WordPress Privacy and WooCommerce Terms settings.
 */
function mazestreetwear_ensure_legal_pages_exist() {
    // Only run if user is admin or on initial page loads, keep performance high
    if ( ! is_admin() && get_transient( 'mazestreetwear_legal_pages_checked' ) ) {
        return;
    }

    $updated = false;

    // 1. Privacy Policy
    $privacy_page  = get_page_by_path( 'privacy-policy', OBJECT, 'page' );
    $wp_privacy_id = (int) get_option( 'wp_page_for_privacy_policy' );

    if ( ! $privacy_page ) {
        if ( $wp_privacy_id > 0 ) {
            $existing = get_post( $wp_privacy_id );
            if ( $existing ) {
                if ( 'publish' !== $existing->post_status ) {
                    wp_update_post( array(
                        'ID'          => $wp_privacy_id,
                        'post_status' => 'publish',
                        'post_name'   => 'privacy-policy',
                    ) );
                    $updated = true;
                }
                update_post_meta( $wp_privacy_id, '_wp_page_template', 'page-privacy-policy.php' );
            }
        } else {
            $new_privacy_id = wp_insert_post( array(
                'post_title'     => __( 'Privacy Policy', 'mazestreetwear' ),
                'post_name'      => 'privacy-policy',
                'post_status'    => 'publish',
                'post_type'      => 'page',
                'comment_status' => 'closed',
            ) );
            if ( ! is_wp_error( $new_privacy_id ) && $new_privacy_id > 0 ) {
                update_post_meta( $new_privacy_id, '_wp_page_template', 'page-privacy-policy.php' );
                update_option( 'wp_page_for_privacy_policy', $new_privacy_id );
                $updated = true;
            }
        }
    } else {
        if ( 'publish' !== $privacy_page->post_status ) {
            wp_update_post( array(
                'ID'          => $privacy_page->ID,
                'post_status' => 'publish',
            ) );
            $updated = true;
        }
        update_post_meta( $privacy_page->ID, '_wp_page_template', 'page-privacy-policy.php' );
        if ( $wp_privacy_id !== (int) $privacy_page->ID ) {
            update_option( 'wp_page_for_privacy_policy', $privacy_page->ID );
        }
    }

    // 2. Terms & Conditions
    $terms_page = get_page_by_path( 'terms-and-conditions', OBJECT, 'page' );
    if ( ! $terms_page ) {
        $terms_page = get_page_by_path( 'terms', OBJECT, 'page' );
    }

    $wc_terms_id   = function_exists( 'wc_terms_and_conditions_page_id' ) ? (int) wc_terms_and_conditions_page_id() : (int) get_option( 'woocommerce_terms_page_id' );
    $front_page_id = (int) get_option( 'page_on_front' );

    // If wc_terms_id points to front page, reset it so it doesn't bounce to home
    if ( $wc_terms_id > 0 && $wc_terms_id === $front_page_id ) {
        $wc_terms_id = 0;
        delete_option( 'woocommerce_terms_page_id' );
    }

    if ( ! $terms_page ) {
        if ( $wc_terms_id > 0 && $wc_terms_id !== $front_page_id ) {
            $existing_terms = get_post( $wc_terms_id );
            if ( $existing_terms ) {
                if ( 'publish' !== $existing_terms->post_status ) {
                    wp_update_post( array(
                        'ID'          => $wc_terms_id,
                        'post_status' => 'publish',
                    ) );
                    $updated = true;
                }
                update_post_meta( $wc_terms_id, '_wp_page_template', 'page-terms-and-conditions.php' );
            }
        } else {
            $new_terms_id = wp_insert_post( array(
                'post_title'     => __( 'Terms & Conditions', 'mazestreetwear' ),
                'post_name'      => 'terms-and-conditions',
                'post_status'    => 'publish',
                'post_type'      => 'page',
                'comment_status' => 'closed',
            ) );
            if ( ! is_wp_error( $new_terms_id ) && $new_terms_id > 0 ) {
                update_post_meta( $new_terms_id, '_wp_page_template', 'page-terms-and-conditions.php' );
                update_option( 'woocommerce_terms_page_id', $new_terms_id );
                $updated = true;
            }
        }
    } else {
        if ( 'publish' !== $terms_page->post_status ) {
            wp_update_post( array(
                'ID'          => $terms_page->ID,
                'post_status' => 'publish',
            ) );
            $updated = true;
        }
        update_post_meta( $terms_page->ID, '_wp_page_template', 'page-terms-and-conditions.php' );
        if ( $wc_terms_id !== (int) $terms_page->ID ) {
            update_option( 'woocommerce_terms_page_id', $terms_page->ID );
        }
    }

    if ( $updated ) {
        flush_rewrite_rules( false );
    }

    set_transient( 'mazestreetwear_legal_pages_checked', 1, DAY_IN_SECONDS );
}
add_action( 'init', 'mazestreetwear_ensure_legal_pages_exist', 5 );
add_action( 'after_switch_theme', 'mazestreetwear_ensure_legal_pages_exist' );

