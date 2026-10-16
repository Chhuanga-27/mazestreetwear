<?php

/**
 * Maze Streetwear Theme Functions
 *
 * @package MazeStreetwear
 * @version 1.0.0
 */

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Setup theme defaults and register support for various WordPress & WooCommerce features.
 */
function mazestreetwear_setup()
{
    // Add default title tag support managed by WordPress
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails on posts, pages, and products
    add_theme_support('post-thumbnails');

    // Custom logo support
    add_theme_support('custom-logo', array(
        'height'      => 60,
        'width'       => 240,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // HTML5 markup support
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // Full WooCommerce Support
    add_theme_support('woocommerce', array(
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
    ));

    // Register full WooCommerce product gallery features
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');

    // Register Navigation Menus
    register_nav_menus(array(
        'primary' => __('Primary Navigation', 'mazestreetwear'),
        'footer'  => __('Footer Navigation', 'mazestreetwear'),
    ));
}
add_action('after_setup_theme', 'mazestreetwear_setup');

/**
 * Enqueue scripts and styles.
 */
function mazestreetwear_scripts()
{
    $theme_version = wp_get_theme()->get('Version');

    // Compiled Tailwind CSS Bundle (includes Didot typography and font-face definitions)
    $bundle_css_path = get_template_directory() . '/assets/css/bundle.css';
    $bundle_version  = file_exists($bundle_css_path) ? filemtime($bundle_css_path) : $theme_version;

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
        array('mazestreetwear-tailwind'),
        $theme_version
    );

    // Theme JavaScript (Streetwear interactions, mobile menu, dynamic size pill variation sync)
    $main_js_path = get_template_directory() . '/assets/js/main.js';
    $js_version   = file_exists($main_js_path) ? filemtime($main_js_path) : $theme_version;

    // Enqueue WooCommerce cart fragments script if WooCommerce is active
    $deps = array('jquery');
    if (function_exists('is_woocommerce') || function_exists('WC')) {
        wp_enqueue_script('wc-cart-fragments');
        $deps[] = 'wc-cart-fragments';
    }

    wp_enqueue_script(
        'mazestreetwear-main',
        get_template_directory_uri() . '/assets/js/main.js',
        $deps,
        $js_version,
        true
    );

    // Pass data to JS
    wp_localize_script('mazestreetwear-main', 'mazeData', array(
        'ajaxUrl'   => admin_url('admin-ajax.php'),
        'wcAjaxUrl' => class_exists('WC_AJAX') ? WC_AJAX::get_endpoint('%%endpoint%%') : home_url('/?wc-ajax=%%endpoint%%'),
        'nonce'     => wp_create_nonce('maze_cart_nonce'),
        'cartUrl'   => function_exists('wc_get_cart_url') ? wc_get_cart_url() : home_url('/cart/'),
        'shopUrl'   => function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/shop/'),
    ));
}
add_action('wp_enqueue_scripts', 'mazestreetwear_scripts');

/**
 * Ensure WooCommerce cart fragments script remains active on Cart page for live header badge updates
 */
add_action('wp_enqueue_scripts', function () {
    if (function_exists('WC')) {
        wp_enqueue_script('wc-cart-fragments');
    }
}, 25);

/**
 * ============================================================================
 * WOOCOMMERCE CART CORE (CLEAN RESET)
 * Standard WooCommerce cart item count, dynamic fragments, and size data
 * ============================================================================
 */

/**
 * Return live total items count in WooCommerce cart
 *
 * @return int
 */
function mazestreetwear_get_cart_count()
{
    if (function_exists('WC') && WC()->cart) {
        return WC()->cart->get_cart_contents_count();
    }
    return 0;
}

/**
 * Update the shopping bag count badge dynamically via standard WooCommerce fragments
 *
 * @param array $fragments Existing fragments.
 * @return array
 */
function mazestreetwear_cart_count_fragments($fragments)
{
    $count = mazestreetwear_get_cart_count();
    $is_empty = ($count <= 0);

    ob_start();
?>
    <span class="maze-cart-count absolute -top-1.5 -right-2.5 inline-flex items-center justify-center min-w-[18px] h-[18px] px-1 text-[10px] font-mono font-bold tracking-tight text-white bg-black border border-white rounded-full transition-all duration-200 <?php echo $is_empty ? 'hidden' : 'scale-100'; ?>" data-count="<?php echo esc_attr($count); ?>" <?php echo $is_empty ? 'style="display:none;"' : ''; ?>>
        <?php echo esc_html($count); ?>
    </span>
<?php
    $fragments['span.maze-cart-count'] = ob_get_clean();

    return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments', 'mazestreetwear_cart_count_fragments');

/**
 * Ensure guest customer session is always initiated to prevent lost cart items & cookie desync
 */
add_action('init', function () {
    if (function_exists('WC') && ! is_admin()) {
        if (WC()->session && ! WC()->session->has_session()) {
            WC()->session->set_customer_session_cookie(true);
        }
    }
}, 5);

/**
 * Preserve custom selected_size in cart item data for simple products
 */
add_filter('woocommerce_add_cart_item_data', function ($cart_item_data, $product_id) {
    if (! empty($_POST['selected_size'])) {
        $cart_item_data['selected_size'] = sanitize_text_field(wp_unslash($_POST['selected_size']));
        $cart_item_data['unique_key']    = md5(microtime() . wp_rand());
    }
    return $cart_item_data;
}, 10, 2);

/**
 * Display custom selected_size in cart and checkout
 */
add_filter('woocommerce_get_item_data', function ($item_data, $cart_item) {
    if (! empty($cart_item['selected_size'])) {
        $item_data[] = array(
            'key'     => __('Size', 'mazestreetwear'),
            'value'   => sanitize_text_field($cart_item['selected_size']),
            'display' => '',
        );
    }
    return $item_data;
}, 10, 2);

/**
 * Save custom selected_size to order line item
 */
add_action('woocommerce_checkout_create_order_line_item', function ($item, $cart_item_key, $values, $order) {
    if (! empty($values['selected_size']) && is_object($item) && method_exists($item, 'add_meta_data')) {
        $item->add_meta_data(__('Size', 'mazestreetwear'), $values['selected_size'], true);
    }
}, 10, 4);

/**
 * Prevent caching on WooCommerce Cart and Checkout pages
 */
add_action('template_redirect', function () {
    if (! is_admin() && function_exists('is_cart') && function_exists('is_checkout')) {
        if (is_cart() || is_checkout() || (function_exists('is_wc_endpoint_url') && is_wc_endpoint_url())) {
            if (! defined('DONOTCACHEPAGE')) {
                define('DONOTCACHEPAGE', true);
            }
            if (! defined('DONOTCACHEOBJECT')) {
                define('DONOTCACHEOBJECT', true);
            }
            if (! defined('DONOTCACHEDB')) {
                define('DONOTCACHEDB', true);
            }
            nocache_headers();
            if (! headers_sent()) {
                header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0, private');
                header('Pragma: no-cache');
                header('Expires: Wed, 11 Jan 1984 05:00:00 GMT');
            }
        }
    }
}, 1);

/**
 * Allow clearing the cart via URL query parameter ?empty-cart=1 for instant debugging/testing
 */
add_action('init', function () {
    if (isset($_GET['empty-cart']) && function_exists('WC') && WC()->cart) {
        WC()->cart->empty_cart();
        $redirect = remove_query_arg('empty-cart');
        wp_safe_redirect($redirect);
        exit;
    }
}, 20);


/**
 * Custom WooCommerce hooks & layout customizations
 */
// Remove default WooCommerce wrapper markup and replace with custom theme containers
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

// Minimalist theme rules: Strip ratings, sale badges, and add-to-bag buttons from shop loops
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);

// Filter Add to Cart button text to "ADD TO BAG"
add_filter('woocommerce_product_single_add_to_cart_text', function () {
    return __('ADD TO BAG', 'mazestreetwear');
});

// Custom wrapper start
function mazestreetwear_wrapper_start()
{
    echo '<main id="primary" class="site-main min-h-screen bg-white text-black antialiased selection:bg-black selection:text-white">';
}
add_action('woocommerce_before_main_content', 'mazestreetwear_wrapper_start', 10);

// Custom wrapper end
function mazestreetwear_wrapper_end()
{
    echo '</main>';
}
add_action('woocommerce_after_main_content', 'mazestreetwear_wrapper_end', 10);

/**
 * Wishlist Feature Suppression (Cart Only Focus)
 * Completely unhooks and suppresses wishlist plugin outputs, shortcodes, and buttons,
 * ensuring users only interact with the Cart / Bag.
 */
function mazestreetwear_disable_wishlist_features()
{
    // 1. YITH WooCommerce Wishlist unhooking & filters
    add_filter('yith_wcwl_show_add_to_wishlist', '__return_false', 99);
    add_filter('yith_wcwl_positions', '__return_empty_array', 99);
    add_filter('yith_wcwl_is_wishlist_page', '__return_false', 99);

    // 2. TI WooCommerce Wishlist unhooking & filters
    add_filter('tinvwl_allow_add_to_wishlist_single_product', '__return_false', 99);
    add_filter('tinvwl_allow_add_to_wishlist_catalog', '__return_false', 99);
    add_filter('tinvwl_view_addto_html', '__return_empty_string', 99);

    // 3. WPC Smart Wishlist for WooCommerce
    add_filter('woosw_button_position', '__return_empty_string', 99);

    // Unhook YITH default action hooks if classes are present
    if (class_exists('YITH_WCWL_Frontend')) {
        remove_action('woocommerce_after_shop_loop_item', array('YITH_WCWL_Frontend', 'print_button'), 7);
        remove_action('woocommerce_after_shop_loop_item', array('YITH_WCWL_Frontend', 'print_button'), 15);
        remove_action('woocommerce_before_shop_loop_item', array('YITH_WCWL_Frontend', 'print_button'), 5);
        remove_action('woocommerce_single_product_summary', array('YITH_WCWL_Frontend', 'print_button'), 31);
        remove_action('woocommerce_after_add_to_cart_button', array('YITH_WCWL_Frontend', 'print_button'), 31);
        remove_action('woocommerce_before_add_to_cart_button', array('YITH_WCWL_Frontend', 'print_button'), 31);
    }
}
add_action('init', 'mazestreetwear_disable_wishlist_features', 10);
add_action('wp_loaded', 'mazestreetwear_disable_wishlist_features', 20);

/**
 * Redirect any lingering /wishlist/ visits directly to Cart
 */
function mazestreetwear_redirect_wishlist_to_cart()
{
    if (! is_admin() && function_exists('is_page')) {
        if (is_page('wishlist') || is_page('my-wishlist') || is_page('yith-wishlist')) {
            $cart_url = function_exists('wc_get_cart_url') ? wc_get_cart_url() : home_url('/cart/');
            wp_safe_redirect($cart_url, 301);
            exit;
        }
    }
}
add_action('template_redirect', 'mazestreetwear_redirect_wishlist_to_cart', 5);


/**
 * Filter WooCommerce breadcrumb defaults for minimalist monochrome aesthetic
 *
 * @param array $defaults Default breadcrumb settings.
 * @return array
 */
function mazestreetwear_breadcrumbs_defaults($defaults)
{
    $defaults['delimiter']   = '<span class="text-neutral-400 mx-2">/</span>';
    $defaults['wrap_before'] = '<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 sm:pt-6"><nav class="woocommerce-breadcrumb text-xs font-mono uppercase tracking-widest text-neutral-600 mb-6 flex flex-wrap items-center" aria-label="Breadcrumb">';
    $defaults['wrap_after']  = '</nav></div>';
    $defaults['before']      = '<span class="text-black">';
    $defaults['after']       = '</span>';
    $defaults['home']        = _x('HOME', 'breadcrumb', 'mazestreetwear');
    return $defaults;
}
add_filter('woocommerce_breadcrumb_defaults', 'mazestreetwear_breadcrumbs_defaults');

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
function mazestreetwear_get_privacy_policy_url()
{
    // 1. Check if a published page exists with slug 'privacy-policy'
    $page = get_page_by_path('privacy-policy', OBJECT, 'page');
    if ($page && 'publish' === $page->post_status) {
        return get_permalink($page->ID);
    }

    // 2. Check WordPress core privacy policy setting
    $privacy_id = (int) get_option('wp_page_for_privacy_policy');
    if ($privacy_id > 0 && 'publish' === get_post_status($privacy_id)) {
        return get_permalink($privacy_id);
    }

    // 3. Fallback to /privacy-policy/ permalink
    return home_url('/privacy-policy/');
}

/**
 * Safe Legal Link Helper: Terms & Conditions
 */
function mazestreetwear_get_terms_url()
{
    $front_page_id = (int) get_option('page_on_front');

    // 1. Check WooCommerce terms page setting (must be valid, published, and NOT front page)
    if (function_exists('wc_terms_and_conditions_page_id')) {
        $wc_terms_id = (int) wc_terms_and_conditions_page_id();
        if ($wc_terms_id > 0 && $wc_terms_id !== $front_page_id && 'publish' === get_post_status($wc_terms_id)) {
            return get_permalink($wc_terms_id);
        }
    }

    // 2. Check if a published page exists with slug 'terms-and-conditions'
    $page = get_page_by_path('terms-and-conditions', OBJECT, 'page');
    if ($page && 'publish' === $page->post_status) {
        return get_permalink($page->ID);
    }

    // 3. Check if a published page exists with slug 'terms'
    $page_terms = get_page_by_path('terms', OBJECT, 'page');
    if ($page_terms && 'publish' === $page_terms->post_status) {
        return get_permalink($page_terms->ID);
    }

    // 4. Fallback to /terms-and-conditions/ permalink
    return home_url('/terms-and-conditions/');
}

/**
 * Safe Legal Link Helper: Refund & Returns Policy
 */
function mazestreetwear_get_refund_policy_url()
{
    // 1. Check if a published page exists with slug 'refund-policy'
    $page = get_page_by_path('refund-policy', OBJECT, 'page');
    if ($page && 'publish' === $page->post_status) {
        return get_permalink($page->ID);
    }

    // 2. Check if a published page exists with slug 'refunds'
    $page_refunds = get_page_by_path('refunds', OBJECT, 'page');
    if ($page_refunds && 'publish' === $page_refunds->post_status) {
        return get_permalink($page_refunds->ID);
    }

    // 3. Check if a published page exists with slug 'returns'
    $page_returns = get_page_by_path('returns', OBJECT, 'page');
    if ($page_returns && 'publish' === $page_returns->post_status) {
        return get_permalink($page_returns->ID);
    }

    // 4. Fallback to /refund-policy/ permalink
    return home_url('/refund-policy/');
}

/**
 * Safe Legal Link Helper: Shipping & Delivery Policy
 */
function mazestreetwear_get_shipping_policy_url()
{
    // 1. Check if a published page exists with slug 'shipping-policy'
    $page = get_page_by_path('shipping-policy', OBJECT, 'page');
    if ($page && 'publish' === $page->post_status) {
        return get_permalink($page->ID);
    }

    // 2. Check if a published page exists with slug 'shipping'
    $page_shipping = get_page_by_path('shipping', OBJECT, 'page');
    if ($page_shipping && 'publish' === $page_shipping->post_status) {
        return get_permalink($page_shipping->ID);
    }

    // 3. Check if a published page exists with slug 'delivery-policy'
    $page_delivery = get_page_by_path('delivery-policy', OBJECT, 'page');
    if ($page_delivery && 'publish' === $page_delivery->post_status) {
        return get_permalink($page_delivery->ID);
    }

    // 4. Fallback to /shipping-policy/ permalink
    return home_url('/shipping-policy/');
}

/**
 * Safe Link Helper: Contact Us / Studio Desk
 */
function mazestreetwear_get_contact_url()
{
    // 1. Check if a published page exists with slug 'contact-us'
    $page = get_page_by_path('contact-us', OBJECT, 'page');
    if ($page && 'publish' === $page->post_status) {
        return get_permalink($page->ID);
    }

    // 2. Check if a published page exists with slug 'contact'
    $page_contact = get_page_by_path('contact', OBJECT, 'page');
    if ($page_contact && 'publish' === $page_contact->post_status) {
        return get_permalink($page_contact->ID);
    }

    // 3. Fallback to /contact-us/ permalink
    return home_url('/contact-us/');
}

/**
 * Safe Link Helper: About Us / Brand Manifesto
 */
function mazestreetwear_get_about_url()
{
    // 1. Check if a published page exists with slug 'about-us'
    $page = get_page_by_path('about-us', OBJECT, 'page');
    if ($page && 'publish' === $page->post_status) {
        return get_permalink($page->ID);
    }

    // 2. Check if a published page exists with slug 'about'
    $page_about = get_page_by_path('about', OBJECT, 'page');
    if ($page_about && 'publish' === $page_about->post_status) {
        return get_permalink($page_about->ID);
    }

    // 3. Fallback to /about-us/ permalink
    return home_url('/about-us/');
}

/**
 * Register rewrite rules and query vars for legal and contact pages.
 */
function mazestreetwear_legal_rewrite_rules()
{
    add_rewrite_rule('^privacy-policy/?$', 'index.php?mazepage=privacy-policy', 'top');
    add_rewrite_rule('^terms-and-conditions/?$', 'index.php?mazepage=terms-and-conditions', 'top');
    add_rewrite_rule('^terms/?$', 'index.php?mazepage=terms-and-conditions', 'top');
    add_rewrite_rule('^refund-policy/?$', 'index.php?mazepage=refund-policy', 'top');
    add_rewrite_rule('^refunds/?$', 'index.php?mazepage=refund-policy', 'top');
    add_rewrite_rule('^returns/?$', 'index.php?mazepage=refund-policy', 'top');
    add_rewrite_rule('^shipping-policy/?$', 'index.php?mazepage=shipping-policy', 'top');
    add_rewrite_rule('^shipping/?$', 'index.php?mazepage=shipping-policy', 'top');
    add_rewrite_rule('^delivery-policy/?$', 'index.php?mazepage=shipping-policy', 'top');
    add_rewrite_rule('^contact-us/?$', 'index.php?mazepage=contact-us', 'top');
    add_rewrite_rule('^contact/?$', 'index.php?mazepage=contact-us', 'top');
    add_rewrite_rule('^about-us/?$', 'index.php?mazepage=about-us', 'top');
    add_rewrite_rule('^about/?$', 'index.php?mazepage=about-us', 'top');
}
add_action('init', 'mazestreetwear_legal_rewrite_rules', 10);

/**
 * Register custom query vars for legal and contact pages.
 *
 * @param array $vars Existing query vars.
 * @return array
 */
function mazestreetwear_legal_query_vars($vars)
{
    $vars[] = 'mazepage';
    return $vars;
}
add_filter('query_vars', 'mazestreetwear_legal_query_vars');

/**
 * Prevent WordPress canonical redirect from bouncing legal and contact pages to homepage.
 *
 * @param string $redirect_url  Redirect URL.
 * @param string $requested_url Requested URL.
 * @return string|false
 */
function mazestreetwear_prevent_legal_canonical_redirect($redirect_url, $requested_url)
{
    if (preg_match('#/(privacy-policy|terms-and-conditions|terms|refund-policy|refunds|returns|shipping-policy|shipping|delivery-policy|contact-us|contact|about-us|about)/?$#i', $requested_url)) {
        return false;
    }
    return $redirect_url;
}
add_filter('redirect_canonical', 'mazestreetwear_prevent_legal_canonical_redirect', 10, 2);

/**
 * Template routing fallback for legal pages.
 * Ensures the custom templates are ALWAYS loaded even before rewrite rules or database records are synced.
 *
 * @param string $template Current template file path.
 * @return string
 */
function mazestreetwear_legal_template_include($template)
{
    // 1. Check custom query var from rewrite rule
    $mazepage = get_query_var('mazepage');
    if ('privacy-policy' === $mazepage) {
        global $wp_query;
        if ($wp_query) {
            $wp_query->is_404  = false;
            $wp_query->is_page = true;
        }
        status_header(200);
        $custom = get_template_directory() . '/page-privacy-policy.php';
        if (file_exists($custom)) {
            return $custom;
        }
    }

    if ('terms-and-conditions' === $mazepage) {
        global $wp_query;
        if ($wp_query) {
            $wp_query->is_404  = false;
            $wp_query->is_page = true;
        }
        status_header(200);
        $custom = get_template_directory() . '/page-terms-and-conditions.php';
        if (file_exists($custom)) {
            return $custom;
        }
    }

    if ('refund-policy' === $mazepage || 'refunds' === $mazepage) {
        global $wp_query;
        if ($wp_query) {
            $wp_query->is_404  = false;
            $wp_query->is_page = true;
        }
        status_header(200);
        $custom = get_template_directory() . '/page-refund-policy.php';
        if (file_exists($custom)) {
            return $custom;
        }
    }

    if ('shipping-policy' === $mazepage || 'shipping' === $mazepage || 'delivery-policy' === $mazepage) {
        global $wp_query;
        if ($wp_query) {
            $wp_query->is_404  = false;
            $wp_query->is_page = true;
        }
        status_header(200);
        $custom = get_template_directory() . '/page-shipping-policy.php';
        if (file_exists($custom)) {
            return $custom;
        }
    }

    if ('contact-us' === $mazepage || 'contact' === $mazepage) {
        global $wp_query;
        if ($wp_query) {
            $wp_query->is_404  = false;
            $wp_query->is_page = true;
        }
        status_header(200);
        $custom = get_template_directory() . '/page-contact-us.php';
        if (file_exists($custom)) {
            return $custom;
        }
    }

    if ('about-us' === $mazepage || 'about' === $mazepage) {
        global $wp_query;
        if ($wp_query) {
            $wp_query->is_404  = false;
            $wp_query->is_page = true;
        }
        status_header(200);
        $custom = get_template_directory() . '/page-about-us.php';
        if (file_exists($custom)) {
            return $custom;
        }
    }

    // 2. Native WordPress template or page slug match
    if (is_page_template('page-privacy-policy.php') || is_page('privacy-policy')) {
        $custom = get_template_directory() . '/page-privacy-policy.php';
        if (file_exists($custom)) {
            return $custom;
        }
    }

    if (is_page_template('page-terms-and-conditions.php') || is_page(array('terms-and-conditions', 'terms'))) {
        $custom = get_template_directory() . '/page-terms-and-conditions.php';
        if (file_exists($custom)) {
            return $custom;
        }
    }

    if (is_page_template('page-refund-policy.php') || is_page(array('refund-policy', 'refunds', 'returns'))) {
        $custom = get_template_directory() . '/page-refund-policy.php';
        if (file_exists($custom)) {
            return $custom;
        }
    }

    if (is_page_template('page-shipping-policy.php') || is_page(array('shipping-policy', 'shipping', 'delivery-policy'))) {
        $custom = get_template_directory() . '/page-shipping-policy.php';
        if (file_exists($custom)) {
            return $custom;
        }
    }

    if (is_page_template('page-contact-us.php') || is_page(array('contact-us', 'contact'))) {
        $custom = get_template_directory() . '/page-contact-us.php';
        if (file_exists($custom)) {
            return $custom;
        }
    }

    if (is_page_template('page-about-us.php') || is_page(array('about-us', 'about'))) {
        $custom = get_template_directory() . '/page-about-us.php';
        if (file_exists($custom)) {
            return $custom;
        }
    }

    // 3. Direct URI inspection (handles missing rewrite rules, subdirectory setups, or 404 state)
    $request_uri = isset($_SERVER['REQUEST_URI']) ? esc_url_raw(wp_unslash($_SERVER['REQUEST_URI'])) : '';
    $path = trim(parse_url($request_uri, PHP_URL_PATH), '/');

    $site_path = trim(parse_url(home_url(), PHP_URL_PATH), '/');
    if (! empty($site_path) && 0 === strpos($path, $site_path)) {
        $path = trim(substr($path, strlen($site_path)), '/');
    }

    if ($path === 'privacy-policy' || preg_match('#(^|/)privacy-policy/?$#i', $path)) {
        global $wp_query;
        if ($wp_query) {
            $wp_query->is_404  = false;
            $wp_query->is_page = true;
        }
        status_header(200);
        $custom = get_template_directory() . '/page-privacy-policy.php';
        if (file_exists($custom)) {
            return $custom;
        }
    }

    if ($path === 'terms-and-conditions' || $path === 'terms' || preg_match('#(^|/)(terms-and-conditions|terms)/?$#i', $path)) {
        global $wp_query;
        if ($wp_query) {
            $wp_query->is_404  = false;
            $wp_query->is_page = true;
        }
        status_header(200);
        $custom = get_template_directory() . '/page-terms-and-conditions.php';
        if (file_exists($custom)) {
            return $custom;
        }
    }

    if ($path === 'refund-policy' || $path === 'refunds' || $path === 'returns' || preg_match('#(^|/)(refund-policy|refunds|returns)/?$#i', $path)) {
        global $wp_query;
        if ($wp_query) {
            $wp_query->is_404  = false;
            $wp_query->is_page = true;
        }
        status_header(200);
        $custom = get_template_directory() . '/page-refund-policy.php';
        if (file_exists($custom)) {
            return $custom;
        }
    }

    if ($path === 'shipping-policy' || $path === 'shipping' || $path === 'delivery-policy' || preg_match('#(^|/)(shipping-policy|shipping|delivery-policy)/?$#i', $path)) {
        global $wp_query;
        if ($wp_query) {
            $wp_query->is_404  = false;
            $wp_query->is_page = true;
        }
        status_header(200);
        $custom = get_template_directory() . '/page-shipping-policy.php';
        if (file_exists($custom)) {
            return $custom;
        }
    }

    if ($path === 'contact-us' || $path === 'contact' || preg_match('#(^|/)(contact-us|contact)/?$#i', $path)) {
        global $wp_query;
        if ($wp_query) {
            $wp_query->is_404  = false;
            $wp_query->is_page = true;
        }
        status_header(200);
        $custom = get_template_directory() . '/page-contact-us.php';
        if (file_exists($custom)) {
            return $custom;
        }
    }

    if ($path === 'about-us' || $path === 'about' || preg_match('#(^|/)(about-us|about)/?$#i', $path)) {
        global $wp_query;
        if ($wp_query) {
            $wp_query->is_404  = false;
            $wp_query->is_page = true;
        }
        status_header(200);
        $custom = get_template_directory() . '/page-about-us.php';
        if (file_exists($custom)) {
            return $custom;
        }
    }

    return $template;
}
add_filter('template_include', 'mazestreetwear_legal_template_include', 99);

/**
 * Ensure document title is correct when legal pages are routed directly.
 *
 * @param array $title_parts Existing title parts.
 * @return array
 */
function mazestreetwear_legal_document_title_parts($title_parts)
{
    $request_uri = isset($_SERVER['REQUEST_URI']) ? esc_url_raw(wp_unslash($_SERVER['REQUEST_URI'])) : '';
    $path = trim(parse_url($request_uri, PHP_URL_PATH), '/');
    $site_path = trim(parse_url(home_url(), PHP_URL_PATH), '/');
    if (! empty($site_path) && 0 === strpos($path, $site_path)) {
        $path = trim(substr($path, strlen($site_path)), '/');
    }

    if ($path === 'privacy-policy' || preg_match('#(^|/)privacy-policy/?$#i', $path) || get_query_var('mazepage') === 'privacy-policy') {
        $title_parts['title'] = __('Privacy Policy', 'mazestreetwear');
    } elseif ($path === 'terms-and-conditions' || $path === 'terms' || preg_match('#(^|/)(terms-and-conditions|terms)/?$#i', $path) || get_query_var('mazepage') === 'terms-and-conditions') {
        $title_parts['title'] = __('Terms & Conditions', 'mazestreetwear');
    } elseif ($path === 'refund-policy' || $path === 'refunds' || $path === 'returns' || preg_match('#(^|/)(refund-policy|refunds|returns)/?$#i', $path) || in_array(get_query_var('mazepage'), array('refund-policy', 'refunds'), true)) {
        $title_parts['title'] = __('Refund & Returns Policy', 'mazestreetwear');
    } elseif ($path === 'shipping-policy' || $path === 'shipping' || $path === 'delivery-policy' || preg_match('#(^|/)(shipping-policy|shipping|delivery-policy)/?$#i', $path) || in_array(get_query_var('mazepage'), array('shipping-policy', 'shipping', 'delivery-policy'), true)) {
        $title_parts['title'] = __('Shipping & Delivery Policy', 'mazestreetwear');
    } elseif ($path === 'contact-us' || $path === 'contact' || preg_match('#(^|/)(contact-us|contact)/?$#i', $path) || in_array(get_query_var('mazepage'), array('contact-us', 'contact'), true)) {
        $title_parts['title'] = __('Contact Us // Concierge Desk', 'mazestreetwear');
    } elseif ($path === 'about-us' || $path === 'about' || preg_match('#(^|/)(about-us|about)/?$#i', $path) || in_array(get_query_var('mazepage'), array('about-us', 'about'), true)) {
        $title_parts['title'] = __('About Us // MAZE', 'mazestreetwear');
    }

    return $title_parts;
}
add_filter('document_title_parts', 'mazestreetwear_legal_document_title_parts', 10);

/**
 * Auto-publish and sync legal pages in WordPress database.
 * If pages do not exist, or are stuck in Draft/Trash status, publishes them
 * and links them to WordPress Privacy and WooCommerce Terms settings.
 */
function mazestreetwear_ensure_legal_pages_exist()
{
    // Only run if user is admin or on initial page loads, keep performance high
    if (! is_admin() && get_transient('mazestreetwear_legal_pages_checked')) {
        return;
    }

    $updated = false;

    // 1. Privacy Policy
    $privacy_page  = get_page_by_path('privacy-policy', OBJECT, 'page');
    $wp_privacy_id = (int) get_option('wp_page_for_privacy_policy');

    if (! $privacy_page) {
        if ($wp_privacy_id > 0) {
            $existing = get_post($wp_privacy_id);
            if ($existing) {
                if ('publish' !== $existing->post_status) {
                    wp_update_post(array(
                        'ID'          => $wp_privacy_id,
                        'post_status' => 'publish',
                        'post_name'   => 'privacy-policy',
                    ));
                    $updated = true;
                }
                update_post_meta($wp_privacy_id, '_wp_page_template', 'page-privacy-policy.php');
            }
        } else {
            $new_privacy_id = wp_insert_post(array(
                'post_title'     => __('Privacy Policy', 'mazestreetwear'),
                'post_name'      => 'privacy-policy',
                'post_status'    => 'publish',
                'post_type'      => 'page',
                'comment_status' => 'closed',
            ));
            if (! is_wp_error($new_privacy_id) && $new_privacy_id > 0) {
                update_post_meta($new_privacy_id, '_wp_page_template', 'page-privacy-policy.php');
                update_option('wp_page_for_privacy_policy', $new_privacy_id);
                $updated = true;
            }
        }
    } else {
        if ('publish' !== $privacy_page->post_status) {
            wp_update_post(array(
                'ID'          => $privacy_page->ID,
                'post_status' => 'publish',
            ));
            $updated = true;
        }
        update_post_meta($privacy_page->ID, '_wp_page_template', 'page-privacy-policy.php');
        if ($wp_privacy_id !== (int) $privacy_page->ID) {
            update_option('wp_page_for_privacy_policy', $privacy_page->ID);
        }
    }

    // 2. Terms & Conditions
    $terms_page = get_page_by_path('terms-and-conditions', OBJECT, 'page');
    if (! $terms_page) {
        $terms_page = get_page_by_path('terms', OBJECT, 'page');
    }

    $wc_terms_id   = function_exists('wc_terms_and_conditions_page_id') ? (int) wc_terms_and_conditions_page_id() : (int) get_option('woocommerce_terms_page_id');
    $front_page_id = (int) get_option('page_on_front');

    // If wc_terms_id points to front page, reset it so it doesn't bounce to home
    if ($wc_terms_id > 0 && $wc_terms_id === $front_page_id) {
        $wc_terms_id = 0;
        delete_option('woocommerce_terms_page_id');
    }

    if (! $terms_page) {
        if ($wc_terms_id > 0 && $wc_terms_id !== $front_page_id) {
            $existing_terms = get_post($wc_terms_id);
            if ($existing_terms) {
                if ('publish' !== $existing_terms->post_status) {
                    wp_update_post(array(
                        'ID'          => $wc_terms_id,
                        'post_status' => 'publish',
                    ));
                    $updated = true;
                }
                update_post_meta($wc_terms_id, '_wp_page_template', 'page-terms-and-conditions.php');
            }
        } else {
            $new_terms_id = wp_insert_post(array(
                'post_title'     => __('Terms & Conditions', 'mazestreetwear'),
                'post_name'      => 'terms-and-conditions',
                'post_status'    => 'publish',
                'post_type'      => 'page',
                'comment_status' => 'closed',
            ));
            if (! is_wp_error($new_terms_id) && $new_terms_id > 0) {
                update_post_meta($new_terms_id, '_wp_page_template', 'page-terms-and-conditions.php');
                update_option('woocommerce_terms_page_id', $new_terms_id);
                $updated = true;
            }
        }
    } else {
        if ('publish' !== $terms_page->post_status) {
            wp_update_post(array(
                'ID'          => $terms_page->ID,
                'post_status' => 'publish',
            ));
            $updated = true;
        }
        update_post_meta($terms_page->ID, '_wp_page_template', 'page-terms-and-conditions.php');
        if ($wc_terms_id !== (int) $terms_page->ID) {
            update_option('woocommerce_terms_page_id', $terms_page->ID);
        }
    }

    // 3. Refund & Returns Policy
    $refund_page = get_page_by_path('refund-policy', OBJECT, 'page');
    if (! $refund_page) {
        $refund_page = get_page_by_path('refunds', OBJECT, 'page');
    }

    if (! $refund_page) {
        $new_refund_id = wp_insert_post(array(
            'post_title'     => __('Refund & Returns Policy', 'mazestreetwear'),
            'post_name'      => 'refund-policy',
            'post_status'    => 'publish',
            'post_type'      => 'page',
            'comment_status' => 'closed',
        ));
        if (! is_wp_error($new_refund_id) && $new_refund_id > 0) {
            update_post_meta($new_refund_id, '_wp_page_template', 'page-refund-policy.php');
            $updated = true;
        }
    } else {
        if ('publish' !== $refund_page->post_status) {
            wp_update_post(array(
                'ID'          => $refund_page->ID,
                'post_status' => 'publish',
            ));
            $updated = true;
        }
        update_post_meta($refund_page->ID, '_wp_page_template', 'page-refund-policy.php');
    }

    // 4. Shipping & Delivery Policy
    $shipping_page = get_page_by_path('shipping-policy', OBJECT, 'page');
    if (! $shipping_page) {
        $shipping_page = get_page_by_path('shipping', OBJECT, 'page');
    }

    if (! $shipping_page) {
        $new_shipping_id = wp_insert_post(array(
            'post_title'     => __('Shipping & Delivery Policy', 'mazestreetwear'),
            'post_name'      => 'shipping-policy',
            'post_status'    => 'publish',
            'post_type'      => 'page',
            'comment_status' => 'closed',
        ));
        if (! is_wp_error($new_shipping_id) && $new_shipping_id > 0) {
            update_post_meta($new_shipping_id, '_wp_page_template', 'page-shipping-policy.php');
            $updated = true;
        }
    } else {
        if ('publish' !== $shipping_page->post_status) {
            wp_update_post(array(
                'ID'          => $shipping_page->ID,
                'post_status' => 'publish',
            ));
            $updated = true;
        }
        update_post_meta($shipping_page->ID, '_wp_page_template', 'page-shipping-policy.php');
    }

    // 5. Contact Us Page
    $contact_page = get_page_by_path('contact-us', OBJECT, 'page');
    if (! $contact_page) {
        $contact_page = get_page_by_path('contact', OBJECT, 'page');
    }

    if (! $contact_page) {
        $new_contact_id = wp_insert_post(array(
            'post_title'     => __('Contact Us', 'mazestreetwear'),
            'post_name'      => 'contact-us',
            'post_status'    => 'publish',
            'post_type'      => 'page',
            'comment_status' => 'closed',
        ));
        if (! is_wp_error($new_contact_id) && $new_contact_id > 0) {
            update_post_meta($new_contact_id, '_wp_page_template', 'page-contact-us.php');
            $updated = true;
        }
    } else {
        if ('publish' !== $contact_page->post_status) {
            wp_update_post(array(
                'ID'          => $contact_page->ID,
                'post_status' => 'publish',
            ));
            $updated = true;
        }
        update_post_meta($contact_page->ID, '_wp_page_template', 'page-contact-us.php');
    }

    // 6. About Us Page
    $about_page = get_page_by_path('about-us', OBJECT, 'page');
    if (! $about_page) {
        $about_page = get_page_by_path('about', OBJECT, 'page');
    }

    if (! $about_page) {
        $new_about_id = wp_insert_post(array(
            'post_title'     => __('About Us', 'mazestreetwear'),
            'post_name'      => 'about-us',
            'post_status'    => 'publish',
            'post_type'      => 'page',
            'comment_status' => 'closed',
        ));
        if (! is_wp_error($new_about_id) && $new_about_id > 0) {
            update_post_meta($new_about_id, '_wp_page_template', 'page-about-us.php');
            $updated = true;
        }
    } else {
        if ('publish' !== $about_page->post_status) {
            wp_update_post(array(
                'ID'          => $about_page->ID,
                'post_status' => 'publish',
            ));
            $updated = true;
        }
        update_post_meta($about_page->ID, '_wp_page_template', 'page-about-us.php');
    }

    if ($updated) {
        flush_rewrite_rules(false);
    }

    set_transient('mazestreetwear_legal_pages_checked', 1, DAY_IN_SECONDS);
}
add_action('init', 'mazestreetwear_ensure_legal_pages_exist', 5);
add_action('after_switch_theme', 'mazestreetwear_ensure_legal_pages_exist');

/**
 * Safe Helper to retrieve product category archive URL
 *
 * Checks if the term exists in 'product_cat' taxonomy, returning its canonical permalink.
 * If not yet created or WP error, gracefully falls back to /product-category/{slug}/
 *
 * @param string $slug Product category slug.
 * @return string Category archive URL.
 */
function mazestreetwear_get_product_cat_url($slug)
{
    if (taxonomy_exists('product_cat')) {
        $term = get_term_by('slug', $slug, 'product_cat');
        if (! $term) {
            $term = get_term_by('name', $slug, 'product_cat');
        }
        if ($term && ! is_wp_error($term)) {
            $link = get_term_link($term, 'product_cat');
            if (! is_wp_error($link)) {
                return $link;
            }
        }
    }
    return home_url('/product-category/' . sanitize_title($slug) . '/');
}

/**
 * Automatically ensure standard storefront product categories exist in WooCommerce
 * Tops, Bottoms, and Accessories will be registered if not already present.
 */
function mazestreetwear_ensure_default_categories()
{
    if (! taxonomy_exists('product_cat')) {
        return;
    }

    $default_cats = array(
        'tops'        => __('Tops', 'mazestreetwear'),
        'bottoms'     => __('Bottoms', 'mazestreetwear'),
        'accessories' => __('Accessories', 'mazestreetwear'),
    );

    foreach ($default_cats as $slug => $name) {
        if (! term_exists($slug, 'product_cat') && ! term_exists($name, 'product_cat')) {
            wp_insert_term($name, 'product_cat', array(
                'slug'        => $slug,
                'description' => sprintf(__('Minimalist street-ready %s collection.', 'mazestreetwear'), $name),
            ));
        }
    }
}
add_action('init', 'mazestreetwear_ensure_default_categories', 10);

/**
 * Automatically append Contact link to the primary menu if not already present.
 *
 * @param string $items Menu items HTML.
 * @param object $args  Menu arguments.
 * @return string
 */
function mazestreetwear_add_contact_to_primary_menu($items, $args)
{
    if (isset($args->theme_location) && 'primary' === $args->theme_location) {
        if (false === stripos($items, 'contact-us') && false === stripos($items, 'contact')) {
            $contact_url  = mazestreetwear_get_contact_url();
            $is_active    = (is_page('contact-us') || is_page('contact') || (isset($_SERVER['REQUEST_URI']) && false !== strpos($_SERVER['REQUEST_URI'], 'contact')));
            $active_class = $is_active ? 'current-menu-item ' : '';

            if (false !== strpos($items, '<li')) {
                $items .= '<li class="menu-item ' . esc_attr($active_class) . '"><a href="' . esc_url($contact_url) . '" class="hover:text-black transition-colors duration-150 py-1' . ($is_active ? ' font-black text-black' : '') . '">' . esc_html__('Contact', 'mazestreetwear') . '</a></li>';
            } else {
                $items .= '<a href="' . esc_url($contact_url) . '" class="text-black hover:opacity-60 py-1.5 transition-opacity' . ($is_active ? ' font-black' : '') . '">' . esc_html__('Contact', 'mazestreetwear') . '</a>';
            }
        }
    }
    return $items;
}
add_filter('wp_nav_menu_items', 'mazestreetwear_add_contact_to_primary_menu', 10, 2);

/**
 * Handle Contact Form Submissions (AJAX & Standard POST)
 */
function mazestreetwear_handle_contact_submission()
{
    // Nonce verification
    if (! isset($_POST['maze_contact_nonce']) || ! wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['maze_contact_nonce'])), 'maze_contact_action')) {
        if (wp_doing_ajax()) {
            wp_send_json_error(array('message' => __('Security verification failed. Please refresh and try again.', 'mazestreetwear')));
        }
        return;
    }

    // Honeypot anti-spam check
    if (! empty($_POST['maze_website_url'])) {
        if (wp_doing_ajax()) {
            wp_send_json_success(array('message' => __('Inquiry logged successfully.', 'mazestreetwear')));
        }
        return;
    }

    $name       = isset($_POST['maze_name']) ? sanitize_text_field(wp_unslash($_POST['maze_name'])) : '';
    $email      = isset($_POST['maze_email']) ? sanitize_email(wp_unslash($_POST['maze_email'])) : '';
    $phone      = isset($_POST['maze_phone']) ? sanitize_text_field(wp_unslash($_POST['maze_phone'])) : '';
    $department = isset($_POST['maze_department']) ? sanitize_text_field(wp_unslash($_POST['maze_department'])) : 'General Concierge';
    $order_num  = isset($_POST['maze_order']) ? sanitize_text_field(wp_unslash($_POST['maze_order'])) : '';
    $subject    = isset($_POST['maze_subject']) ? sanitize_text_field(wp_unslash($_POST['maze_subject'])) : '';
    $message    = isset($_POST['maze_message']) ? sanitize_textarea_field(wp_unslash($_POST['maze_message'])) : '';

    if (empty($name) || empty($email) || ! is_email($email) || empty($message)) {
        if (wp_doing_ajax()) {
            wp_send_json_error(array('message' => __('Please fill in all required fields with a valid email address.', 'mazestreetwear')));
        }
        return;
    }

    $to           = 'enquiries@mazestw.in';
    $mail_subject = sprintf('[MAZE CONCIERGE] %s: %s', strtoupper($department), ! empty($subject) ? $subject : 'New Inquiry from ' . $name);

    $body  = "MAZE STREETWEAR - CONCIERGE TRANSMISSION\n";
    $body .= "==========================================\n\n";
    $body .= "Name: " . $name . "\n";
    $body .= "Email: " . $email . "\n";
    if (! empty($phone)) {
        $body .= "Phone: " . $phone . "\n";
    }
    $body .= "Department: " . $department . "\n";
    if (! empty($order_num)) {
        $body .= "Order Reference: " . $order_num . "\n";
    }
    $body .= "Subject: " . $subject . "\n";
    $body .= "Date / Time: " . current_time('mysql') . " (IST)\n\n";
    $body .= "Message:\n" . $message . "\n\n";
    $body .= "==========================================\n";
    $body .= "Sent from mazestw.in Concierge Desk";

    $headers = array(
        'From: MAZE Concierge Desk <enquiries@mazestw.in>',
        'Reply-To: ' . $name . ' <' . $email . '>',
        'Content-Type: text/plain; charset=UTF-8',
    );

    // Send email to official desk
    @wp_mail($to, $mail_subject, $body, $headers);

    if (wp_doing_ajax()) {
        wp_send_json_success(array(
            'message' => __('Transmission confirmed. Your inquiry has been routed to our concierge desk. We will respond to your email within 24 business hours.', 'mazestreetwear'),
            'name'    => $name,
        ));
    }
}
add_action('wp_ajax_maze_contact_submission', 'mazestreetwear_handle_contact_submission');
add_action('wp_ajax_nopriv_maze_contact_submission', 'mazestreetwear_handle_contact_submission');
add_action('admin_post_maze_contact_submission', 'mazestreetwear_handle_contact_submission');
add_action('admin_post_nopriv_maze_contact_submission', 'mazestreetwear_handle_contact_submission');

