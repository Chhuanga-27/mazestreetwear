<?php
/**
 * The Header for Maze Streetwear Theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package MazeStreetwear
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$is_maze_home  = is_front_page() || is_page_template( 'template-homepage.php' );
$shop_page_url = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' );
$cart_url      = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : home_url( '/cart/' );
$account_url   = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'myaccount' ) : home_url( '/my-account/' );
$cart_count    = function_exists( 'mazestreetwear_get_cart_count' ) ? mazestreetwear_get_cart_count() : ( ( function_exists( 'WC' ) && WC()->cart ) ? WC()->cart->get_cart_contents_count() : 0 );
$is_cart_empty = ( $cart_count <= 0 );
$is_single_product = function_exists( 'is_product' ) && is_product();
$masthead_classes = $is_maze_home
    ? 'pointer-events-none py-3 sm:py-4 bg-transparent'
    : ( $is_single_product
        ? 'bg-white/95 backdrop-blur-md py-2.5 sm:py-3.5 border-b-0 shadow-none'
        : 'bg-white/95 backdrop-blur-md border-b border-black py-2.5 sm:py-3.5 shadow-sm' );
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="scroll-smooth bg-white text-black">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google Fonts Preconnect & Stylesheet: Outfit & Bebas Neue -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;500;600;700;800;900&display=swap">

    <?php if ( $is_maze_home ) : ?>
    <!-- Preload High-Definition Hero Bento Banner -->
    <link rel="preload" as="image" href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/hero.jpg' ); ?>" fetchpriority="high">
    <?php endif; ?>

    <!-- Favicon & Site Icons (Multi-size ICO, High-res PNG, Apple Touch & Manifest) -->
    <link rel="shortcut icon" href="<?php echo esc_url( get_template_directory_uri() . '/favicon.ico' ); ?>" type="image/x-icon">
    <link rel="icon" href="<?php echo esc_url( get_template_directory_uri() . '/favicon.ico' ); ?>" type="image/x-icon">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/favicon-16x16.png' ); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/favicon-32x32.png' ); ?>">
    <!-- Google Search Favicon Specifications (Multiples of 48px square) -->
    <link rel="icon" type="image/png" sizes="48x48" href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/favicon-48x48.png' ); ?>">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/favicon-96x96.png' ); ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/apple-touch-icon.png' ); ?>">
    <link rel="manifest" href="<?php echo esc_url( get_template_directory_uri() . '/site.webmanifest' ); ?>">
    <meta name="theme-color" content="#000000">
    <meta name="apple-mobile-web-app-title" content="MAZE">
    <meta name="application-name" content="Maze Streetwear">

    <?php
    $maze_current_url = home_url( add_query_arg( array(), $GLOBALS['wp']->request ?? '' ) );
    $maze_page_title  = wp_get_document_title();
    $maze_meta_desc   = get_bloginfo( 'description' ) ? get_bloginfo( 'description' ) : 'Official online store of Maze Streetwear — Contemporary oversized cuts, heavy hoodies, bottoms, and brutalist apparel.';
    $maze_logo_url    = get_template_directory_uri() . '/assets/images/maze_logo.png';
    $maze_og_img      = get_template_directory_uri() . '/assets/images/og-image.png';
    ?>

    <!-- Search Engine & Social Media Sharing (Google, WhatsApp, Twitter/X, Instagram) -->
    <meta property="og:site_name" content="Maze Streetwear">
    <meta property="og:type" content="<?php echo is_singular( 'product' ) ? 'product' : ( is_singular() ? 'article' : 'website' ); ?>">
    <meta property="og:title" content="<?php echo esc_attr( $maze_page_title ); ?>">
    <meta property="og:description" content="<?php echo esc_attr( $maze_meta_desc ); ?>">
    <meta property="og:url" content="<?php echo esc_url( $maze_current_url ); ?>">
    <meta property="og:image" content="<?php echo esc_url( $maze_og_img ); ?>">
    <meta property="og:image:secure_url" content="<?php echo esc_url( $maze_og_img ); ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:alt" content="Maze Streetwear Brand Emblem">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo esc_attr( $maze_page_title ); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr( $maze_meta_desc ); ?>">
    <meta name="twitter:image" content="<?php echo esc_url( $maze_og_img ); ?>">

    <!-- Google Search Structured Data (Site Name, Brand Identity & Official Logo) -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@graph": [
        {
          "@type": "WebSite",
          "@id": "<?php echo esc_url( home_url( '/#website' ) ); ?>",
          "url": "<?php echo esc_url( home_url( '/' ) ); ?>",
          "name": "Maze Streetwear",
          "alternateName": ["MAZE", "mazestw.in", "MAZE STREETWEAR", "Maze Clothing"],
          "description": "<?php echo esc_js( $maze_meta_desc ); ?>",
          "publisher": {
            "@id": "<?php echo esc_url( home_url( '/#organization' ) ); ?>"
          },
          "potentialAction": {
            "@type": "SearchAction",
            "target": {
              "@type": "EntryPoint",
              "urlTemplate": "<?php echo esc_url( home_url( '/?s={search_term_string}' ) ); ?>"
            },
            "query-input": "required name=search_term_string"
          }
        },
        {
          "@type": "ClothingStore",
          "@id": "<?php echo esc_url( home_url( '/#organization' ) ); ?>",
          "name": "Maze Streetwear",
          "alternateName": ["MAZE", "mazestw.in"],
          "url": "<?php echo esc_url( home_url( '/' ) ); ?>",
          "logo": {
            "@type": "ImageObject",
            "@id": "<?php echo esc_url( home_url( '/#logo' ) ); ?>",
            "url": "<?php echo esc_url( $maze_logo_url ); ?>",
            "contentUrl": "<?php echo esc_url( $maze_logo_url ); ?>",
            "caption": "Maze Streetwear Official Brand Logo",
            "inLanguage": "en-US",
            "width": 1524,
            "height": 168
          },
          "image": "<?php echo esc_url( $maze_og_img ); ?>",
          "description": "Contemporary streetwear brand offering oversized tees, heavy hoodies, bottoms, and brutalist luxury apparel.",
          "telephone": "+918787324795",
          "email": "enquiries@mazestw.in",
          "priceRange": "₹₹",
          "address": {
            "@type": "PostalAddress",
            "streetAddress": "Bungkawn Vengthar, A-25",
            "addressLocality": "Aizawl",
            "addressRegion": "Mizoram",
            "postalCode": "796005",
            "addressCountry": "IN"
          },
          "sameAs": [
            "https://www.instagram.com/maze.stw?utm_source=ig_web_button_share_sheet&exln=ZDNlZDc0MzIxNw=="
          ]
        }
      ]
    }
    </script>

    <?php wp_head(); ?>
</head>

<body <?php body_class( 'bg-white text-black font-sans antialiased selection:bg-black selection:text-white min-h-screen flex flex-col' ); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 focus:z-50 focus:px-4 focus:py-2 focus:bg-black focus:text-white focus:font-mono focus:text-xs" href="#primary">
    <?php esc_html_e( 'Skip to content', 'mazestreetwear' ); ?>
</a>

<!-- Header / Navigation Bar -->
<!-- On homepage: Transparent floating pill header over the hero banner -->
<!-- On other pages: Full-width solid white backdrop with 1px border so content never bleeds through -->
<header id="masthead" class="site-header fixed top-0 inset-x-0 z-50 px-2 sm:px-6 transition-all duration-200 <?php echo esc_attr( $masthead_classes ); ?>">
    <div class="max-w-7xl mx-auto <?php echo $is_maze_home ? 'pointer-events-auto' : ''; ?>">

        <!-- Pill Navigation Bar Container -->
        <div class="maze-pill-navbar w-full min-w-0 bg-white/95 backdrop-blur-md border-0 rounded-full px-2.5 sm:px-6 h-14 sm:h-16 flex items-center justify-between shadow-none transition-all duration-200">

            <!-- Left: Brand Logo -->
            <div class="flex-shrink-0 flex items-center mr-1.5 sm:mr-4">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="maze-brand-logo group flex items-center select-none flex-shrink-0" rel="home" aria-label="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
                    <img 
                        id="masthead-logo"
                        src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/maze_logo.png' ); ?>" 
                        alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" 
                        width="160"
                        height="22"
                        class="maze-logo-img h-3.5 sm:h-[18px] md:h-[22px] w-auto max-w-[115px] sm:max-w-[160px] md:max-w-[180px] object-contain transition-opacity duration-150 group-hover:opacity-75"
                    />
                </a>
            </div>

            <!-- Center: Navigation Menu Links -->
            <nav id="site-navigation" class="hidden md:flex items-center justify-center flex-1 mx-2 lg:mx-4 min-w-0" aria-label="<?php esc_attr_e( 'Primary Navigation', 'mazestreetwear' ); ?>">
                <?php
                if ( has_nav_menu( 'primary' ) ) :
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'container'      => false,
                        'menu_class'     => 'flex items-center justify-center gap-3.5 lg:gap-6 xl:gap-8 text-xs lg:text-[13px] xl:text-sm font-bold font-outfit uppercase tracking-wider text-black whitespace-nowrap',
                        'fallback_cb'    => false,
                        'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    ) );
                else :
                    $tops_url        = function_exists( 'mazestreetwear_get_product_cat_url' ) ? mazestreetwear_get_product_cat_url( 'tops' ) : home_url( '/product-category/tops/' );
                    $bottoms_url     = function_exists( 'mazestreetwear_get_product_cat_url' ) ? mazestreetwear_get_product_cat_url( 'bottoms' ) : home_url( '/product-category/bottoms/' );
                    $accessories_url = function_exists( 'mazestreetwear_get_product_cat_url' ) ? mazestreetwear_get_product_cat_url( 'accessories' ) : home_url( '/product-category/accessories/' );
                ?>
                    <ul class="flex items-center justify-center gap-3.5 lg:gap-6 xl:gap-8 text-xs lg:text-[13px] xl:text-sm font-bold font-outfit uppercase tracking-wider text-black whitespace-nowrap">
                        <li>
                            <a href="<?php echo esc_url( $shop_page_url ); ?>" class="maze-nav-link inline-block text-black hover:opacity-60 transition-opacity py-1">
                                <?php esc_html_e( 'SHOP ALL', 'mazestreetwear' ); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url( $tops_url ); ?>" class="maze-nav-link inline-block text-black hover:opacity-60 transition-opacity py-1">
                                <?php esc_html_e( 'TOPS', 'mazestreetwear' ); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url( $bottoms_url ); ?>" class="maze-nav-link inline-block text-black hover:opacity-60 transition-opacity py-1">
                                <?php esc_html_e( 'BOTTOMS', 'mazestreetwear' ); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url( $accessories_url ); ?>" class="maze-nav-link inline-block text-black hover:opacity-60 transition-opacity py-1">
                                <?php esc_html_e( 'ACCESSORIES', 'mazestreetwear' ); ?>
                            </a>
                        </li>
                    </ul>
                <?php endif; ?>
            </nav>

            <!-- Right: Search Pill, Bag & Mobile Menu Toggle -->
            <div class="flex-shrink-0 flex items-center space-x-1 sm:space-x-2.5 md:space-x-3.5 ml-1 sm:ml-2">

                <!-- Embedded Search Pill (Desktop/Tablet) -->
                <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="hidden sm:flex items-center relative">
                    <input type="hidden" name="post_type" value="product">
                    <div class="maze-search-pill relative flex items-center bg-neutral-100 hover:bg-neutral-200/80 focus-within:bg-white focus-within:ring-1 focus-within:ring-black rounded-full px-3.5 py-1.5 transition-all w-32 md:w-36 lg:w-44 border-0">
                        <svg class="w-4 h-4 text-black mr-2 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"></path>
                        </svg>
                        <input type="search" name="s" placeholder="<?php echo esc_attr_x( 'Search', 'placeholder', 'mazestreetwear' ); ?>" value="<?php echo get_search_query(); ?>" class="bg-transparent border-0 outline-none text-sm text-black placeholder-neutral-600 w-full p-0 font-outfit font-medium focus:outline-none focus:ring-0">
                    </div>
                </form>

                <!-- Mobile Search Toggle Button (Small screens < sm) -->
                <button type="button" id="maze-mobile-search-toggle" class="sm:hidden text-black hover:opacity-60 transition-opacity p-1.5" aria-label="<?php esc_attr_e( 'Search Products', 'mazestreetwear' ); ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"></path>
                    </svg>
                </button>

                <!-- My Account Icon Tab -->
                <a href="<?php echo esc_url( $account_url ); ?>" class="maze-account-trigger group p-1.5 text-black hover:opacity-60 transition-opacity flex items-center justify-center" aria-label="<?php esc_attr_e( 'My Account', 'mazestreetwear' ); ?>" title="<?php esc_attr_e( 'My Account', 'mazestreetwear' ); ?>">
                    <svg class="w-5 h-5 transform group-hover:scale-105 transition-transform duration-150" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                </a>

                <!-- Shopping Bag Icon with Dynamic Badge -->
                <a href="<?php echo esc_url( $cart_url ); ?>" class="maze-bag-trigger group relative p-1.5 text-black hover:opacity-60 transition-opacity flex items-center justify-center" aria-label="<?php esc_attr_e( 'View Shopping Bag', 'mazestreetwear' ); ?>">
                    <div class="relative flex items-center">
                        <svg class="w-5 h-5 transform group-hover:scale-105 transition-transform duration-150" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25c-.669 0-1.189-.578-1.119-1.243l1.263-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007z" />
                        </svg>
                        <span class="maze-cart-count absolute -top-1.5 -right-2.5 inline-flex items-center justify-center min-w-[18px] h-[18px] px-1 text-[10px] font-mono font-bold tracking-tight text-white bg-black border border-white rounded-full transition-all duration-200 <?php echo $is_cart_empty ? 'hidden' : 'scale-100'; ?>" data-count="<?php echo esc_attr( $cart_count ); ?>" <?php echo $is_cart_empty ? 'style="display:none;"' : ''; ?>>
                            <?php echo esc_html( $cart_count ); ?>
                        </span>
                    </div>
                </a>

                <!-- Mobile Menu Button (md:hidden) -->
                <button type="button" id="maze-mobile-menu-btn" class="md:hidden inline-flex items-center justify-center p-1 sm:p-1.5 text-black focus:outline-none select-none transition-transform" aria-controls="maze-mobile-menu" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation menu', 'mazestreetwear' ); ?>">
                    <svg id="maze-hamburger-icon" class="maze-hamburger-icon w-6 h-6 text-black" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2.25" stroke-linecap="round" aria-hidden="true">
                        <line x1="3.5" y1="8" x2="20.5" y2="8"></line>
                        <line x1="3.5" y1="16" x2="20.5" y2="16"></line>
                    </svg>
                    <svg id="maze-close-icon" class="maze-close-icon w-6 h-6 text-black" style="display:none;" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <line x1="5" y1="5" x2="19" y2="19"></line>
                        <line x1="5" y1="19" x2="19" y2="5"></line>
                    </svg>
                </button>

            </div>
        </div>

        <!-- Discrete Mobile Search Bar Dropdown (Toggled by mobile search button in header pill) -->
        <div id="maze-mobile-search-bar" class="hidden sm:hidden mt-2 bg-white <?php echo $is_maze_home ? 'border-0' : 'border border-black'; ?> rounded-2xl p-3 shadow-xl transition-all duration-200">
            <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="relative flex items-center">
                <input type="hidden" name="post_type" value="product">
                <div class="relative flex items-center w-full bg-neutral-100 rounded-full px-4 py-2.5 border border-black/15 focus-within:border-black focus-within:bg-white transition-all">
                    <svg class="w-4 h-4 text-black mr-2.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"></path>
                    </svg>
                    <input type="search" name="s" placeholder="<?php echo esc_attr_x( 'Search products, collections...', 'placeholder', 'mazestreetwear' ); ?>" value="<?php echo get_search_query(); ?>" class="bg-transparent border-0 outline-none text-sm text-black placeholder-neutral-500 w-full p-0 font-outfit focus:outline-none focus:ring-0">
                </div>
            </form>
        </div>

        <!-- Mobile Mega Menu Drawer (Solid Pure White Background & Black Text) -->
        <div id="maze-mobile-menu" class="maze-mobile-dropdown hidden md:hidden mt-2 bg-white <?php echo $is_maze_home ? 'border-0' : 'border border-black'; ?> rounded-2xl sm:rounded-3xl p-6 sm:p-8 shadow-2xl transition-all duration-200 max-h-[82vh] overflow-y-auto">
            
            <?php
            // Prepare Mega Menu Category and Policy URLs
            $tops_url        = function_exists( 'mazestreetwear_get_product_cat_url' ) ? mazestreetwear_get_product_cat_url( 'tops' ) : home_url( '/product-category/tops/' );
            $bottoms_url     = function_exists( 'mazestreetwear_get_product_cat_url' ) ? mazestreetwear_get_product_cat_url( 'bottoms' ) : home_url( '/product-category/bottoms/' );
            $accessories_url = function_exists( 'mazestreetwear_get_product_cat_url' ) ? mazestreetwear_get_product_cat_url( 'accessories' ) : home_url( '/product-category/accessories/' );
            $about_url       = function_exists( 'mazestreetwear_get_about_url' ) ? mazestreetwear_get_about_url() : home_url( '/about-us/' );
            $contact_url     = function_exists( 'mazestreetwear_get_contact_url' ) ? mazestreetwear_get_contact_url() : home_url( '/contact-us/' );
            $refund_url      = function_exists( 'mazestreetwear_get_refund_policy_url' ) ? mazestreetwear_get_refund_policy_url() : home_url( '/refund-policy/' );
            $terms_url       = function_exists( 'mazestreetwear_get_terms_url' ) ? mazestreetwear_get_terms_url() : home_url( '/terms-and-conditions/' );
            $shipping_url    = function_exists( 'mazestreetwear_get_shipping_policy_url' ) ? mazestreetwear_get_shipping_policy_url() : home_url( '/shipping-policy/' );
            $privacy_url     = function_exists( 'mazestreetwear_get_privacy_policy_url' ) ? mazestreetwear_get_privacy_policy_url() : home_url( '/privacy-policy/' );
            $account_url     = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'myaccount' ) : home_url( '/my-account/' );
            $instagram_url   = 'https://www.instagram.com/maze.stw?utm_source=ig_web_button_share_sheet&exln=ZDNlZDc0MzIxNw==';
            $contact_email   = 'enquiries@mazestw.in';
            $is_about        = is_page( 'about-us' ) || is_page( 'about' ) || ( isset( $_SERVER['REQUEST_URI'] ) && false !== strpos( $_SERVER['REQUEST_URI'], 'about' ) );
            $is_contact      = is_page( 'contact-us' ) || is_page( 'contact' ) || ( isset( $_SERVER['REQUEST_URI'] ) && false !== strpos( $_SERVER['REQUEST_URI'], 'contact' ) );
            ?>

            <!-- Primary Navigation Categories -->
            <div class="flex flex-col space-y-2 text-2xl sm:text-3xl font-bold font-outfit uppercase tracking-tight text-black">
                <a href="<?php echo esc_url( $shop_page_url ); ?>" class="maze-nav-link inline-block text-black hover:opacity-60 transition-opacity py-1">
                    <?php esc_html_e( 'SHOP ALL', 'mazestreetwear' ); ?>
                </a>
                <a href="<?php echo esc_url( $tops_url ); ?>" class="maze-nav-link inline-block text-black hover:opacity-60 transition-opacity py-1">
                    <?php esc_html_e( 'TOPS', 'mazestreetwear' ); ?>
                </a>
                <a href="<?php echo esc_url( $bottoms_url ); ?>" class="maze-nav-link inline-block text-black hover:opacity-60 transition-opacity py-1">
                    <?php esc_html_e( 'BOTTOMS', 'mazestreetwear' ); ?>
                </a>
                <a href="<?php echo esc_url( $accessories_url ); ?>" class="maze-nav-link inline-block text-black hover:opacity-60 transition-opacity py-1">
                    <?php esc_html_e( 'ACCESSORIES', 'mazestreetwear' ); ?>
                </a>
            </div>

            <!-- Secondary Brand Pages: About & Contact -->
            <div class="flex flex-col space-y-2 pt-6 text-xl sm:text-2xl font-semibold font-outfit uppercase tracking-tight text-black">
                <a href="<?php echo esc_url( $about_url ); ?>" class="maze-nav-link inline-block text-black hover:opacity-60 transition-opacity py-1 <?php echo $is_about ? 'font-bold underline underline-offset-4' : ''; ?>">
                    <?php esc_html_e( 'ABOUT', 'mazestreetwear' ); ?>
                </a>
                <a href="<?php echo esc_url( $contact_url ); ?>" class="maze-nav-link inline-block text-black hover:opacity-60 transition-opacity py-1 <?php echo $is_contact ? 'font-bold underline underline-offset-4' : ''; ?>">
                    <?php esc_html_e( 'CONTACT', 'mazestreetwear' ); ?>
                </a>
            </div>

            <!-- Utility & Direct Desk Links -->
            <div class="pt-6 mt-6 border-t border-neutral-200 flex flex-col space-y-4">
                <!-- Log In / My Account Link -->
                <div>
                    <?php if ( is_user_logged_in() ) : ?>
                        <a href="<?php echo esc_url( $account_url ); ?>" class="inline-flex items-center space-x-2.5 text-base sm:text-lg font-bold font-sans text-black hover:opacity-60 transition-opacity">
                            <svg class="w-5 h-5 text-black flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                            <span><?php esc_html_e( 'My Account', 'mazestreetwear' ); ?></span>
                        </a>
                    <?php else : ?>
                        <a href="<?php echo esc_url( $account_url ); ?>" class="inline-flex items-center space-x-2.5 text-base sm:text-lg font-bold font-sans text-black hover:opacity-60 transition-opacity">
                            <svg class="w-5 h-5 text-black flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                            <span><?php esc_html_e( 'Log in', 'mazestreetwear' ); ?></span>
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Instagram & Email Links -->
                <div class="flex flex-col sm:flex-row sm:items-center gap-3 pt-1">
                    <a href="<?php echo esc_url( $instagram_url ); ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center space-x-2 text-black hover:opacity-60 transition-opacity" aria-label="<?php esc_attr_e( 'MAZE on Instagram', 'mazestreetwear' ); ?>">
                        <svg class="w-5 h-5 text-black flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                        </svg>
                        <span class="text-xs font-mono font-bold uppercase tracking-wider">@maze.stw</span>
                    </a>
                    <a href="mailto:<?php echo esc_attr( $contact_email ); ?>" class="inline-flex items-center space-x-2 text-black hover:opacity-60 transition-opacity" aria-label="<?php esc_attr_e( 'Email MAZE', 'mazestreetwear' ); ?>">
                        <svg class="w-5 h-5 text-black flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                        </svg>
                        <span class="text-xs font-mono font-bold uppercase tracking-wider">enquiries@mazestw.in</span>
                    </a>
                </div>
            </div>

            <!-- Legal / Policy Bar -->
            <div class="pt-6 mt-6 border-t border-neutral-200 flex flex-wrap items-center gap-x-2.5 gap-y-1.5 text-xs sm:text-sm font-medium font-outfit text-neutral-700">
                <a href="<?php echo esc_url( $refund_url ); ?>" class="text-neutral-800 hover:text-black hover:underline transition-colors"><?php esc_html_e( 'Refund policy', 'mazestreetwear' ); ?></a>
                <span class="text-neutral-400 select-none" aria-hidden="true">&bull;</span>
                <a href="<?php echo esc_url( $terms_url ); ?>" class="text-neutral-800 hover:text-black hover:underline transition-colors"><?php esc_html_e( 'Terms of service', 'mazestreetwear' ); ?></a>
                <span class="text-neutral-400 select-none" aria-hidden="true">&bull;</span>
                <a href="<?php echo esc_url( $shipping_url ); ?>" class="text-neutral-800 hover:text-black hover:underline transition-colors"><?php esc_html_e( 'Shipping policy', 'mazestreetwear' ); ?></a>
                <span class="text-neutral-400 select-none" aria-hidden="true">&bull;</span>
                <a href="<?php echo esc_url( $privacy_url ); ?>" class="text-neutral-800 hover:text-black hover:underline transition-colors"><?php esc_html_e( 'Privacy Policy', 'mazestreetwear' ); ?></a>
                <span class="text-neutral-400 select-none" aria-hidden="true">&bull;</span>
                <a href="<?php echo esc_url( $contact_url ); ?>" class="text-neutral-800 hover:text-black hover:underline transition-colors"><?php esc_html_e( 'Contact information', 'mazestreetwear' ); ?></a>
            </div>

        </div>

    </div>
</header>

<?php
$maze_content_pt = $is_maze_home ? 'pt-[74px] sm:pt-20' : 'pt-20 sm:pt-24 md:pt-28';
?>
<div id="content" class="site-content flex-grow <?php echo esc_attr( $maze_content_pt ); ?>">
