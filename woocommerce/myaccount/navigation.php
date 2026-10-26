<?php
/**
 * My Account navigation - Custom Modern Brutalist UI for MAZE Streetwear
 *
 * This template overrides woocommerce/templates/myaccount/navigation.php.
 *
 * @package MazeStreetwear
 * @version 9.3.0
 */

defined( 'ABSPATH' ) || exit;

$current_user = wp_get_current_user();
$first_char   = $current_user && $current_user->display_name ? mb_substr( $current_user->display_name, 0, 1, 'UTF-8' ) : 'M';
?>

<?php do_action( 'woocommerce_before_account_navigation' ); ?>

<nav class="woocommerce-MyAccount-navigation space-y-6" aria-label="<?php esc_attr_e( 'Account pages', 'woocommerce' ); ?>">

    <!-- Customer Identity Summary Card -->
    <div class="border border-black p-5 bg-white shadow-[3px_3px_0px_0px_rgba(0,0,0,1)]">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 border border-black bg-black text-white font-bebas text-2xl flex items-center justify-center flex-shrink-0 uppercase">
                <?php echo esc_html( strtoupper( $first_char ) ); ?>
            </div>
            <div class="min-w-0 flex-1">
                <span class="block font-mono text-[10px] uppercase tracking-widest text-neutral-500">
                    <?php esc_html_e( 'MAZE Garment Club', 'mazestreetwear' ); ?>
                </span>
                <h3 class="font-bebas text-lg tracking-wide uppercase text-black truncate">
                    <?php echo esc_html( $current_user->display_name ); ?>
                </h3>
                <p class="font-mono text-xs text-neutral-500 truncate" title="<?php echo esc_attr( $current_user->user_email ); ?>">
                    <?php echo esc_html( $current_user->user_email ); ?>
                </p>
            </div>
        </div>
    </div>

    <!-- Navigation Menu Items -->
    <ul class="space-y-2 list-none p-0 m-0">
        <?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : 
            $is_current   = function_exists( 'wc_is_current_account_menu_item' ) ? wc_is_current_account_menu_item( $endpoint ) : false;
            $url          = wc_get_account_endpoint_url( $endpoint );
            $is_logout    = ( 'customer-logout' === $endpoint );
            $link_classes = 'group flex items-center justify-between px-4 py-3.5 border border-black font-bebas text-lg tracking-wider uppercase transition-all duration-150 ' . ( $is_current ? 'bg-black text-white shadow-[3px_3px_0px_0px_rgba(0,0,0,1)]' : 'bg-white text-black hover:bg-neutral-100 hover:translate-x-1' );
        ?>
            <li class="<?php echo esc_attr( wc_get_account_menu_item_classes( $endpoint ) ); ?>">
                <a href="<?php echo esc_url( $url ); ?>"
                   class="<?php echo esc_attr( $link_classes ); ?>">
                    
                    <span class="flex items-center gap-3">
                        <?php if ( 'dashboard' === $endpoint ) : ?>
                            <svg class="w-4 h-4 <?php echo $is_current ? 'text-white' : 'text-neutral-500 group-hover:text-black'; ?>" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                            </svg>
                        <?php elseif ( 'orders' === $endpoint ) : ?>
                            <svg class="w-4 h-4 <?php echo $is_current ? 'text-white' : 'text-neutral-500 group-hover:text-black'; ?>" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                        <?php elseif ( 'edit-address' === $endpoint ) : ?>
                            <svg class="w-4 h-4 <?php echo $is_current ? 'text-white' : 'text-neutral-500 group-hover:text-black'; ?>" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        <?php elseif ( 'payment-methods' === $endpoint ) : ?>
                            <svg class="w-4 h-4 <?php echo $is_current ? 'text-white' : 'text-neutral-500 group-hover:text-black'; ?>" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                            </svg>
                        <?php elseif ( 'edit-account' === $endpoint ) : ?>
                            <svg class="w-4 h-4 <?php echo $is_current ? 'text-white' : 'text-neutral-500 group-hover:text-black'; ?>" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        <?php elseif ( $is_logout ) : ?>
                            <svg class="w-4 h-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                        <?php else : ?>
                            <span class="w-2 h-2 rounded-full <?php echo $is_current ? 'bg-white' : 'bg-black'; ?>"></span>
                        <?php endif; ?>

                        <span class="<?php echo $is_logout ? 'text-red-600 group-hover:text-red-700' : ''; ?>">
                            <?php echo esc_html( $label ); ?>
                        </span>
                    </span>

                    <?php if ( $is_current ) : ?>
                        <span class="w-2 h-2 bg-white rounded-full"></span>
                    <?php else : ?>
                        <span class="font-mono text-xs text-neutral-400 group-hover:text-black">&rarr;</span>
                    <?php endif; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

    <!-- Streetwear Assurance Note -->
    <div class="border border-black p-4 bg-neutral-50 text-xs">
        <span class="block font-mono text-[10px] uppercase tracking-widest text-neutral-500 mb-1">
            <?php esc_html_e( 'Concierge Support', 'mazestreetwear' ); ?>
        </span>
        <p class="text-neutral-700 leading-normal mb-2">
            <?php esc_html_e( 'Questions regarding your drop or shipment dispatch?', 'mazestreetwear' ); ?>
        </p>
        <a href="<?php echo esc_url( home_url( '/contact-us/' ) ); ?>" class="font-bebas text-sm uppercase tracking-wider text-black hover:underline flex items-center gap-1">
            <?php esc_html_e( 'Contact Team', 'mazestreetwear' ); ?> &rarr;
        </a>
    </div>

</nav>

<?php do_action( 'woocommerce_after_account_navigation' ); ?>
