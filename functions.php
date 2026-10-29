<?php

/**
 * Maze Theme Functions
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

    // Disable WooCommerce built-in product gallery slider, zoom, and lightbox features on the single product page
    // so WooCommerce does not lock images into a fixed-height container box.
    remove_theme_support('wc-product-gallery-zoom');
    remove_theme_support('wc-product-gallery-lightbox');
    remove_theme_support('wc-product-gallery-slider');

    // Register Navigation Menus
    register_nav_menus(array(
        'primary' => __('Primary Navigation', 'mazestreetwear'),
        'footer'  => __('Footer Navigation', 'mazestreetwear'),
    ));
}
add_action('after_setup_theme', 'mazestreetwear_setup');

/**
 * Explicitly disable WooCommerce built-in product gallery slider, zoom, and lightbox features
 * on the single product page so WooCommerce does not lock images into a fixed-height container box.
 */
function mazestreetwear_disable_wc_gallery_features()
{
    remove_theme_support('wc-product-gallery-zoom');
    remove_theme_support('wc-product-gallery-lightbox');
    remove_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'mazestreetwear_disable_wc_gallery_features', 100);

/**
 * Dequeue WooCommerce gallery scripts and styles on single product page
 * to prevent any fixed-height or box-sizing constraints.
 */
function mazestreetwear_dequeue_wc_gallery_scripts()
{
    if (function_exists('is_product') && is_product()) {
        wp_dequeue_script('zoom');
        wp_dequeue_script('flexslider');
        wp_dequeue_script('photoswipe-ui-default');
        wp_dequeue_style('photoswipe');
        wp_dequeue_style('photoswipe-default-skin');
    }
}
add_action('wp_enqueue_scripts', 'mazestreetwear_dequeue_wc_gallery_scripts', 100);

/**
 * Enqueue scripts and styles.
 */