/**
 * Default Favicon & Site Icon Support for Maze Streetwear
 * Ensures WordPress core, REST API, feeds, and third-party plugins use the custom MAZE emblem favicon
 * when no icon is uploaded in Appearance > Customize.
 *
 * @param string $url     Site icon URL.
 * @param int    $size    Site icon size in pixels.
 * @param int    $blog_id Blog ID.
 * @return string
 */
function mazestreetwear_filter_site_icon_url($url, $size, $blog_id)
{
    if (! empty($url)) {
        return $url;
    }

    $theme_dir = get_template_directory_uri();

    if ($size <= 16) {
        return $theme_dir . '/assets/images/favicon-16x16.png';
    } elseif ($size <= 32) {
        return $theme_dir . '/assets/images/favicon-32x32.png';
    } elseif ($size <= 48) {
        return $theme_dir . '/assets/images/favicon-48x48.png';
    } elseif ($size <= 96) {
        return $theme_dir . '/assets/images/favicon-96x96.png';
    } elseif ($size <= 180) {
        return $theme_dir . '/assets/images/apple-touch-icon.png';
    } elseif ($size <= 192) {
        return $theme_dir . '/assets/images/android-chrome-192x192.png';
    } else {
        return $theme_dir . '/assets/images/android-chrome-512x512.png';
    }
}
add_filter('get_site_icon_url', 'mazestreetwear_filter_site_icon_url', 10, 3);
