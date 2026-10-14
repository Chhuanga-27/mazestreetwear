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
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="scroll-smooth bg-[#09090b] text-[#f4f4f5]">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class( 'bg-[#09090b] text-[#f4f4f5] font-sans antialiased selection:bg-[#ccff00] selection:text-black min-h-screen flex flex-col' ); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 focus:z-50 focus:px-4 focus:py-2 focus:bg-[#ccff00] focus:text-black focus:font-mono focus:text-xs" href="#primary">
    <?php esc_html_e( 'Skip to content', 'mazestreetwear' ); ?>
</a>

<!-- Top Streetwear Announcement Ticker -->
<aside class="w-full bg-[#111113] border-b border-white/5 py-1.5 px-4 text-center overflow-hidden" aria-label="Announcement">
    <div class="inline-flex items-center space-x-3 text-[11px] font-mono tracking-widest uppercase text-[#a1a1aa]">
        <span class="inline-block w-1.5 h-1.5 rounded-full bg-[#ccff00] animate-pulse" aria-hidden="true"></span>
        <span>MAZE PROTOCOL // NEW DROP LIVE AT MAZESTW.IN</span>
        <span class="text-white/20" aria-hidden="true">&bull;</span>
        <span class="hidden sm:inline">WORLDWIDE SHIPPING AVAILABLE</span>
    </div>
</aside>

<!-- Main Header / Navigation Bar -->
<header id="masthead" class="site-header sticky top-0 z-50 w-full bg-[#09090b]/90 backdrop-blur-md border-b border-white/10 transition-colors duration-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">

            <!-- Left: Brand Logo / Title -->
            <div class="flex-shrink-0 flex items-center">
                <?php if ( has_custom_logo() ) : ?>
                    <div class="site-logo">
                        <?php the_custom_logo(); ?>
                    </div>
                <?php else : ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="group flex items-center space-x-2" rel="home">
                        <span class="text-2xl font-black tracking-tighter uppercase font-sans text-white group-hover:text-[#ccff00] transition-colors duration-200">
                            MAZE<span class="text-[#ccff00] group-hover:text-white transition-colors duration-200">.</span>
                        </span>
                        <span class="hidden md:inline-block px-1.5 py-0.5 text-[9px] font-mono font-medium tracking-widest text-[#a1a1aa] border border-white/10 uppercase group-hover:border-[#ccff00]/40 transition-colors duration-200">
                            mazestw.in
                        </span>
                    </a>
                <?php endif; ?>
            </div>

            <!-- Center: Streetwear Navigation Links -->
            <nav id="site-navigation" class="hidden md:flex items-center space-x-8" aria-label="<?php esc_attr_e( 'Primary Navigation', 'mazestreetwear' ); ?>">
                <?php
                if ( has_nav_menu( 'primary' ) ) :
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'container'      => false,
                        'menu_class'     => 'flex items-center space-x-8 text-xs font-mono tracking-widest uppercase text-[#a1a1aa]',
                        'fallback_cb'    => false,
                        'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    ) );
                else :
                    $shop_page_url = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' );
                ?>
                    <ul class="flex items-center space-x-8 text-xs font-mono tracking-widest uppercase">
                        <li>
                            <a href="<?php echo esc_url( $shop_page_url ); ?>" class="text-[#f4f4f5] hover:text-[#ccff00] transition-colors duration-150 py-2">
                                [ ALL APPAREL ]
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url( add_query_arg( 'filter_cat', 'hoodies', $shop_page_url ) ); ?>" class="text-[#a1a1aa] hover:text-[#ccff00] transition-colors duration-150 py-2">
                                HOODIES
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url( add_query_arg( 'filter_cat', 'tees', $shop_page_url ) ); ?>" class="text-[#a1a1aa] hover:text-[#ccff00] transition-colors duration-150 py-2">
                                TEES
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url( home_url( '/archive/' ) ); ?>" class="text-[#a1a1aa] hover:text-[#ccff00] transition-colors duration-150 py-2">
                                ARCHIVE
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url( home_url( '/contact-us/' ) ); ?>" class="text-[#a1a1aa] hover:text-[#ccff00] transition-colors duration-150 py-2">
                                CONTACT
                            </a>
                        </li>
                    </ul>
                <?php endif; ?>
            </nav>

            <!-- Right: Search, Account & Dynamic Bag Counter -->
            <div class="flex items-center space-x-4 sm:space-x-6">

                <!-- Search Link / Button -->
                <button type="button" id="maze-search-toggle" class="text-[#a1a1aa] hover:text-white transition-colors duration-150 p-1" aria-label="<?php esc_attr_e( 'Search Products', 'mazestreetwear' ); ?>">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"></path>
                    </svg>
                </button>

                <!-- Dynamic Bag Item Counter -->
                <?php
                $cart_url   = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : home_url( '/cart/' );
                $cart_count = ( function_exists( 'WC' ) && WC()->cart ) ? WC()->cart->get_cart_contents_count() : 0;
                ?>
                <a href="<?php echo esc_url( $cart_url ); ?>" class="maze-bag-trigger group relative inline-flex items-center justify-center p-2 text-[#f4f4f5] hover:text-[#ccff00] transition-colors duration-150" aria-label="<?php esc_attr_e( 'View Shopping Bag', 'mazestreetwear' ); ?>">
                    <div class="relative">
                        <!-- Streetwear Bag SVG Icon -->
                        <svg class="w-6 h-6 transform group-hover:scale-105 transition-transform duration-150" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25c-.669 0-1.189-.578-1.119-1.243l1.263-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>

                        <!-- Dynamic Bag Item Counter Badge (replaced via AJAX fragment in functions.php) -->
                        <span class="maze-cart-count absolute -top-1.5 -right-2 inline-flex items-center justify-center min-w-[18px] h-[18px] px-1 text-[10px] font-mono font-bold tracking-tight text-black bg-[#ccff00] rounded-full transition-transform duration-200 <?php echo $cart_count > 0 ? 'scale-100' : 'scale-90 opacity-75'; ?>">
                            <?php echo esc_html( $cart_count ); ?>
                        </span>
                    </div>
                    <span class="hidden lg:inline-block ml-2 text-xs font-mono uppercase tracking-widest text-[#a1a1aa] group-hover:text-white">
                        BAG
                    </span>
                </a>

                <!-- Mobile Menu Button -->
                <button type="button" id="maze-mobile-menu-btn" class="md:hidden inline-flex items-center justify-center p-2 text-[#a1a1aa] hover:text-white focus:outline-none" aria-controls="maze-mobile-menu" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation menu', 'mazestreetwear' ); ?>">
                    <svg id="maze-hamburger-icon" class="w-6 h-6 block" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <svg id="maze-close-icon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

            </div>
        </div>
    </div>

    <!-- Mobile Drawer Navigation -->
    <div id="maze-mobile-menu" class="hidden md:hidden border-t border-white/10 bg-[#09090b] px-4 pt-4 pb-6 space-y-4">
        <?php
        if ( has_nav_menu( 'primary' ) ) :
            wp_nav_menu( array(
                'theme_location' => 'primary',
                'container'      => false,
                'menu_class'     => 'flex flex-col space-y-3 text-sm font-mono tracking-widest uppercase text-[#a1a1aa]',
            ) );
        else :
        ?>
            <div class="flex flex-col space-y-3 text-sm font-mono tracking-widest uppercase">
                <a href="<?php echo esc_url( $shop_page_url ); ?>" class="text-[#f4f4f5] hover:text-[#ccff00] py-1 border-b border-white/5">
                    [ ALL APPAREL ]
                </a>
                <a href="<?php echo esc_url( add_query_arg( 'filter_cat', 'hoodies', $shop_page_url ) ); ?>" class="text-[#a1a1aa] hover:text-[#ccff00] py-1 border-b border-white/5">
                    HOODIES
                </a>
                <a href="<?php echo esc_url( add_query_arg( 'filter_cat', 'tees', $shop_page_url ) ); ?>" class="text-[#a1a1aa] hover:text-[#ccff00] py-1 border-b border-white/5">
                    TEES
                </a>
                <a href="<?php echo esc_url( home_url( '/archive/' ) ); ?>" class="text-[#a1a1aa] hover:text-[#ccff00] py-1 border-b border-white/5">
                    ARCHIVE
                </a>
                <a href="<?php echo esc_url( home_url( '/contact-us/' ) ); ?>" class="text-[#a1a1aa] hover:text-[#ccff00] py-1">
                    CONTACT
                </a>
            </div>
        <?php endif; ?>
    </div>

    <!-- Search Overlay Container -->
    <div id="maze-search-modal" class="hidden border-t border-white/10 bg-[#0c0c0e] px-4 py-4 sm:px-6">
        <div class="max-w-3xl mx-auto">
            <form role="search" method="get" class="relative" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                <input type="hidden" name="post_type" value="product">
                <input type="search" class="w-full bg-[#18181b] border border-white/10 text-white placeholder-[#71717a] font-mono text-sm px-4 py-3 pr-12 focus:outline-none focus:border-[#ccff00] transition-colors" placeholder="<?php echo esc_attr_x( 'SEARCH GARMENT, SKU, OR COLLECTION...', 'placeholder', 'mazestreetwear' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
                <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-[#a1a1aa] hover:text-[#ccff00] font-mono text-xs uppercase tracking-widest">
                    <?php esc_html_e( 'GO', 'mazestreetwear' ); ?>
                </button>
            </form>
        </div>
    </div>
</header>

<div id="content" class="site-content flex-grow">