function mazestreetwear_scripts()
{
    $theme_version = wp_get_theme()->get('Version');

    // Enqueue Google Fonts: Outfit (weights 300 to 900) & Bebas Neue (Display)
    wp_enqueue_style(
        'mazestreetwear-google-fonts',
        'https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;500;600;700;800;900&display=swap',
        array(),
        null
    );

    // Compiled Tailwind CSS Bundle (includes Outfit & Bebas Neue typography and utilities)
    $bundle_css_path = get_template_directory() . '/assets/css/bundle.css';
    $bundle_version  = file_exists($bundle_css_path) ? filemtime($bundle_css_path) : $theme_version;

    wp_enqueue_style(
        'mazestreetwear-tailwind',
        get_template_directory_uri() . '/assets/css/bundle.css',
        array('mazestreetwear-google-fonts'),
        $bundle_version
    );

    // Core theme style.css for metadata/fallbacks
    $style_css_path = get_stylesheet_directory() . '/style.css';
    $style_version  = file_exists($style_css_path) ? filemtime($style_css_path) : $theme_version;

    wp_enqueue_style(
        'mazestreetwear-style',
        get_stylesheet_uri(),
        array('mazestreetwear-tailwind'),
        $style_version
    );

    // Theme JavaScript (Streetwear interactions, mobile menu, dynamic size pill variation sync)
    $main_js_path = get_template_directory() . '/assets/js/main.js';
    $js_version   = time(); // Instant cache-busting to guarantee immediate execution in browser

    // Mazestreetwear-main JavaScript
    // CRITICAL: Depend strictly on 'jquery' so this script is GUARANTEED to load and execute
    // across all templates (single product, cart, shop, front-page) without being suppressed.
    $deps = array('jquery');

    // Enqueue WooCommerce scripts if available
    if (function_exists('WC')) {
        wp_enqueue_script('wc-cart-fragments');
    }
    if (function_exists('is_product') && is_product()) {
        wp_enqueue_script('wc-add-to-cart-variation');
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
        'nonce'       => wp_create_nonce('maze_cart_nonce'),
        'cartUrl'     => function_exists('wc_get_cart_url') ? wc_get_cart_url() : home_url('/cart/'),
        'checkoutUrl' => function_exists('wc_get_checkout_url') ? wc_get_checkout_url() : home_url('/checkout/'),
        'shopUrl'     => function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/shop/'),
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
 * Lightweight Cart Count & Fragment AJAX sync endpoint
 */
function mazestreetwear_ajax_get_cart_fragments()
{
    $count = mazestreetwear_get_cart_count();
    $fragments = apply_filters('woocommerce_add_to_cart_fragments', array());
    $cart_hash = (function_exists('WC') && WC()->cart) ? WC()->cart->get_cart_hash() : '';

    wp_send_json_success(array(
        'cart_count'  => $count,
        'items_count' => $count,
        'fragments'   => $fragments,
        'cart_hash'   => $cart_hash,
        'cart_url'    => function_exists('wc_get_cart_url') ? wc_get_cart_url() : home_url('/cart/'),
    ));
}
add_action('wp_ajax_maze_get_cart_fragments', 'mazestreetwear_ajax_get_cart_fragments');
add_action('wp_ajax_nopriv_maze_get_cart_fragments', 'mazestreetwear_ajax_get_cart_fragments');

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
 * Prevent WC_Form_Handler::add_to_cart_action from intercepting AJAX requests and issuing 302 redirects
 */
add_action('init', function () {
    if (wp_doing_ajax() || (defined('DOING_AJAX') && DOING_AJAX) || (isset($_REQUEST['action']) && $_REQUEST['action'] === 'maze_ajax_add_to_cart')) {
        remove_action('wp_loaded', array('WC_Form_Handler', 'add_to_cart_action'), 20);
    }
}, 5);

/**
 * Suppress WooCommerce "Added to Cart / View Cart" notice banner globally.
 * The shopping bag badge in the header dynamically updates and pulses in real time.
 */
add_filter('wc_add_to_cart_message_html', '__return_false', 999);
add_filter('woocommerce_add_to_cart_message_html', '__return_false', 999);
add_filter('woocommerce_add_message', function ($message) {
    if (is_string($message) && (stripos($message, 'added to your cart') !== false || stripos($message, 'wc-forward') !== false || stripos($message, 'view cart') !== false)) {
        return false;
    }
    return $message;
}, 999);
add_filter('woocommerce_add_success', function ($message) {
    if (is_string($message) && (stripos($message, 'added to your cart') !== false || stripos($message, 'wc-forward') !== false || stripos($message, 'view cart') !== false)) {
        return false;
    }
    return $message;
}, 999);

// Clear any success notices (such as added to cart) before single product render
add_action('woocommerce_before_single_product', function () {
    if (function_exists('wc_clear_notices') && function_exists('wc_get_notices')) {
        $notices = wc_get_notices('success');
        if (! empty($notices)) {
            wc_clear_notices();
        }
    }
}, 5);

/**
 * AJAX Add to Bag & Buy Now handler for Single Product pages (Simple & Variable)
 * Eliminates full-page form POST, preventing browser ERR_CACHE_MISS / Confirm Form Resubmission on back navigation
 */
function mazestreetwear_ajax_add_to_cart()
{
    // Ensure WooCommerce session and cart exist in AJAX context
    if (function_exists('WC')) {
        if (null === WC()->session && class_exists('WC_Session_Handler')) {
            $session_class = apply_filters('woocommerce_session_handler', 'WC_Session_Handler');
            WC()->session  = new $session_class();
            WC()->session->init();
        }
        if (null === WC()->customer && class_exists('WC_Customer')) {
            WC()->customer = new WC_Customer(get_current_user_id(), true);
        }
        if (null === WC()->cart) {
            if (function_exists('wc_load_cart')) {
                wc_load_cart();
            } elseif (class_exists('WC_Cart')) {
                WC()->cart = new WC_Cart();
            }
        }
        if (WC()->session && method_exists(WC()->session, 'set_customer_session_cookie')) {
            WC()->session->set_customer_session_cookie(true);
        }
    }

    if (! function_exists('WC') || ! WC()->cart) {
        wp_send_json_error(array('message' => __('WooCommerce cart is not available.', 'mazestreetwear')));
    }

    $raw_product_id = isset($_POST['product_id']) ? absint($_POST['product_id']) : (isset($_POST['add-to-cart']) ? absint($_POST['add-to-cart']) : 0);
    $quantity       = isset($_POST['quantity']) ? wc_stock_amount(wp_unslash($_POST['quantity'])) : 1;
    $variation_id   = isset($_POST['variation_id']) ? absint($_POST['variation_id']) : 0;
    $is_buy_now     = ! empty($_POST['is_buy_now']) || ! empty($_POST['maze_buy_now']);

    if ($quantity <= 0) {
        $quantity = 1;
    }

    if (! $raw_product_id && ! $variation_id) {
        wp_send_json_error(array('message' => __('No product specified.', 'mazestreetwear')));
    }

    $product_id = $raw_product_id;
    $product    = $product_id ? wc_get_product($product_id) : null;

    // If passed product_id was actually a variation, resolve the parent variable product
    if ($product && $product->is_type('variation')) {
        $variation_id = $product->get_id();
        $product_id   = $product->get_parent_id();
        $product      = wc_get_product($product_id);
    } elseif (! $product && $variation_id) {
        $var_product = wc_get_product($variation_id);
        if ($var_product && $var_product->is_type('variation')) {
            $product_id = $var_product->get_parent_id();
            $product    = wc_get_product($product_id);
        }
    }

    if (! $product) {
        wp_send_json_error(array('message' => __('Product not found.', 'mazestreetwear')));
    }

    $variations     = array();
    $cart_item_data = array();

    // Collect variation attributes (attribute_pa_size, attribute_size, attribute_color, etc.)
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'attribute_') === 0 && '' !== $value) {
            $variations[$key] = sanitize_text_field(wp_unslash($value));
        }
    }

    // Handle variable products
    if ($product->is_type('variable')) {
        // 1. If variation_id is already set, verify it belongs to this product
        if ($variation_id) {
            $child = wc_get_product($variation_id);
            if (! $child || ! $child->is_type('variation') || $child->get_parent_id() != $product_id) {
                $variation_id = 0;
            }
        }

        // 2. If variation_id is missing, try find_matching_product_variation
        if (empty($variation_id) && ! empty($variations) && class_exists('WC_Data_Store')) {
            $data_store   = WC_Data_Store::load('product');
            $variation_id = $data_store->find_matching_product_variation($product, $variations);
            if (empty($variation_id)) {
                $lower_variations = array();
                foreach ($variations as $k => $v) {
                    $lower_variations[$k] = is_string($v) ? strtolower($v) : $v;
                }
                $variation_id = $data_store->find_matching_product_variation($product, $lower_variations);
            }
        }

        // 3. Match against children variations directly by comparing attributes
        if (empty($variation_id)) {
            $candidate_size = ! empty($_POST['selected_size']) ? sanitize_text_field(wp_unslash($_POST['selected_size'])) : '';
            if (empty($candidate_size) && ! empty($variations)) {
                $candidate_size = reset($variations);
            }

            $children = $product->get_children();
            foreach ($children as $child_id) {
                $child = wc_get_product($child_id);
                if (! $child || ! $child->is_purchasable() || ! $child->is_in_stock()) {
                    continue;
                }
                if (! empty($candidate_size)) {
                    $child_attrs = $child->get_attributes();
                    foreach ($child_attrs as $c_key => $c_val) {
                        if (strcasecmp($c_val, $candidate_size) === 0 || strcasecmp(sanitize_title($c_val), sanitize_title($candidate_size)) === 0) {
                            $variation_id = $child_id;
                            break 2;
                        }
                    }
                }
            }
        }

        // 4. Fallback to first in-stock purchasable variation
        if (empty($variation_id)) {
            $children = $product->get_children();
            foreach ($children as $child_id) {
                $child = wc_get_product($child_id);
                if ($child && $child->is_purchasable() && $child->is_in_stock()) {
                    $variation_id = $child_id;
                    break;
                }
            }
        }

        // 5. Fallback to first child
        if (empty($variation_id)) {
            $children = $product->get_children();
            if (! empty($children)) {
                $variation_id = reset($children);
            }
        }

        // 6. Populate exact variation attributes from child variation
        if ($variation_id) {
            $child = wc_get_product($variation_id);
            if ($child instanceof \WC_Product_Variation || (is_object($child) && method_exists($child, 'get_variation_attributes'))) {
                /** @var \WC_Product_Variation $child */
                $child_attrs = $child->get_variation_attributes();
                if (is_array($child_attrs)) {
                    foreach ($child_attrs as $attr_k => $attr_v) {
                        if ('' !== $attr_v) {
                            $variations[$attr_k] = $attr_v;
                        }
                    }
                }
            }
        }

        // 7. Ensure any missing parent attributes receive default or first available option
        if ($product instanceof \WC_Product_Variable || (is_object($product) && method_exists($product, 'get_variation_attributes'))) {
            /** @var \WC_Product_Variable $product */
            $parent_attrs = $product->get_variation_attributes();
            if (is_array($parent_attrs)) {
                foreach ($parent_attrs as $p_attr_name => $p_options) {
                    $p_key = 'attribute_' . sanitize_title($p_attr_name);
                    if ((! isset($variations[$p_key]) || '' === $variations[$p_key]) && ! empty($p_options)) {
                        $variations[$p_key] = reset($p_options);
                    }
                }
            }
        }

        if (empty($variation_id)) {
            wp_send_json_error(array('message' => __('Please select an available size before proceeding.', 'mazestreetwear')));
        }
    }

    // Preserve custom selected_size in cart item data
    if (! empty($_POST['selected_size'])) {
        $cart_item_data['selected_size'] = sanitize_text_field(wp_unslash($_POST['selected_size']));
        $cart_item_data['unique_key']    = md5(microtime() . wp_rand());
    }

    $checkout_url = function_exists('wc_get_checkout_url') ? wc_get_checkout_url() : home_url('/checkout/');
    $cart_url     = function_exists('wc_get_cart_url') ? wc_get_cart_url() : home_url('/cart/');

    // If Buy Now was requested, check if this EXACT item or variation is ALREADY in the cart
    if ($is_buy_now && function_exists('WC') && WC()->cart) {
        $found_cart_item_key = false;
        foreach (WC()->cart->get_cart() as $c_key => $c_item) {
            if ($variation_id && ! empty($c_item['variation_id']) && $c_item['variation_id'] == $variation_id) {
                $found_cart_item_key = $c_key;
                break;
            } elseif (! $variation_id && $c_item['product_id'] == $product_id) {
                if (! empty($cart_item_data['selected_size']) && ! empty($c_item['selected_size'])) {
                    if ($cart_item_data['selected_size'] === $c_item['selected_size']) {
                        $found_cart_item_key = $c_key;
                        break;
                    }
                } else {
                    $found_cart_item_key = $c_key;
                    break;
                }
            }
        }
        if ($found_cart_item_key) {
            $existing_item = WC()->cart->get_cart_item($found_cart_item_key);
            $curr_qty      = ! empty($existing_item['quantity']) ? (int) $existing_item['quantity'] : 1;
            if ($quantity > $curr_qty) {
                WC()->cart->set_quantity($found_cart_item_key, $quantity);
            }
            WC()->cart->calculate_totals();
            if (method_exists(WC()->cart, 'maybe_set_cart_cookies')) {
                WC()->cart->maybe_set_cart_cookies();
            }
            if (WC()->session && method_exists(WC()->session, 'set_customer_session_cookie')) {
                WC()->session->set_customer_session_cookie(true);
            }
            while (ob_get_level() > 0) {
                ob_end_clean();
            }
            wp_send_json_success(array(
                'cart_count'   => mazestreetwear_get_cart_count(),
                'items_count'  => mazestreetwear_get_cart_count(),
                'checkout_url' => $checkout_url,
                'cart_url'     => $cart_url,
                'is_buy_now'   => true,
            ));
        }
    }

    // Validate add to cart
    $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity, $variation_id, $variations);

    if (! $passed_validation) {
        // If Buy Now was requested and validation failed (e.g. sold individually already in cart), proceed directly to checkout
        if ($is_buy_now && function_exists('WC') && WC()->cart && ! WC()->cart->is_empty()) {
            WC()->cart->calculate_totals();
            if (method_exists(WC()->cart, 'maybe_set_cart_cookies')) {
                WC()->cart->maybe_set_cart_cookies();
            }
            if (WC()->session && method_exists(WC()->session, 'set_customer_session_cookie')) {
                WC()->session->set_customer_session_cookie(true);
            }
            while (ob_get_level() > 0) {
                ob_end_clean();
            }
            wp_send_json_success(array(
                'cart_count'   => mazestreetwear_get_cart_count(),
                'items_count'  => mazestreetwear_get_cart_count(),
                'checkout_url' => $checkout_url,
                'cart_url'     => $cart_url,
                'is_buy_now'   => true,
            ));
        }

        $notices   = wc_get_notices('error');
        $error_msg = ! empty($notices) ? wp_strip_all_tags($notices[0]['notice']) : __('Validation failed. Please select options.', 'mazestreetwear');
        wc_clear_notices();
        wp_send_json_error(array('message' => $error_msg));
    }

    $cart_item_key = WC()->cart->add_to_cart($product_id, $quantity, $variation_id, $variations, $cart_item_data);

    if ($cart_item_key) {
        if (function_exists('wc_clear_notices')) {
            wc_clear_notices();
        }

        WC()->cart->calculate_totals();
        if (method_exists(WC()->cart, 'maybe_set_cart_cookies')) {
            WC()->cart->maybe_set_cart_cookies();
        }
        if (WC()->session && method_exists(WC()->session, 'set_customer_session_cookie')) {
            WC()->session->set_customer_session_cookie(true);
        }

        ob_start();
        do_action('woocommerce_ajax_added_to_cart', $product_id);
        ob_end_clean();

        $count         = mazestreetwear_get_cart_count();
        $fragments     = apply_filters('woocommerce_add_to_cart_fragments', array());
        $cart_hash     = WC()->cart->get_cart_hash();
        $item_product  = wc_get_product($variation_id ? $variation_id : $product_id);
        $product_title = $item_product ? $item_product->get_name() : $product->get_name();

        while (ob_get_level() > 0) {
            ob_end_clean();
        }

        wp_send_json_success(array(
            'cart_count'   => $count,
            'items_count'  => $count,
            'fragments'    => $fragments,
            'cart_hash'    => $cart_hash,
            'product_name' => $product_title,
            'cart_url'     => $cart_url,
            'checkout_url' => $checkout_url,
            'is_buy_now'   => $is_buy_now,
        ));
    } else {
        // If Buy Now was requested and item is in cart, proceed to checkout
        if ($is_buy_now && function_exists('WC') && WC()->cart && ! WC()->cart->is_empty()) {
            WC()->cart->calculate_totals();
            if (method_exists(WC()->cart, 'maybe_set_cart_cookies')) {
                WC()->cart->maybe_set_cart_cookies();
            }
            if (WC()->session && method_exists(WC()->session, 'set_customer_session_cookie')) {
                WC()->session->set_customer_session_cookie(true);
            }
            while (ob_get_level() > 0) {
                ob_end_clean();
            }
            wp_send_json_success(array(
                'cart_count'   => mazestreetwear_get_cart_count(),
                'items_count'  => mazestreetwear_get_cart_count(),
                'checkout_url' => $checkout_url,
                'cart_url'     => $cart_url,
                'is_buy_now'   => true,
            ));
        }

        $notices   = wc_get_notices('error');
        $error_msg = ! empty($notices) ? wp_strip_all_tags($notices[0]['notice']) : __('Could not add item to bag. Please try again.', 'mazestreetwear');
        wc_clear_notices();
        wp_send_json_error(array('message' => $error_msg));
    }
}
add_action('wp_ajax_maze_ajax_add_to_cart', 'mazestreetwear_ajax_add_to_cart');
add_action('wp_ajax_nopriv_maze_ajax_add_to_cart', 'mazestreetwear_ajax_add_to_cart');

