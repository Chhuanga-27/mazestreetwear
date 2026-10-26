<?php
/**
 * View Order - Custom Modern Brutalist UI for MAZE Streetwear
 *
 * This template overrides woocommerce/templates/myaccount/view-order.php.
 *
 * @package MazeStreetwear
 * @version 3.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * @var WC_Order $order
 * @var int      $order_id
 */
$order_id = isset( $order_id ) ? (int) $order_id : ( isset( $order ) && $order instanceof WC_Order ? $order->get_id() : 0 );
$order    = isset( $order ) && $order instanceof WC_Order ? $order : wc_get_order( $order_id );

if ( ! $order ) {
    return;
}

$status      = $order->get_status();
$status_name = wc_get_order_status_name( $status );
?>

<div class="maze-account-view-order space-y-6">

    <!-- Return Link -->
    <div>
        <a href="<?php echo esc_url( wc_get_account_endpoint_url( 'orders' ) ); ?>"
           class="inline-flex items-center gap-2 font-mono text-xs uppercase tracking-wider text-neutral-600 hover:text-black transition-colors">
            &larr; <?php esc_html_e( 'Back to Orders Archive', 'mazestreetwear' ); ?>
        </a>
    </div>

    <!-- Order Receipt Header Strip -->
    <div class="border border-black p-6 bg-white flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <span class="block font-mono text-xs uppercase tracking-widest text-neutral-500 mb-1">
                <?php esc_html_e( 'Official Order Receipt', 'mazestreetwear' ); ?>
            </span>
            <h2 class="text-3xl sm:text-4xl font-bebas uppercase tracking-wide text-black">
                <?php
                /* translators: %s: Order number */
                printf( esc_html__( 'Order #%s', 'mazestreetwear' ), esc_html( $order->get_order_number() ) );
                ?>
            </h2>
        </div>

        <div class="flex flex-wrap items-center gap-3">
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-mono uppercase tracking-wider border border-black bg-black text-white">
                <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                <?php echo esc_html( $status_name ); ?>
            </span>
            <span class="font-mono text-xs text-neutral-500 uppercase tracking-widest px-3 py-1.5 border border-black bg-neutral-50">
                <?php echo esc_html( wc_format_datetime( $order->get_date_created(), 'M d, Y' ) ); ?>
            </span>
        </div>
    </div>

    <!-- Order Content Details -->
    <div class="maze-order-details-container">
        <?php
        /**
         * Trigger standard WooCommerce view order action.
         * Outputs itemized garment table, customer addresses, and order notes.
         */
        do_action( 'woocommerce_view_order', $order_id );
        ?>
    </div>

</div>
