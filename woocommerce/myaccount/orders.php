<?php
/**
 * Orders - Custom Modern Brutalist UI for MAZE
 *
 * This template overrides woocommerce/templates/myaccount/orders.php.
 *
 * @package MazeStreetwear
 * @version 9.5.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * @var bool   $has_orders
 * @var object $customer_orders
 * @var int    $current_page
 */
$has_orders      = isset( $has_orders ) ? (bool) $has_orders : false;
$customer_orders = isset( $customer_orders ) ? $customer_orders : (object) array( 'orders' => array(), 'total' => 0, 'max_num_pages' => 0 );
$current_page    = isset( $current_page ) ? (int) $current_page : 1;

do_action( 'woocommerce_before_account_orders', $has_orders );
?>

<div class="maze-account-orders space-y-6">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-black">
        <div>
            <span class="block font-mono text-xs uppercase tracking-widest text-neutral-500 mb-1">
                <?php esc_html_e( 'Order Archive', 'mazestreetwear' ); ?>
            </span>
            <h2 class="text-3xl sm:text-4xl font-bebas uppercase tracking-wide text-black">
                <?php esc_html_e( 'Purchased Garments', 'mazestreetwear' ); ?>
            </h2>
        </div>
        <?php if ( $has_orders ) : ?>
            <span class="font-mono text-xs text-neutral-500 uppercase tracking-widest self-start sm:self-auto px-3 py-1.5 border border-black bg-neutral-50">
                <?php
                /* translators: %s: Order count */
                printf( esc_html__( '%s Orders Total', 'mazestreetwear' ), esc_html( $customer_orders->total ) );
                ?>
            </span>
        <?php endif; ?>
    </div>

    <?php if ( $has_orders ) : ?>

        <!-- Responsive Brutalist Orders Grid -->
        <div class="space-y-4">
            <?php
            foreach ( $customer_orders->orders as $customer_order ) :
                $order      = wc_get_order( $customer_order );
                $item_count = $order->get_item_count();
                $status     = $order->get_status();
                $status_name = wc_get_order_status_name( $status );

                // Custom brutalist status styling
                $status_classes = 'border-black text-black bg-white';
                $status_dot     = 'bg-neutral-500';
                if ( 'completed' === $status ) {
                    $status_classes = 'border-emerald-600 text-emerald-800 bg-emerald-50';
                    $status_dot     = 'bg-emerald-500';
                } elseif ( 'processing' === $status ) {
                    $status_classes = 'border-amber-600 text-amber-800 bg-amber-50';
                    $status_dot     = 'bg-amber-500 animate-pulse';
                } elseif ( 'cancelled' === $status || 'failed' === $status ) {
                    $status_classes = 'border-red-600 text-red-800 bg-red-50';
                    $status_dot     = 'bg-red-500';
                } elseif ( 'on-hold' === $status ) {
                    $status_classes = 'border-blue-600 text-blue-800 bg-blue-50';
                    $status_dot     = 'bg-blue-500';
                }
                ?>
                <div class="border border-black p-5 sm:p-6 bg-white hover:border-black transition-all">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-neutral-200">
                        <div class="flex flex-wrap items-center gap-3">
                            <span class="font-bebas text-2xl tracking-wide text-black">
                                #<?php echo esc_html( $order->get_order_number() ); ?>
                            </span>
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-mono uppercase tracking-wider border <?php echo esc_attr( $status_classes ); ?>">
                                <span class="w-1.5 h-1.5 rounded-full <?php echo esc_attr( $status_dot ); ?>"></span>
                                <?php echo esc_html( $status_name ); ?>
                            </span>
                        </div>
                        <time class="font-mono text-xs text-neutral-500 uppercase tracking-widest" datetime="<?php echo esc_attr( $order->get_date_created()->date( 'c' ) ); ?>">
                            <?php echo esc_html( wc_format_datetime( $order->get_date_created(), 'M d, Y' ) ); ?>
                        </time>
                    </div>

                    <div class="pt-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div class="space-y-1">
                            <span class="block text-xs font-mono text-neutral-500 uppercase tracking-wider">
                                <?php
                                /* translators: %s: number of items */
                                printf( _n( '%s Garment', '%s Garments', $item_count, 'mazestreetwear' ), esc_html( $item_count ) );
                                ?>
                            </span>
                            <div class="font-bebas text-2xl text-black">
                                <?php echo wp_kses_post( $order->get_formatted_order_total() ); ?>
                            </div>
                        </div>

                        <div class="flex flex-wrap items-center gap-3 self-end sm:self-auto">
                            <?php
                            $actions = wc_get_account_orders_actions( $order );
                            if ( ! empty( $actions ) ) {
                                foreach ( $actions as $key => $action ) {
                                    $is_view = ( 'view' === $key );
                                    $btn_classes = $is_view
                                        ? 'bg-black text-white hover:bg-neutral-800'
                                        : 'border border-black bg-white text-black hover:bg-neutral-100';
                                    ?>
                                    <a href="<?php echo esc_url( $action['url'] ); ?>"
                                       class="inline-flex items-center justify-center px-6 py-2.5 font-bebas text-base uppercase tracking-wider transition-colors <?php echo esc_attr( $btn_classes ); ?>">
                                        <?php echo esc_html( $action['name'] ); ?>
                                    </a>
                                    <?php
                                }
                            } else {
                                ?>
                                <a href="<?php echo esc_url( $order->get_view_order_url() ); ?>"
                                   class="inline-flex items-center justify-center bg-black text-white px-6 py-2.5 font-bebas text-base uppercase tracking-wider hover:bg-neutral-800 transition-colors">
                                    <?php esc_html_e( 'View Receipt', 'mazestreetwear' ); ?>
                                </a>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php do_action( 'woocommerce_before_account_orders_pagination' ); ?>

        <!-- Modern Pagination Controls -->
        <?php if ( 1 < $customer_orders->max_num_pages ) : ?>
            <div class="flex items-center justify-between pt-6 border-t border-black">
                <?php if ( 1 !== $current_page ) : ?>
                    <a href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page - 1 ) ); ?>"
                       class="inline-flex items-center justify-center border border-black bg-white text-black px-6 py-3 font-bebas text-base uppercase tracking-wider hover:bg-neutral-100 transition-colors">
                        &larr; <?php esc_html_e( 'Previous', 'mazestreetwear' ); ?>
                    </a>
                <?php else : ?>
                    <div></div>
                <?php endif; ?>

                <span class="font-mono text-xs text-neutral-500 uppercase tracking-widest">
                    <?php
                    /* translators: 1: current page, 2: total pages */
                    printf( esc_html__( 'Page %1$s of %2$s', 'mazestreetwear' ), esc_html( $current_page ), esc_html( $customer_orders->max_num_pages ) );
                    ?>
                </span>

                <?php if ( intval( $customer_orders->max_num_pages ) !== $current_page ) : ?>
                    <a href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page + 1 ) ); ?>"
                       class="inline-flex items-center justify-center border border-black bg-white text-black px-6 py-3 font-bebas text-base uppercase tracking-wider hover:bg-neutral-100 transition-colors">
                        <?php esc_html_e( 'Next', 'mazestreetwear' ); ?> &rarr;
                    </a>
                <?php else : ?>
                    <div></div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

    <?php else : ?>

        <!-- Empty Orders State -->
        <div class="border border-black p-8 sm:p-12 text-center bg-white space-y-4">
            <div class="w-16 h-16 border border-black bg-neutral-100 mx-auto flex items-center justify-center font-bebas text-3xl text-neutral-400">
                M
            </div>
            <h3 class="font-bebas text-2xl sm:text-3xl tracking-wide uppercase text-black">
                <?php esc_html_e( 'Your Order Archive Is Empty', 'mazestreetwear' ); ?>
            </h3>
            <p class="text-sm text-neutral-700 max-w-md mx-auto leading-relaxed">
                <?php esc_html_e( 'You have not acquired any MAZE garments yet. Explore our current season drops and essentials.', 'mazestreetwear' ); ?>
            </p>
            <div class="pt-4">
                <a href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>"
                   class="inline-flex items-center justify-center bg-black text-white px-8 py-3.5 font-bebas text-lg tracking-wider uppercase hover:bg-neutral-800 transition-colors">
                    <?php esc_html_e( 'Explore Collection', 'mazestreetwear' ); ?> &rarr;
                </a>
            </div>
        </div>

    <?php endif; ?>

</div>

<?php do_action( 'woocommerce_after_account_orders', $has_orders ); ?>