/**
 * Post-Redirect-Get (PRG) pattern for standard non-AJAX form submissions
 * Prevents browser "Confirm Form Resubmission" (ERR_CACHE_MISS) on back-button navigation
 */
add_filter('woocommerce_add_to_cart_redirect', function ($url) {
    $is_buy_now = (! empty($_REQUEST['maze_buy_now']) && '0' !== (string)$_REQUEST['maze_buy_now'])
        || (! empty($_POST['maze_buy_now']) && '0' !== (string)$_POST['maze_buy_now'])
        || ! empty($_REQUEST['is_buy_now'])
        || ! empty($_POST['is_buy_now'])
        || ! empty($_REQUEST['maze_buy_now_submit'])
        || ! empty($_POST['maze_buy_now_submit']);

    if ($is_buy_now) {
        return function_exists('wc_get_checkout_url') ? wc_get_checkout_url() : home_url('/checkout/');
    }
    if (wp_doing_ajax() || (defined('DOING_AJAX') && DOING_AJAX) || (isset($_REQUEST['action']) && $_REQUEST['action'] === 'maze_ajax_add_to_cart')) {
        return false;
    }
    if ('yes' !== get_option('woocommerce_cart_redirect_after_add')) {
        $product_id = isset($_REQUEST['add-to-cart']) ? absint($_REQUEST['add-to-cart']) : 0;
        if ($product_id) {
            $permalink = get_permalink($product_id);
            if ($permalink) {
                return $permalink;
            }
        }
    }
    return $url;
}, 99);

/**
 * Ensure add-to-cart parameter is populated from product_id for native Buy Now submissions
 */
add_action('wp_loaded', function () {
    $is_buy_now = (! empty($_REQUEST['maze_buy_now']) && '0' !== (string)$_REQUEST['maze_buy_now'])
        || (! empty($_POST['maze_buy_now']) && '0' !== (string)$_POST['maze_buy_now'])
        || ! empty($_REQUEST['is_buy_now'])
        || ! empty($_POST['is_buy_now']);

    if ($is_buy_now) {
        if (empty($_REQUEST['add-to-cart']) && ! empty($_REQUEST['product_id'])) {
            $_REQUEST['add-to-cart'] = absint($_REQUEST['product_id']);
            $_POST['add-to-cart']    = absint($_REQUEST['product_id']);
        }
    }
}, 15);

/**
 * Direct Checkout redirect for any product page request carrying Buy Now parameters
 * Priority 99 guarantees WooCommerce core add_to_cart_action at priority 20 has finished adding the product to cart
 */
add_action('template_redirect', function () {
    $is_buy_now = (! empty($_REQUEST['maze_buy_now']) && '0' !== (string)$_REQUEST['maze_buy_now'])
        || (! empty($_POST['maze_buy_now']) && '0' !== (string)$_POST['maze_buy_now'])
        || ! empty($_REQUEST['maze_buy_now_submit'])
        || ! empty($_REQUEST['is_buy_now'])
        || isset($_GET['buy_now']);

    if ($is_buy_now && function_exists('is_product') && is_product()) {
        if (function_exists('wc_get_checkout_url')) {
            wp_safe_redirect(wc_get_checkout_url());
            exit;
        }
    }
}, 99);



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
 * Remove WooCommerce breadcrumbs across all pages of the website
 */
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
add_action('init', function () {
    remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
});
add_filter('woocommerce_get_breadcrumb', '__return_empty_array', 999);

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
 * Remove About and Contact from the primary header navigation menu items.
 * They are displayed exclusively in the mobile view menu drawer.
 *
 * @param array $items Array of menu item objects.
 * @param object $args Arguments for wp_nav_menu.
 * @return array
 */
function mazestreetwear_filter_header_primary_menu_items($items, $args)
{
    if (isset($args->theme_location) && 'primary' === $args->theme_location && is_array($items)) {
        $filtered = array();
        foreach ($items as $item) {
            $title = strtolower(trim($item->title ?? ''));
            $url   = strtolower(trim($item->url ?? ''));

            $is_about   = (false !== strpos($title, 'about') || false !== strpos($url, '/about'));
            $is_contact = (false !== strpos($title, 'contact') || false !== strpos($url, '/contact'));

            if (! $is_about && ! $is_contact) {
                $filtered[] = $item;
            }
        }
        return $filtered;
    }
    return $items;
}
add_filter('wp_nav_menu_objects', 'mazestreetwear_filter_header_primary_menu_items', 10, 2);

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

    $body  = "MAZE - CONCIERGE TRANSMISSION\n";
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
 * Default Favicon & Site Icon Support for Maze
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

