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
$cart_count    = ( function_exists( 'WC' ) && WC()->cart ) ? WC()->cart->get_cart_contents_count() : 0;
$masthead_classes = $is_maze_home
    ? 'pointer-events-none py-3 sm:py-4 bg-transparent'
    : 'bg-white/95 backdrop-blur-md border-b border-black py-2.5 sm:py-3.5 shadow-sm';
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="scroll-smooth bg-white text-black">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Preload Primary Didot Regular Web Font for Instant Rendering -->
    <link rel="preload" href="<?php echo esc_url( get_template_directory_uri() . '/assets/fonts/Didot.otf' ); ?>" as="font" type="font/otf" crossorigin>

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
          }
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
<header id="masthead" class="site-header fixed top-0 inset-x-0 z-50 px-3 sm:px-6 transition-all duration-200 <?php echo esc_attr( $masthead_classes ); ?>">
    <div class="max-w-7xl mx-auto <?php echo $is_maze_home ? 'pointer-events-auto' : ''; ?>">

        <!-- Pill Navigation Bar Container -->
        <div class="maze-pill-navbar w-full min-w-0 bg-white/95 backdrop-blur-md border border-black rounded-full px-4 sm:px-6 h-14 sm:h-16 flex items-center justify-between shadow-sm transition-all duration-200">

            <!-- Left: Brand Logo -->
            <div class="flex-shrink-0 flex items-center mr-2 sm:mr-4">
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
            <nav id="site-navigation" class="hidden md:flex items-center space-x-3 lg:space-x-6 xl:space-x-8 flex-shrink min-w-0" aria-label="<?php esc_attr_e( 'Primary Navigation', 'mazestreetwear' ); ?>">
                <?php
                if ( has_nav_menu( 'primary' ) ) :
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'container'      => false,
                        'menu_class'     => 'flex items-center space-x-3 lg:space-x-6 xl:space-x-8 text-sm lg:text-[15px] font-bold font-sans tracking-wider uppercase text-black whitespace-nowrap',
                        'fallback_cb'    => false,
                        'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    ) );
                else :
                    $tops_url        = function_exists( 'mazestreetwear_get_product_cat_url' ) ? mazestreetwear_get_product_cat_url( 'tops' ) : home_url( '/product-category/tops/' );
                    $bottoms_url     = function_exists( 'mazestreetwear_get_product_cat_url' ) ? mazestreetwear_get_product_cat_url( 'bottoms' ) : home_url( '/product-category/bottoms/' );
                    $accessories_url = function_exists( 'mazestreetwear_get_product_cat_url' ) ? mazestreetwear_get_product_cat_url( 'accessories' ) : home_url( '/product-category/accessories/' );
                    $about_url       = function_exists( 'mazestreetwear_get_about_url' ) ? mazestreetwear_get_about_url() : home_url( '/about-us/' );
                    $contact_url     = function_exists( 'mazestreetwear_get_contact_url' ) ? mazestreetwear_get_contact_url() : home_url( '/contact-us/' );
                    $is_about        = is_page( 'about-us' ) || is_page( 'about' ) || ( isset( $_SERVER['REQUEST_URI'] ) && false !== strpos( $_SERVER['REQUEST_URI'], 'about' ) );
                    $is_contact      = is_page( 'contact-us' ) || is_page( 'contact' ) || ( isset( $_SERVER['REQUEST_URI'] ) && false !== strpos( $_SERVER['REQUEST_URI'], 'contact' ) );
                ?>
                    <ul class="flex items-center space-x-3 lg:space-x-6 xl:space-x-8 text-sm lg:text-[15px] font-bold font-sans tracking-wider uppercase text-black whitespace-nowrap">
                        <li>
                            <a href="<?php echo esc_url( $shop_page_url ); ?>" class="hover:text-black hover:underline underline-offset-4 transition-colors duration-150 py-1">
                                <?php esc_html_e( 'Shop All', 'mazestreetwear' ); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url( $tops_url ); ?>" class="hover:text-black hover:underline underline-offset-4 transition-colors duration-150 py-1">
                                <?php esc_html_e( 'Tops', 'mazestreetwear' ); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url( $bottoms_url ); ?>" class="hover:text-black hover:underline underline-offset-4 transition-colors duration-150 py-1">
                                <?php esc_html_e( 'Bottoms', 'mazestreetwear' ); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url( $accessories_url ); ?>" class="hover:text-black hover:underline underline-offset-4 transition-colors duration-150 py-1">
                                <?php esc_html_e( 'Accessories', 'mazestreetwear' ); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url( $about_url ); ?>" class="hover:text-black transition-colors duration-150 py-1 <?php echo $is_about ? 'text-black font-black underline underline-offset-4' : 'hover:underline underline-offset-4'; ?>">
                                <?php esc_html_e( 'About', 'mazestreetwear' ); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url( $contact_url ); ?>" class="hover:text-black transition-colors duration-150 py-1 <?php echo $is_contact ? 'text-black font-black underline underline-offset-4' : 'hover:underline underline-offset-4'; ?>">
                                <?php esc_html_e( 'Contact', 'mazestreetwear' ); ?>
                            </a>
                        </li>
                    </ul>
                <?php endif; ?>
            </nav>

            <!-- Right: Search Pill, Bag & Mobile Menu Toggle -->
            <div class="flex-shrink-0 flex items-center space-x-1.5 sm:space-x-2.5 md:space-x-3.5 ml-2">

                <!-- Embedded Search Pill (Desktop/Tablet) -->
                <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="hidden sm:flex items-center relative">
                    <input type="hidden" name="post_type" value="product">
                    <div class="maze-search-pill relative flex items-center bg-neutral-100 hover:bg-neutral-200/80 focus-within:bg-white focus-within:ring-1 focus-within:ring-black rounded-full px-3.5 py-1.5 transition-all w-32 md:w-36 lg:w-44 border border-black/10 focus-within:border-black">
                        <svg class="w-4 h-4 text-black mr-2 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"></path>
                        </svg>
                        <input type="search" name="s" placeholder="<?php echo esc_attr_x( 'Search', 'placeholder', 'mazestreetwear' ); ?>" value="<?php echo get_search_query(); ?>" class="bg-transparent border-0 outline-none text-sm text-black placeholder-neutral-600 w-full p-0 font-sans font-medium focus:outline-none focus:ring-0">
                    </div>
                </form>

                <!-- Mobile Search Toggle Button (Small screens < sm) -->
                <button type="button" id="maze-mobile-search-toggle" class="sm:hidden text-black hover:opacity-60 transition-opacity p-1.5" aria-label="<?php esc_attr_e( 'Search Products', 'mazestreetwear' ); ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"></path>
                    </svg>
                </button>

                <!-- Shopping Bag Icon with Dynamic Badge -->
                <a href="<?php echo esc_url( $cart_url ); ?>" class="maze-bag-trigger group relative p-1.5 text-black hover:opacity-60 transition-opacity flex items-center justify-center" aria-label="<?php esc_attr_e( 'View Shopping Bag', 'mazestreetwear' ); ?>">
                    <div class="relative flex items-center">
                        <svg class="w-5 h-5 transform group-hover:scale-105 transition-transform duration-150" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25c-.669 0-1.189-.578-1.119-1.243l1.263-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007z" />
                        </svg>
                        <span class="maze-cart-count absolute -top-1.5 -right-2.5 inline-flex items-center justify-center min-w-[18px] h-[18px] px-1 text-[10px] font-mono font-bold tracking-tight text-white bg-black border border-white rounded-full transition-transform duration-200 <?php echo $cart_count > 0 ? 'scale-100' : 'scale-90 opacity-80'; ?>">
                            <?php echo esc_html( $cart_count ); ?>
                        </span>
                    </div>
                </a>

                <!-- Mobile Menu Button (md:hidden) -->
                <button type="button" id="maze-mobile-menu-btn" class="md:hidden inline-flex items-center justify-center p-1.5 text-black hover:opacity-60 focus:outline-none ml-0.5" aria-controls="maze-mobile-menu" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation menu', 'mazestreetwear' ); ?>">
                    <svg id="maze-hamburger-icon" class="w-6 h-6 block" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <svg id="maze-close-icon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

            </div>
        </div>

        <!-- Mobile Floating Dropdown Menu -->
        <div id="maze-mobile-menu" class="maze-mobile-dropdown hidden md:hidden mt-2 bg-white/98 backdrop-blur-md border border-black rounded-2xl p-5 shadow-2xl transition-all duration-200 max-h-[75vh] overflow-y-auto">
            <!-- Mobile Search Form -->
            <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="relative mb-4">
                <input type="hidden" name="post_type" value="product">
                <div class="maze-search-pill relative flex items-center bg-neutral-100 rounded-full px-4 py-3 border border-black/10 focus-within:border-black focus-within:bg-white transition-all">
                    <svg class="w-4 h-4 text-black mr-2.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"></path>
                    </svg>
                    <input type="search" name="s" placeholder="<?php echo esc_attr_x( 'Search products, collections...', 'placeholder', 'mazestreetwear' ); ?>" value="<?php echo get_search_query(); ?>" class="bg-transparent border-0 outline-none text-base text-black placeholder-neutral-600 w-full p-0 font-sans focus:outline-none focus:ring-0">
                </div>
            </form>

            <!-- Navigation Links -->
            <?php
            if ( has_nav_menu( 'primary' ) ) :
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'container'      => false,
                    'menu_class'     => 'flex flex-col space-y-3.5 text-base font-sans font-bold tracking-wider uppercase text-black',
                ) );
            else :
                $tops_url        = function_exists( 'mazestreetwear_get_product_cat_url' ) ? mazestreetwear_get_product_cat_url( 'tops' ) : home_url( '/product-category/tops/' );
                $bottoms_url     = function_exists( 'mazestreetwear_get_product_cat_url' ) ? mazestreetwear_get_product_cat_url( 'bottoms' ) : home_url( '/product-category/bottoms/' );
                $accessories_url = function_exists( 'mazestreetwear_get_product_cat_url' ) ? mazestreetwear_get_product_cat_url( 'accessories' ) : home_url( '/product-category/accessories/' );
                $about_url       = function_exists( 'mazestreetwear_get_about_url' ) ? mazestreetwear_get_about_url() : home_url( '/about-us/' );
                $contact_url     = function_exists( 'mazestreetwear_get_contact_url' ) ? mazestreetwear_get_contact_url() : home_url( '/contact-us/' );
                $is_about        = is_page( 'about-us' ) || is_page( 'about' ) || ( isset( $_SERVER['REQUEST_URI'] ) && false !== strpos( $_SERVER['REQUEST_URI'], 'about' ) );
                $is_contact      = is_page( 'contact-us' ) || is_page( 'contact' ) || ( isset( $_SERVER['REQUEST_URI'] ) && false !== strpos( $_SERVER['REQUEST_URI'], 'contact' ) );
            ?>
                <div class="flex flex-col space-y-2 text-base font-sans font-bold tracking-wider uppercase">
                    <a href="<?php echo esc_url( $shop_page_url ); ?>" class="text-black hover:opacity-60 py-2.5 border-b border-neutral-100 transition-opacity">
                        <?php esc_html_e( 'Shop All', 'mazestreetwear' ); ?>
                    </a>
                    <a href="<?php echo esc_url( $tops_url ); ?>" class="text-black hover:opacity-60 py-2.5 border-b border-neutral-100 transition-opacity">
                        <?php esc_html_e( 'Tops', 'mazestreetwear' ); ?>
                    </a>
                    <a href="<?php echo esc_url( $bottoms_url ); ?>" class="text-black hover:opacity-60 py-2.5 border-b border-neutral-100 transition-opacity">
                        <?php esc_html_e( 'Bottoms', 'mazestreetwear' ); ?>
                    </a>
                    <a href="<?php echo esc_url( $accessories_url ); ?>" class="text-black hover:opacity-60 py-2.5 border-b border-neutral-100 transition-opacity">
                        <?php esc_html_e( 'Accessories', 'mazestreetwear' ); ?>
                    </a>
                    <a href="<?php echo esc_url( $about_url ); ?>" class="text-black hover:opacity-60 py-2.5 border-b border-neutral-100 transition-opacity <?php echo $is_about ? 'font-black underline underline-offset-4' : ''; ?>">
                        <?php esc_html_e( 'About', 'mazestreetwear' ); ?>
                    </a>
                    <a href="<?php echo esc_url( $contact_url ); ?>" class="text-black hover:opacity-60 py-2.5 transition-opacity <?php echo $is_contact ? 'font-black underline underline-offset-4' : ''; ?>">
                        <?php esc_html_e( 'Contact', 'mazestreetwear' ); ?>
                    </a>
                </div>
            <?php endif; ?>

            <!-- Mobile Quick Actions -->
            <div class="pt-4 mt-2 border-t border-neutral-200 text-sm font-mono font-bold tracking-wider uppercase">
                <a href="<?php echo esc_url( $cart_url ); ?>" class="flex items-center justify-between w-full text-black hover:opacity-60 transition-opacity py-2 px-1">
                    <span class="flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25c-.669 0-1.189-.578-1.119-1.243l1.263-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007z" /></svg>
                        <span>SHOPPING BAG</span>
                    </span>
                    <span class="text-xs px-2.5 py-0.5 bg-black text-white rounded-full font-mono font-bold"><?php echo esc_html( $cart_count ); ?></span>
                </a>
            </div>
        </div>

    </div>
</header>

<?php
$maze_content_pt = $is_maze_home ? 'pt-[74px] sm:pt-20' : 'pt-20 sm:pt-24 md:pt-28';
?>
<div id="content" class="site-content flex-grow <?php echo esc_attr( $maze_content_pt ); ?>">
