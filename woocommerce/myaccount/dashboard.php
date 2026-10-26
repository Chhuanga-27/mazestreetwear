<?php
/**
 * My Account Dashboard - Custom Modern Brutalist UI for MAZE Streetwear
 *
 * This template overrides woocommerce/templates/myaccount/dashboard.php.
 *
 * @package MazeStreetwear
 * @version 4.4.0
 */

defined( 'ABSPATH' ) || exit;

/** @var WP_User $current_user */
$user_id = $current_user->ID;

// Fetch customer orders count safely
$orders_count = 0;
if ( function_exists( 'wc_get_orders' ) ) {
    $orders_count = count( wc_get_orders( array(
        'customer_id' => $user_id,
        'limit'       => -1,
        'return'      => 'ids',
    ) ) );
}

$shipping_city = get_user_meta( $user_id, 'shipping_city', true );
if ( empty( $shipping_city ) ) {
    $shipping_city = get_user_meta( $user_id, 'billing_city', true );
}
?>

<div class="maze-account-dashboard space-y-8">

    <?php
    /**
     * My Account dashboard.
     *
     * @since 2.6.0
     */
    do_action( 'woocommerce_account_dashboard' );
    ?>

    <!-- Dashboard Welcome Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-black">
        <div>
            <span class="block font-mono text-xs uppercase tracking-widest text-neutral-500 mb-1">
                <?php esc_html_e( 'Official Client Dashboard', 'mazestreetwear' ); ?>
            </span>
            <h2 class="text-3xl sm:text-4xl font-bebas uppercase tracking-wide text-black">
                <?php
                printf(
                    /* translators: %s: Customer display name */
                    esc_html__( 'Welcome, %s', 'mazestreetwear' ),
                    esc_html( $current_user->display_name )
                );
                ?>
            </h2>
        </div>
        <div class="inline-flex items-center gap-2 self-start sm:self-auto font-mono text-xs text-neutral-500 uppercase tracking-widest px-3 py-1.5 border border-black bg-neutral-50">
            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
            <?php esc_html_e( 'Session Active', 'mazestreetwear' ); ?>
        </div>
    </div>

    <!-- Quick Stat Metrics Grid (3 Columns) -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6">
        
        <!-- Total Orders Stat -->
        <a href="<?php echo esc_url( wc_get_account_endpoint_url( 'orders' ) ); ?>"
           class="group border border-black p-5 bg-white hover:bg-neutral-50 transition-all flex flex-col justify-between">
            <div>
                <span class="block font-mono text-xs uppercase tracking-widest text-neutral-500 mb-1">
                    <?php esc_html_e( 'Garment Orders', 'mazestreetwear' ); ?>
                </span>
                <span class="font-bebas text-4xl text-black">
                    <?php echo esc_html( $orders_count ); ?>
                </span>
            </div>
            <div class="pt-4 mt-2 border-t border-neutral-200 flex items-center justify-between text-xs font-mono uppercase text-neutral-600 group-hover:text-black">
                <span><?php esc_html_e( 'View Archive', 'mazestreetwear' ); ?></span>
                <span class="group-hover:translate-x-1 transition-transform">&rarr;</span>
            </div>
        </a>

        <!-- Shipping Destination Stat -->
        <a href="<?php echo esc_url( wc_get_account_endpoint_url( 'edit-address' ) ); ?>"
           class="group border border-black p-5 bg-white hover:bg-neutral-50 transition-all flex flex-col justify-between">
            <div>
                <span class="block font-mono text-xs uppercase tracking-widest text-neutral-500 mb-1">
                    <?php esc_html_e( 'Delivery Destination', 'mazestreetwear' ); ?>
                </span>
                <span class="font-bebas text-2xl sm:text-3xl text-black truncate block">
                    <?php echo ! empty( $shipping_city ) ? esc_html( strtoupper( $shipping_city ) ) : esc_html__( 'NOT CONFIGURED', 'mazestreetwear' ); ?>
                </span>
            </div>
            <div class="pt-4 mt-2 border-t border-neutral-200 flex items-center justify-between text-xs font-mono uppercase text-neutral-600 group-hover:text-black">
                <span><?php esc_html_e( 'Manage Address', 'mazestreetwear' ); ?></span>
                <span class="group-hover:translate-x-1 transition-transform">&rarr;</span>
            </div>
        </a>

        <!-- Account Security Stat -->
        <a href="<?php echo esc_url( wc_get_account_endpoint_url( 'edit-account' ) ); ?>"
           class="group border border-black p-5 bg-white hover:bg-neutral-50 transition-all flex flex-col justify-between">
            <div>
                <span class="block font-mono text-xs uppercase tracking-widest text-neutral-500 mb-1">
                    <?php esc_html_e( 'Security & Profile', 'mazestreetwear' ); ?>
                </span>
                <span class="font-bebas text-2xl sm:text-3xl text-black">
                    <?php esc_html_e( 'VERIFIED ACCOUNT', 'mazestreetwear' ); ?>
                </span>
            </div>
            <div class="pt-4 mt-2 border-t border-neutral-200 flex items-center justify-between text-xs font-mono uppercase text-neutral-600 group-hover:text-black">
                <span><?php esc_html_e( 'Update Password', 'mazestreetwear' ); ?></span>
                <span class="group-hover:translate-x-1 transition-transform">&rarr;</span>
            </div>
        </a>

    </div>

    <!-- Editorial Overview Cards -->
    <div class="space-y-4">
        <h3 class="font-bebas text-2xl tracking-wide uppercase text-black">
            <?php esc_html_e( 'Client Management Suite', 'mazestreetwear' ); ?>
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Orders Card -->
            <div class="border border-black p-6 bg-white flex flex-col justify-between">
                <div>
                    <span class="font-mono text-xs uppercase tracking-widest text-neutral-500 block mb-2">01 // DROPS</span>
                    <h4 class="font-bebas text-2xl uppercase tracking-wide text-black mb-2">
                        <?php esc_html_e( 'Order History', 'mazestreetwear' ); ?>
                    </h4>
                    <p class="text-sm text-neutral-700 leading-relaxed mb-6">
                        <?php esc_html_e( 'Review past acquisitions, track active parcel dispatches, and download official streetwear receipts.', 'mazestreetwear' ); ?>
                    </p>
                </div>
                <a href="<?php echo esc_url( wc_get_account_endpoint_url( 'orders' ) ); ?>"
                   class="inline-flex items-center justify-center bg-black text-white px-6 py-3 font-bebas text-base uppercase tracking-wider hover:bg-neutral-800 transition-colors">
                    <?php esc_html_e( 'View Orders', 'mazestreetwear' ); ?> &rarr;
                </a>
            </div>

            <!-- Addresses Card -->
            <div class="border border-black p-6 bg-white flex flex-col justify-between">
                <div>
                    <span class="font-mono text-xs uppercase tracking-widest text-neutral-500 block mb-2">02 // DISPATCH</span>
                    <h4 class="font-bebas text-2xl uppercase tracking-wide text-black mb-2">
                        <?php esc_html_e( 'Saved Addresses', 'mazestreetwear' ); ?>
                    </h4>
                    <p class="text-sm text-neutral-700 leading-relaxed mb-6">
                        <?php esc_html_e( 'Configure your primary shipping and billing addresses for rapid, frictionless 1-click checkout.', 'mazestreetwear' ); ?>
                    </p>
                </div>
                <a href="<?php echo esc_url( wc_get_account_endpoint_url( 'edit-address' ) ); ?>"
                   class="inline-flex items-center justify-center border border-black bg-white text-black px-6 py-3 font-bebas text-base uppercase tracking-wider hover:bg-neutral-100 transition-colors">
                    <?php esc_html_e( 'Edit Addresses', 'mazestreetwear' ); ?> &rarr;
                </a>
            </div>

            <!-- Account Details Card -->
            <div class="border border-black p-6 bg-white flex flex-col justify-between">
                <div>
                    <span class="font-mono text-xs uppercase tracking-widest text-neutral-500 block mb-2">03 // ACCESS</span>
                    <h4 class="font-bebas text-2xl uppercase tracking-wide text-black mb-2">
                        <?php esc_html_e( 'Profile & Security', 'mazestreetwear' ); ?>
                    </h4>
                    <p class="text-sm text-neutral-700 leading-relaxed mb-6">
                        <?php esc_html_e( 'Update your display name, communication email address, and confidential account password.', 'mazestreetwear' ); ?>
                    </p>
                </div>
                <a href="<?php echo esc_url( wc_get_account_endpoint_url( 'edit-account' ) ); ?>"
                   class="inline-flex items-center justify-center border border-black bg-white text-black px-6 py-3 font-bebas text-base uppercase tracking-wider hover:bg-neutral-100 transition-colors">
                    <?php esc_html_e( 'Security Settings', 'mazestreetwear' ); ?> &rarr;
                </a>
            </div>
        </div>
    </div>

    <!-- Brand Commitment Strip -->
    <div class="border border-black p-6 bg-neutral-50 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <span class="font-mono text-[10px] uppercase tracking-widest text-neutral-500 block mb-1">
                <?php esc_html_e( 'MAZE Standard', 'mazestreetwear' ); ?>
            </span>
            <h4 class="font-bebas text-xl uppercase tracking-wide text-black">
                <?php esc_html_e( '100% Authentic Indian Streetwear // Express Dispatched', 'mazestreetwear' ); ?>
            </h4>
        </div>
        <a href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>"
           class="inline-flex items-center justify-center bg-black text-white px-6 py-2.5 font-bebas text-base uppercase tracking-wider hover:bg-neutral-800 transition-colors">
            <?php esc_html_e( 'Explore Latest Drop', 'mazestreetwear' ); ?> &rarr;
        </a>
    </div>

    <?php
    /**
     * Deprecated actions for backwards compatibility.
     */
    do_action( 'woocommerce_before_my_account' );
    do_action( 'woocommerce_after_my_account' );
    ?>

</div>