/**
 * Image Quality & Downscaling Optimization
 * 1. Sets JPEG and WebP compression quality to 100% to prevent WordPress from compressing uploads.
 * 2. Disables big_image_size_threshold (returns false) so original high-resolution uploads are not auto-downscaled.
 * 3. Enforces full-resolution uncompressed images across single product pages, gallery, loops, and variations.
 */
add_filter('jpeg_quality', function () {
    return 100;
});

add_filter('wp_editor_set_quality', function () {
    return 100;
});

// Disable auto-downscaling threshold on large image uploads (preserve 100% original full dimensions)
add_filter('big_image_size_threshold', '__return_false');

// Single product image size: always fetch 'full' uncompressed size
add_filter('woocommerce_single_product_image_size', function () {
    return 'full';
});

// Single product gallery image size: always fetch 'full' uncompressed size
add_filter('woocommerce_gallery_image_size', function () {
    return 'full';
});

// Single product gallery thumbnail size: always fetch 'full' uncompressed size
add_filter('woocommerce_gallery_thumbnail_size', function () {
    return 'full';
});

// Ensure WooCommerce single product image dimensions don't crop or downscale
add_filter('woocommerce_get_image_size_single', function ($size) {
    return array(
        'width'  => 0,
        'height' => 0,
        'crop'   => 0,
    );
});

add_filter('woocommerce_get_image_size_gallery_thumbnail', function ($size) {
    return array(
        'width'  => 0,
        'height' => 0,
        'crop'   => 0,
    );
});

// Ensure variation images return full uncompressed size URL
add_filter('woocommerce_available_variation', function ($data, $product, $variation) {
    if (! empty($data['image_id'])) {
        $full_src = wp_get_attachment_image_url($data['image_id'], 'full');
        if ($full_src) {
            $data['image']['src'] = $full_src;
            $data['image']['full_src'] = $full_src;
        }
    }
    return $data;
}, 10, 3);

add_filter('single_product_archive_thumbnail_size', function () {
    return 'full';
});

add_filter('subcategory_archive_thumbnail_size', function () {
    return 'full';
});

/**
 * Enforce full uppercase letter on all product titles and names across the website
 *
 * @param string   $title Product or post title.
 * @param int|null $id    Post ID.
 * @return string
 */
function mazestreetwear_uppercase_product_name_filter($title, $id = null)
{
    if (! is_admin() && $id && 'product' === get_post_type($id)) {
        return mb_strtoupper($title, 'UTF-8');
    }
    return $title;
}
add_filter('the_title', 'mazestreetwear_uppercase_product_name_filter', 10, 2);

/**
 * Enforce full uppercase letter on cart and order item titles
 *
 * @param string      $name          Item title or HTML link.
 * @param array|null  $cart_item     Cart item data.
 * @param string|null $cart_item_key Cart item key.
 * @return string
 */
function mazestreetwear_uppercase_cart_item_name($name, $cart_item = null, $cart_item_key = null)
{
    if (false !== strpos($name, '<a')) {
        return preg_replace_callback('/>([^<]+)</', function ($matches) {
            return '>' . mb_strtoupper($matches[1], 'UTF-8') . '<';
        }, $name);
    }
    return mb_strtoupper($name, 'UTF-8');
}
add_filter('woocommerce_cart_item_name', 'mazestreetwear_uppercase_cart_item_name', 10, 3);
add_filter('woocommerce_order_item_name', 'mazestreetwear_uppercase_cart_item_name', 10, 3);

/**
 * Returns curated garment size charts for Maze
 *
 * @return array
 */
function mazestreetwear_get_size_charts()
{
    $charts = array(
        'wave-pant' => array(
            'id'       => 'wave-pant',
            'title'    => 'WAVE PANT',
            'columns'  => array('SIZE', 'WAIST', 'LENGTH'),
            'rows'     => array(
                array('size' => 'S',   'waist' => '28 in (71.12 cm)', 'length' => '38.5 in (97.79 cm)'),
                array('size' => 'M',   'waist' => '30 in (76.20 cm)', 'length' => '39.5 in (100.30 cm)'),
                array('size' => 'L',   'waist' => '32 in (81.28 cm)', 'length' => '40.5 in (102.87 cm)'),
                array('size' => 'XL',  'waist' => '34 in (86.36 cm)', 'length' => '41.5 in (105.41 cm)'),
                array('size' => 'XXL', 'waist' => '36 in (91.44 cm)', 'length' => '42.5 in (107.95 cm)'),
            ),
        ),
        'utility-gilet' => array(
            'id'       => 'utility-gilet',
            'title'    => 'UTILITY GILET',
            'columns'  => array('SIZE', 'LENGTH', 'CHEST'),
            'rows'     => array(
                array('size' => 'M',  'length' => '22 in (55.80 cm)', 'chest' => '44 in (111.70 cm)'),
                array('size' => 'L',  'length' => '23 in (58.42 cm)', 'chest' => '46 in (116.84 cm)'),
                array('size' => 'XL', 'length' => '24 in (60.96 cm)', 'chest' => '48 in (121.92 cm)'),
            ),
        ),
        'lightning-t-shirt' => array(
            'id'       => 'lightning-t-shirt',
            'title'    => 'LIGHTNING T-SHIRT',
            'columns'  => array('SIZE', 'LENGTH', 'CHEST'),
            'rows'     => array(
                array('size' => 'S',   'length' => '24 in (60.96 cm)', 'chest' => '42 in (106.86 cm)'),
                array('size' => 'M',   'length' => '25 in (63.50 cm)', 'chest' => '44 in (111.76 cm)'),
                array('size' => 'L',   'length' => '26 in (66.04 cm)', 'chest' => '46 in (116.84 cm)'),
                array('size' => 'XL',  'length' => '27 in (68.58 cm)', 'chest' => '48 in (121.92 cm)'),
                array('size' => 'XXL', 'length' => '28 in (71.12 cm)', 'chest' => '50 in (127.00 cm)'),
            ),
        ),
        'puffy-puffer' => array(
            'id'       => 'puffy-puffer',
            'title'    => 'PUFFY PUFFER',
            'columns'  => array('SIZE', 'LENGTH', 'CHEST'),
            'rows'     => array(
                array('size' => 'M',  'length' => '24 in (60.96 cm)', 'chest' => '48 in (121.92 cm)'),
                array('size' => 'L',  'length' => '25 in (63.50 cm)', 'chest' => '50 in (127.00 cm)'),
                array('size' => 'XL', 'length' => '26 in (66.04 cm)', 'chest' => '52 in (132.08 cm)'),
            ),
        ),
        'puffer-gilet' => array(
            'id'       => 'puffer-gilet',
            'title'    => 'PUFFER GILET',
            'columns'  => array('SIZE', 'LENGTH', 'CHEST'),
            'rows'     => array(
                array('size' => 'M', 'length' => '23.5 in (59.69 cm)', 'chest' => '44 in (111.76 cm)'),
                array('size' => 'L', 'length' => '24.5 in (62.23 cm)', 'chest' => '46 in (116.84 cm)'),
            ),
        ),
        'utility-jacket' => array(
            'id'       => 'utility-jacket',
            'title'    => 'UTILITY / WAVE JACKET',
            'columns'  => array('SIZE', 'LENGTH', 'CHEST'),
            'rows'     => array(
                array('size' => 'M',  'length' => '24 in (60.96 cm)', 'chest' => '46 in (116.84 cm)'),
                array('size' => 'L',  'length' => '25 in (63.50 cm)', 'chest' => '48 in (121.92 cm)'),
                array('size' => 'XL', 'length' => '26 in (66.04 cm)', 'chest' => '50 in (127.00 cm)'),
            ),
        ),
        'double-layered-hoodie' => array(
            'id'       => 'double-layered-hoodie',
            'title'    => 'DOUBLE LAYERED HOODIE',
            'columns'  => array('SIZE', 'LENGTH', 'CHEST'),
            'rows'     => array(
                array('size' => 'M',  'length' => '24 in (60.96 cm)', 'chest' => '46 in (116.84 cm)'),
                array('size' => 'L',  'length' => '25 in (63.50 cm)', 'chest' => '48 in (121.92 cm)'),
                array('size' => 'XL', 'length' => '26 in (66.04 cm)', 'chest' => '50 in (127.00 cm)'),
            ),
        ),
        'camp-shirt' => array(
            'id'       => 'camp-shirt',
            'title'    => 'CAMP SHIRT 0.2',
            'columns'  => array('SIZE', 'LENGTH', 'CHEST'),
            'rows'     => array(
                array('size' => 'S',  'length' => '23.5 in (59.69 cm)', 'chest' => '43 in (109.22 cm)'),
                array('size' => 'M',  'length' => '25 in (63.50 cm)',   'chest' => '46 in (116.84 cm)'),
                array('size' => 'L',  'length' => '26 in (66.04 cm)',   'chest' => '48 in (121.92 cm)'),
                array('size' => 'XL', 'length' => '27.5 in (69.85 cm)', 'chest' => '50 in (127.00 cm)'),
            ),
        ),
    );

    // Aliases for alternate slugs, attributes, and backwards compatibility
    $charts['t-shirt']                   = &$charts['lightning-t-shirt'];
    $charts['puffy-puffer-0-2']          = &$charts['puffy-puffer'];
    $charts['puffer-jacket']             = &$charts['puffy-puffer'];
    $charts['wave-jacket']               = &$charts['utility-jacket'];
    $charts['utility-jacket-design-0-2'] = &$charts['utility-jacket'];
    $charts['jacket']                    = &$charts['utility-jacket'];
    $charts['double-layer-hoodie']       = &$charts['double-layered-hoodie'];
    $charts['camp-shirt-0-2']            = &$charts['camp-shirt'];
    $charts['wave-pants']                = &$charts['wave-pant'];
    $charts['pant']                      = &$charts['wave-pant'];
    $charts['pants']                     = &$charts['wave-pant'];

    return apply_filters('mazestreetwear_size_charts', $charts);
}

/**
 * Determine whether a product is classified as an accessory.
 *
 * Checks product category (and taxonomy ancestors), tags, attributes, and title/slug keywords.
 *
 * @param WC_Product|int|null $product
 * @return bool
 */
function mazestreetwear_is_accessory_product($product = null)
{
    if (! $product && function_exists('wc_get_product')) {
        if (function_exists('is_product') && is_product()) {
            $queried_id = get_queried_object_id();
            if ($queried_id) {
                $product = wc_get_product($queried_id);
            }
        }
        if (! $product) {
            global $post;
            if ($post && 'product' === get_post_type($post)) {
                $product = wc_get_product($post->ID);
            }
        }
    } elseif (is_numeric($product) && function_exists('wc_get_product')) {
        $product = wc_get_product($product);
    }

    if (! $product || ! is_a($product, 'WC_Product')) {
        return false;
    }

    $product_id = $product->get_id();

    // 1. Direct WooCommerce category check for 'accessories' / 'accessory'
    if (has_term(array('accessories', 'accessory'), 'product_cat', $product_id)) {
        return true;
    }

    // 2. Check all assigned product categories and ancestors
    $cat_ids = $product->get_category_ids();
    if (! empty($cat_ids)) {
        $accessory_cat_slugs = array(
            'accessories', 'accessory', 'bags', 'bag', 'caps', 'cap',
            'hats', 'hat', 'beanies', 'beanie', 'belts', 'belt',
            'socks', 'sock', 'wallets', 'wallet', 'jewellery', 'jewelry',
            'eyewear', 'sunglasses', 'sunglass', 'keychains', 'keychain'
        );
        foreach ($cat_ids as $cid) {
            $term = get_term($cid, 'product_cat');
            if ($term && ! is_wp_error($term)) {
                $term_slug = strtolower($term->slug);
                $term_name = strtolower($term->name);

                if (in_array($term_slug, $accessory_cat_slugs, true) ||
                    false !== strpos($term_slug, 'accessori') ||
                    false !== strpos($term_name, 'accessori')) {
                    return true;
                }

                // Check whole-word category names
                if (preg_match('/\b(accessories|accessory|bags?|caps?|hats?|beanies?|belts?|socks?|wallets?|jewell?ery|eyewear|sunglasses?|keychains?)\b/i', $term_name)) {
                    return true;
                }

                // Check ancestors of this category
                $ancestors = get_ancestors($cid, 'product_cat');
                if (! empty($ancestors)) {
                    foreach ($ancestors as $ancestor_id) {
                        $ancestor = get_term($ancestor_id, 'product_cat');
                        if ($ancestor && ! is_wp_error($ancestor)) {
                            $anc_slug = strtolower($ancestor->slug);
                            $anc_name = strtolower($ancestor->name);
                            if (in_array($anc_slug, $accessory_cat_slugs, true) ||
                                false !== strpos($anc_slug, 'accessori') ||
                                false !== strpos($anc_name, 'accessori')) {
                                return true;
                            }
                        }
                    }
                }
            }
        }
    }

    // 3. Product tags check
    $tags = get_the_terms($product_id, 'product_tag');
    if (! empty($tags) && ! is_wp_error($tags)) {
        foreach ($tags as $tag) {
            $tag_slug = strtolower($tag->slug);
            $tag_name = strtolower($tag->name);
            if (false !== strpos($tag_slug, 'accessori') || false !== strpos($tag_name, 'accessori') ||
                in_array($tag_slug, array('accessories', 'accessory', 'bag', 'bags', 'cap', 'caps', 'hat', 'hats', 'beanie', 'beanies', 'belt', 'socks'), true)) {
                return true;
            }
        }
    }

    // 4. Product title & slug check (using whole-word boundaries to avoid false positives like 'baggy')
    $name = strtolower($product->get_name());
    $slug = strtolower($product->get_slug());
    $text = ' ' . $name . ' ' . str_replace(array('-', '_'), ' ', $slug) . ' ';

    $accessory_words = array(
        'accessory', 'accessories', 'cap', 'caps', 'hat', 'hats', 'beanie', 'beanies',
        'bucket hat', 'tote', 'tote bag', 'backpack', 'backpacks', 'duffle', 'wallet', 'wallets',
        'belt', 'belts', 'socks', 'sock', 'keychain', 'keychains', 'sunglasses',
        'glasses', 'goggles', 'necklace', 'bracelet', 'ring', 'jewellery', 'jewelry', 'pouch'
    );

    foreach ($accessory_words as $aw) {
        if (preg_match('/\b' . preg_quote($aw, '/') . '\b/i', $text)) {
            return true;
        }
    }

    return (bool) apply_filters('mazestreetwear_is_accessory_product', false, $product);
}

/**
 * Determine whether a product has an active size chart available.
 *
 * @param WC_Product|int|null $product
 * @return bool
 */
function mazestreetwear_product_has_size_chart($product = null)
{
    if (mazestreetwear_is_accessory_product($product)) {
        return false;
    }

    $chart = mazestreetwear_get_product_size_chart($product);
    return ! empty($chart) && is_array($chart);
}

/**
 * Detect the appropriate size chart key based on product name, slug, attributes, or categories
 *
 * @param WC_Product|int|null $product
 * @return string
 */
function mazestreetwear_get_current_product_size_chart_key($product = null)
{
    if (! $product && function_exists('wc_get_product')) {
        if (function_exists('is_product') && is_product()) {
            $queried_id = get_queried_object_id();
            if ($queried_id) {
                $product = wc_get_product($queried_id);
            }
        }
        if (! $product) {
            global $post;
            if ($post && 'product' === get_post_type($post)) {
                $product = wc_get_product($post->ID);
            }
        }
    } elseif (is_numeric($product) && function_exists('wc_get_product')) {
        $product = wc_get_product($product);
    }

    if (! $product || ! is_a($product, 'WC_Product')) {
        return '';
    }

    // Accessories strictly have no size chart
    if (mazestreetwear_is_accessory_product($product)) {
        return '';
    }

    $charts = mazestreetwear_get_size_charts();

    // 0a. Explicit custom size chart attribute or meta
    $meta_chart = get_post_meta($product->get_id(), '_size_chart', true);
    if (! $meta_chart) {
        $meta_chart = get_post_meta($product->get_id(), 'size_chart', true);
    }
    if ($meta_chart && isset($charts[$meta_chart])) {
        return $charts[$meta_chart]['id'];
    }

    // 0b. Explicit product attribute (e.g. pa_size_chart or pa_garment_type)
    if (method_exists($product, 'get_attribute')) {
        $attr_chart = $product->get_attribute('size_chart') ?: $product->get_attribute('pa_size_chart');
        if (! $attr_chart) {
            $attr_chart = $product->get_attribute('garment_type') ?: $product->get_attribute('pa_garment_type');
        }
        if ($attr_chart) {
            $attr_key = sanitize_title($attr_chart);
            if (isset($charts[$attr_key])) {
                return $charts[$attr_key]['id'];
            }
        }
    }

    $name = strtolower($product->get_name());
    $slug = strtolower($product->get_slug());

    $cat_names = array();
    $terms = get_the_terms($product->get_id(), 'product_cat');
    if (! empty($terms) && ! is_wp_error($terms)) {
        foreach ($terms as $term) {
            $cat_names[] = strtolower($term->name);
            $cat_names[] = strtolower($term->slug);
        }
    }

    $tag_names = array();
    $tags = get_the_terms($product->get_id(), 'product_tag');
    if (! empty($tags) && ! is_wp_error($tags)) {
        foreach ($tags as $tag) {
            $tag_names[] = strtolower($tag->name);
            $tag_names[] = strtolower($tag->slug);
        }
    }

    $search_pool = $name . ' ' . $slug . ' ' . implode(' ', $cat_names) . ' ' . implode(' ', $tag_names);

    // 1. WAVE PANT (Pant / Pants / Trouser)
    if (false !== strpos($search_pool, 'pant') || false !== strpos($search_pool, 'trouser')) {
        return 'wave-pant';
    }

    // 2. PUFFER GILET (Gilet / Vest with Puffer)
    if (false !== strpos($search_pool, 'puffer gilet') || (false !== strpos($search_pool, 'puffer') && (false !== strpos($search_pool, 'gilet') || false !== strpos($search_pool, 'vest')))) {
        return 'puffer-gilet';
    }

    // 3. UTILITY GILET (Standard Gilet / Vest)
    if (false !== strpos($search_pool, 'utility gilet') || false !== strpos($search_pool, 'utitlity gilet') || false !== strpos($search_pool, 'gilet') || false !== strpos($search_pool, 'vest')) {
        return 'utility-gilet';
    }

    // 4. PUFFY PUFFER / PUFFY PUFFER 0.2
    if (false !== strpos($search_pool, 'puffy puffer') || false !== strpos($search_pool, 'puffy') || false !== strpos($search_pool, 'puffer') || false !== strpos($search_pool, 'down jacket')) {
        return 'puffy-puffer';
    }

    // 5. CAMP SHIRT 0.2 (Matched before generic shirt/tee)
    if (false !== strpos($search_pool, 'camp shirt') || false !== strpos($search_pool, 'campshirt') || false !== strpos($search_pool, 'camp')) {
        return 'camp-shirt';
    }

    // 6. DOUBLE LAYERED HOODIE
    if (false !== strpos($search_pool, 'double layer') || false !== strpos($search_pool, 'double-layer') || false !== strpos($search_pool, 'hoodie') || false !== strpos($search_pool, 'hooded') || false !== strpos($search_pool, 'sweatshirt')) {
        return 'double-layered-hoodie';
    }

    // 7. UTILITY JACKET DESIGN 0.2 / WAVE JACKET
    if (false !== strpos($search_pool, 'wave jacket') || false !== strpos($search_pool, 'utility jacket') || false !== strpos($search_pool, 'jacket') || false !== strpos($search_pool, 'bomber') || false !== strpos($search_pool, 'windbreaker') || false !== strpos($search_pool, 'coat')) {
        return 'utility-jacket';
    }

    // 8. LIGHTNING T-SHIRT / T-SHIRT
    if (false !== strpos($search_pool, 'lightning') || false !== strpos($search_pool, 't-shirt') || false !== strpos($search_pool, 'tshirt') || false !== strpos($search_pool, 'tee') || false !== strpos($search_pool, 'top') || false !== strpos($search_pool, 'shirt')) {
        return 'lightning-t-shirt';
    }

    return apply_filters('mazestreetwear_product_size_chart_key', 'lightning-t-shirt', $product);
}

/**
 * Returns the single matching size chart for a given product or currently viewed product.
 * Returns null if the product is an accessory or has no size chart.
 *
 * @param WC_Product|int|null $product
 * @return array|null
 */
function mazestreetwear_get_product_size_chart($product = null)
{
    if (! $product && function_exists('wc_get_product')) {
        if (function_exists('is_product') && is_product()) {
            $queried_id = get_queried_object_id();
            if ($queried_id) {
                $product = wc_get_product($queried_id);
            }
        }
        if (! $product) {
            global $post;
            if ($post && 'product' === get_post_type($post)) {
                $product = wc_get_product($post->ID);
            }
        }
    } elseif (is_numeric($product) && function_exists('wc_get_product')) {
        $product = wc_get_product($product);
    }

    if (! $product || ! is_a($product, 'WC_Product')) {
        return null;
    }

    // Strict early exit for accessories
    if (mazestreetwear_is_accessory_product($product)) {
        return null;
    }

    $charts = mazestreetwear_get_size_charts();
    $key    = mazestreetwear_get_current_product_size_chart_key($product);

    if (empty($key) || ! isset($charts[$key])) {
        return null;
    }

    $chart = $charts[$key];

    if ($chart && is_a($product, 'WC_Product')) {
        $prod_name = strtoupper(trim($product->get_name()));
        if ($key === 'utility-jacket') {
            if (false !== strpos($prod_name, 'WAVE JACKET')) {
                $chart['title'] = 'WAVE JACKET';
            } elseif (false !== strpos($prod_name, 'UTILITY JACKET DESIGN 0.2')) {
                $chart['title'] = 'UTILITY JACKET DESIGN 0.2';
            } elseif (false !== strpos($prod_name, 'UTILITY JACKET')) {
                $chart['title'] = 'UTILITY JACKET';
            }
        } elseif ($key === 'puffy-puffer') {
            if (false !== strpos($prod_name, 'PUFFY PUFFER 0.2')) {
                $chart['title'] = 'PUFFY PUFFER 0.2';
            } elseif (false !== strpos($prod_name, 'PUFFY PUFFER')) {
                $chart['title'] = 'PUFFY PUFFER';
            }
        } elseif ($key === 'lightning-t-shirt') {
            if (false !== strpos($prod_name, 'LIGHTNING')) {
                $chart['title'] = 'LIGHTNING T-SHIRT';
            } else {
                $chart['title'] = 'T-SHIRT';
            }
        }
    }

    return apply_filters('mazestreetwear_current_product_size_chart', $chart, $product, $key);
}

/**
 * Hook Size Chart Modal into wp_footer for product pages
 */
function mazestreetwear_render_size_chart_modal()
{
    if (is_admin()) {
        return;
    }

    if ((function_exists('is_product') && is_product()) || is_singular('product')) {
        $product_id = get_queried_object_id();
        $product    = function_exists('wc_get_product') ? wc_get_product($product_id) : null;
        if ($product && function_exists('mazestreetwear_is_accessory_product') && mazestreetwear_is_accessory_product($product)) {
            return;
        }
        $template   = locate_template('woocommerce/single-product/size-chart-modal.php');
        if ($template) {
            include $template;
        }
    }
}
add_action('wp_footer', 'mazestreetwear_render_size_chart_modal', 25);

/**
 * Add body class for accessory products to facilitate style and script targeting.
 *
 * @param array $classes
 * @return array
 */
function mazestreetwear_accessory_product_body_class($classes)
{
    if ((function_exists('is_product') && is_product()) || is_singular('product')) {
        $product_id = get_queried_object_id();
        $product    = function_exists('wc_get_product') ? wc_get_product($product_id) : null;
        if ($product && function_exists('mazestreetwear_is_accessory_product') && mazestreetwear_is_accessory_product($product)) {
            $classes[] = 'is-accessory-product';
        }
    }
    return $classes;
}
add_filter('body_class', 'mazestreetwear_accessory_product_body_class');

/**
 * Hard-enforce suppression of legacy size chart switcher tabs in wp_head
 * and suppress size chart triggers if an accessory product is active.
 */
function mazestreetwear_size_chart_inline_guard_css()
{
    if ((function_exists('is_product') && is_product()) || is_singular('product')) {
        $product_id = get_queried_object_id();
        $product    = function_exists('wc_get_product') ? wc_get_product($product_id) : null;
        $is_acc     = ($product && function_exists('mazestreetwear_is_accessory_product') && mazestreetwear_is_accessory_product($product));

        echo '<style id="maze-size-chart-guard">' . "\n";
        echo '.maze-size-chart-tabs,.maze-size-chart-tab{display:none!important;visibility:hidden!important;height:0!important;max-height:0!important;padding:0!important;margin:0!important;border:0!important;opacity:0!important;pointer-events:none!important;}' . "\n";
        if ($is_acc) {
            echo '.maze-size-chart-trigger,.maze-size-chart-trigger-wrap,#maze-size-chart-modal{display:none!important;visibility:hidden!important;height:0!important;max-height:0!important;padding:0!important;margin:0!important;border:0!important;opacity:0!important;pointer-events:none!important;}' . "\n";
        }
        echo '</style>' . "\n";
    }
}
add_action('wp_head', 'mazestreetwear_size_chart_inline_guard_css', 999);

/**
 * Hard-enforce Black background and White text for Cart ("Proceed to Checkout")
 * and Checkout ("Place Order") buttons site-wide across Classic WooCommerce and Blocks.
 */
function mazestreetwear_cart_checkout_button_inline_css()
{
    ?>
    <style id="maze-cart-checkout-button-styles">
    /* CSS Variables for Gutenberg Cart & Checkout Blocks */
    :root,
    .woocommerce-cart,
    .woocommerce-checkout,
    .wp-block-woocommerce-cart,
    .wp-block-woocommerce-checkout,
    .wc-block-cart,
    .wc-block-checkout {
        --wc-block-components-button-background-color: #000000 !important;
        --wc-block-components-button-color: #ffffff !important;
        --wc-block-components-button-hover-background-color: #262626 !important;
        --wc-block-components-button-hover-color: #ffffff !important;
    }

    /* Cart "Proceed to Checkout" & Checkout "Place Order" buttons */
    .woocommerce-cart .checkout-button,
    .woocommerce-cart .wc-proceed-to-checkout a,
    .woocommerce-cart .wc-proceed-to-checkout button,
    .woocommerce .cart-collaterals .cart_totals .checkout-button,
    .woocommerce .cart-collaterals .checkout-button,
    a.checkout-button,
    button.checkout-button,
    .wc-block-cart__submit-button,
    .wc-block-cart__submit a,
    .wc-block-cart__submit button,
    .wc-block-cart__submit-container .wc-block-cart__submit-button,
    .wp-block-woocommerce-cart .wc-block-cart__submit-button,
    .wp-block-woocommerce-cart .wc-block-components-checkout-place-order-button,
    .wp-block-woocommerce-cart .wc-block-components-button:not(.is-link),
    .wc-block-cart .wc-block-components-button:not(.is-link),
    #place_order,
    button#place_order,
    input#place_order,
    .woocommerce-checkout #payment #place_order,
    .woocommerce-checkout button#place_order,
    .woocommerce-checkout #place_order,
    .woocommerce-checkout .place-order button,
    .woocommerce-checkout .place-order input[type="submit"],
    .wc-block-components-checkout-place-order-button,
    .wc-block-checkout__actions .wc-block-components-checkout-place-order-button,
    .wc-block-checkout__actions button,
    .wc-block-checkout__actions_row button,
    .wp-block-woocommerce-checkout .wc-block-components-checkout-place-order-button,
    .wp-block-woocommerce-checkout .wc-block-components-button:not(.is-link),
    .wc-block-checkout .wc-block-components-checkout-place-order-button,
    .wc-block-checkout .wc-block-components-button:not(.is-link) {
        background: #000000 !important;
        background-color: #000000 !important;
        color: #ffffff !important;
        border: 1px solid #000000 !important;
        border-color: #000000 !important;
        outline: none !important;
        box-shadow: none !important;
    }

    /* Inner text & spans */
    .woocommerce-cart .checkout-button *,
    .woocommerce-cart .wc-proceed-to-checkout a *,
    .woocommerce-cart .wc-proceed-to-checkout button *,
    .wc-block-cart__submit-button *,
    .wc-block-cart__submit *,
    .wc-block-components-checkout-place-order-button *,
    .wc-block-checkout__actions button *,
    #place_order *,
    .woocommerce-checkout #payment #place_order * {
        color: #ffffff !important;
    }

    /* Hover state */
    .woocommerce-cart .checkout-button:hover,
    .woocommerce-cart .wc-proceed-to-checkout a:hover,
    .woocommerce-cart .wc-proceed-to-checkout button:hover,
    .woocommerce .cart-collaterals .cart_totals .checkout-button:hover,
    .woocommerce .cart-collaterals .checkout-button:hover,
    a.checkout-button:hover,
    button.checkout-button:hover,
    .wc-block-cart__submit-button:hover,
    .wc-block-cart__submit a:hover,
    .wc-block-cart__submit button:hover,
    .wc-block-cart__submit-container .wc-block-cart__submit-button:hover,
    .wp-block-woocommerce-cart .wc-block-cart__submit-button:hover,
    .wp-block-woocommerce-cart .wc-block-components-checkout-place-order-button:hover,
    .wp-block-woocommerce-cart .wc-block-components-button:not(.is-link):hover,
    .wc-block-cart .wc-block-components-button:not(.is-link):hover,
    #place_order:hover,
    button#place_order:hover,
    input#place_order:hover,
    .woocommerce-checkout #payment #place_order:hover,
    .woocommerce-checkout button#place_order:hover,
    .woocommerce-checkout #place_order:hover,
    .woocommerce-checkout .place-order button:hover,
    .woocommerce-checkout .place-order input[type="submit"]:hover,
    .wc-block-components-checkout-place-order-button:hover,
    .wc-block-checkout__actions .wc-block-components-checkout-place-order-button:hover,
    .wc-block-checkout__actions button:hover,
    .wc-block-checkout__actions_row button:hover,
    .wp-block-woocommerce-checkout .wc-block-components-checkout-place-order-button:hover,
    .wp-block-woocommerce-checkout .wc-block-components-button:not(.is-link):hover,
    .wc-block-checkout .wc-block-components-checkout-place-order-button:hover,
    .wc-block-checkout .wc-block-components-button:not(.is-link):hover {
        background: #262626 !important;
        background-color: #262626 !important;
        color: #ffffff !important;
        border-color: #262626 !important;
    }

    .woocommerce-cart .checkout-button:hover *,
    .wc-block-cart__submit-button:hover *,
    .wc-block-cart__submit *:hover,
    .wc-block-components-checkout-place-order-button:hover *,
    .wc-block-checkout__actions button:hover *,
    #place_order:hover *,
    .woocommerce-checkout #payment #place_order:hover * {
        color: #ffffff !important;
    }

    /* Focus & Active states */
    .woocommerce-cart .checkout-button:focus,
    .woocommerce-cart .checkout-button:active,
    .wc-block-cart__submit-button:focus,
    .wc-block-cart__submit-button:active,
    #place_order:focus,
    #place_order:active,
    .wc-block-components-checkout-place-order-button:focus,
    .wc-block-components-checkout-place-order-button:active {
        background: #000000 !important;
        background-color: #000000 !important;
        color: #ffffff !important;
        border-color: #000000 !important;
    }
    </style>
    <?php
}
add_action('wp_head', 'mazestreetwear_cart_checkout_button_inline_css', 999);

/**
 * Permanently redirect deprecated Lookbook & Archive page URLs to Shop catalog
 */
function mazestreetwear_redirect_deprecated_archive_lookbook()
{
    if (is_admin()) {
        return;
    }

    $request_uri = isset($_SERVER['REQUEST_URI']) ? trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/') : '';
    $deprecated_slugs = array('archive', 'lookbook', 'lookbook-archive', 'archive-lookbook');

    if (in_array(strtolower($request_uri), $deprecated_slugs, true) || (function_exists('is_page') && is_page($deprecated_slugs))) {
        $target_url = function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/shop/');
        wp_safe_redirect($target_url ? $target_url : home_url('/'), 301);
        exit;
    }
}
add_action('template_redirect', 'mazestreetwear_redirect_deprecated_archive_lookbook');

/**
 * Modern Minimalist WooCommerce Pagination Arguments
 * Ensures clean typography arrows and list formatting
 *
 * @param array $args Pagination arguments.
 * @return array
 */
function mazestreetwear_custom_pagination_args($args)
{
    $args = is_array($args) ? $args : array();
    $args['prev_text'] = is_rtl() ? '&#8594;' : '&#8592;';
    $args['next_text'] = is_rtl() ? '&#8592;' : '&#8594;';
    $args['type']      = 'list';
    $args['end_size']  = 2;
    $args['mid_size']  = 2;
    return $args;
}
add_filter('woocommerce_pagination_args', 'mazestreetwear_custom_pagination_args');

/**
 * ============================================================================
 * MAZE ORDER CONFIRMATION & GUEST CHECKOUT ACCESS (PAYU & SESSION HANDLING)
 * ============================================================================
 */

/**
 * 1. Disable strict email verification requirements on the order-received page.
 * Prevents payment gateway redirect loops and false login walls for paying customers.
 */
add_filter('woocommerce_order_email_verification_required', '__return_false', 999);

/**
 * 2. Allow customers (and guests) to view their order on the order-received page
 * if they possess the valid cryptographic order key returned by payment gateways like PayU.
 *
 * @param array $allcaps All capabilities of the current user.
 * @param array $caps Capabilities being checked.
 * @param array $args Arguments passed to current_user_can.
 * @param WP_User $user Current user object.
 * @return array
 */
function mazestreetwear_allow_view_order_with_valid_key($allcaps, $caps, $args, $user)
{
    if (!empty($caps) && in_array('view_order', $caps, true) && isset($args[2])) {
        $order_id = absint($args[2]);
        if ($order_id > 0 && function_exists('wc_get_order')) {
            $order = wc_get_order($order_id);
            if ($order) {
                $order_key = isset($_GET['key']) ? sanitize_text_field(wp_unslash($_GET['key'])) : '';
                if (!empty($order_key) && hash_equals((string) $order->get_order_key(), (string) $order_key)) {
                    $allcaps['view_order'] = true;
                }
            }
        }
    }
    return $allcaps;
}
add_filter('user_has_cap', 'mazestreetwear_allow_view_order_with_valid_key', 999, 4);

/**
 * 3. Auto-login customer upon return from PayU (or external payment gateways)
 * when arriving on the order-received endpoint with a valid order key.
 * This ensures their authenticated session is restored without showing a login prompt.
 */
function mazestreetwear_auto_login_on_order_received()
{
    if (is_admin() || is_user_logged_in()) {
        return;
    }

    if (function_exists('is_checkout') && is_checkout() && function_exists('is_wc_endpoint_url') && is_wc_endpoint_url('order-received')) {
        global $wp;
        $order_id = isset($wp->query_vars['order-received']) ? absint($wp->query_vars['order-received']) : 0;
        if (!$order_id && isset($_GET['order_id'])) {
            $order_id = absint($_GET['order_id']);
        }

        if ($order_id > 0 && function_exists('wc_get_order')) {
            $order = wc_get_order($order_id);
            $order_key = isset($_GET['key']) ? sanitize_text_field(wp_unslash($_GET['key'])) : '';

            if ($order && !empty($order_key) && hash_equals((string) $order->get_order_key(), (string) $order_key)) {
                $customer_id = $order->get_customer_id();
                if ($customer_id > 0 && function_exists('wp_set_current_user') && function_exists('wp_set_auth_cookie')) {
                    wp_set_current_user($customer_id);
                    wp_set_auth_cookie($customer_id, true);
                }
            }
        }
    }
}
add_action('template_redirect', 'mazestreetwear_auto_login_on_order_received', 10);

/**
 * 4. Automatically create an account for guest checkouts if one does not exist,
 * and link the order to the customer. WooCommerce will send them their welcome
 * and password setup link automatically.
 *
 * @param int $order_id
 */
function mazestreetwear_auto_create_account_for_guest($order_id)
{
    if (!$order_id || !function_exists('wc_get_order')) {
        return;
    }

    $order = wc_get_order($order_id);
    if (!$order) {
        return;
    }

    $customer_id = $order->get_customer_id();
    $email = $order->get_billing_email();

    if (empty($email)) {
        return;
    }

    // If order already has a valid user, nothing to create
    if ($customer_id > 0) {
        return;
    }

    // Check if an existing WordPress user has this billing email
    $existing_user = get_user_by('email', $email);
    if ($existing_user) {
        $order->set_customer_id($existing_user->ID);
        $order->save();
        return;
    }

    // Create a new customer account seamlessly in the background
    if (function_exists('wc_create_new_customer')) {
        $first_name = $order->get_billing_first_name();
        $last_name  = $order->get_billing_last_name();
        $username   = function_exists('wc_create_new_customer_username')
            ? wc_create_new_customer_username($email, array('first_name' => $first_name, 'last_name' => $last_name))
            : sanitize_user(current(explode('@', $email)), true);

        $new_customer_id = wc_create_new_customer($email, $username);

        if (!is_wp_error($new_customer_id) && $new_customer_id > 0) {
            wp_update_user(array(
                'ID'         => $new_customer_id,
                'first_name' => $first_name,
                'last_name'  => $last_name,
            ));

            $order->set_customer_id($new_customer_id);
            $order->save();
        }
    }
}
add_action('woocommerce_checkout_order_processed', 'mazestreetwear_auto_create_account_for_guest', 20, 1);

/**
 * 5. Remove redundant default WooCommerce order details table from thankyou hook
 * because our custom thankyou.php template renders the bespoke MAZE editorial receipt.
 * Preserves third-party analytics, Facebook Pixel, and PayU conversion tracking hooks.
 */
function mazestreetwear_clean_thankyou_hooks()
{
    remove_action('woocommerce_thankyou', 'woocommerce_order_details_table', 10);
}
add_action('init', 'mazestreetwear_clean_thankyou_hooks');

/**
 * ============================================================================
 * WOOCOMMERCE MY ACCOUNT CUSTOMIZATIONS
 * ============================================================================
 */

/**
 * 1. Remove 'Downloads' from WooCommerce My Account navigation menu.
 * MAZE exclusively retails physical garments; digital downloads are not applicable.
 *
 * @param array $items Array of account navigation menu endpoints and labels.
 * @return array
 */
function mazestreetwear_remove_my_account_downloads($items)
{
    if (isset($items['downloads'])) {
        unset($items['downloads']);
    }
    return $items;
}
add_filter('woocommerce_account_menu_items', 'mazestreetwear_remove_my_account_downloads', 999);

/**
 * 2. Redirect direct requests to /my-account/downloads/ endpoint to main My Account dashboard.
 */
function mazestreetwear_redirect_my_account_downloads_endpoint()
{
    if (is_admin()) {
        return;
    }

    if (function_exists('is_account_page') && is_account_page() && function_exists('is_wc_endpoint_url') && is_wc_endpoint_url('downloads')) {
        $my_account_url = function_exists('wc_get_page_permalink') ? wc_get_page_permalink('myaccount') : home_url('/my-account/');
        wp_safe_redirect($my_account_url, 301);
        exit;
    }
}
add_action('template_redirect', 'mazestreetwear_redirect_my_account_downloads_endpoint');



